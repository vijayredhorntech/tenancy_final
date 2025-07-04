<?php

namespace App\Repositories;

use App\Models\Visa;
use App\Models\Country;
use App\Models\VisaServices;
use App\Models\VisaSubtype;
use App\Models\VisaServiceType;
use App\Models\VisaBooking;
use App\Models\Deduction;
use App\Models\Balance;
use App\Models\Agency;
use App\Models\User;
use App\Models\AuthervisaApplication;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Services\FileUploadService;
use Auth; 
use Illuminate\Support\Str;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Models\Document;
use App\Models\VisaServiceTypeDocument;
use App\Services\AgencyService;
use App\Services\VisaverifyService;
use App\Models\UserServiceAssignment;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewFormNotification;
use App\Mail\VisaApplicationMail;
use App\Models\ClientApplicationDocument;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ClientDetails;
use App\Mail\ClientRequestNotificationMail;
use App\Models\VisaRelatedDocument;

class VisaRepository implements VisaRepositoryInterface
{
    
    protected $fileUploadService;
    protected $agencyService;
    protected $visaverifyService;
    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService,VisaverifyService $visaverifyService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->agencyService = $agencyService;
        $this->visaverifyService = $visaverifyService;
    }

    public function getAllCountry(){

       return Country::paginate(10);
    }

    
//     public function getSuperadminAllApplication()
// {
//     $bookings = VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'agency'])
//         ->where('sendtoadmin', '1')
//         ->orderBy('created_at', 'desc')
//         ->paginate(10);

//     foreach ($bookings as $viewbooking) {
//         $database = $viewbooking->agency->database_name ?? null;

//         if ($database) {
//             // Set the user-specific database connection
//             $this->agencyService->setConnectionByDatabase($database);

//             // Load client data
//             $clientFromUserDB = ClientDetails::on('user_database')
//                 ->with('clientinfo')
//                 ->where('id', $viewbooking->client_id)
//                 ->first();

//             $otherMember = AuthervisaApplication::on('user_database')
//                 ->where('clint_id', $viewbooking->client_id)
//                 ->where('booking_id', $viewbooking->id)
//                 ->get();

//             $otherapplicationDetails = null;
//             if (!empty($viewbooking->otherclientid)) {
//                 $otherapplicationDetails = AuthervisaApplication::on('user_database')
//                     ->where('id', $viewbooking->otherclientid)
//                     ->first();
//             }

//             // Override default relations with data from user DB
//             $viewbooking->setRelation('clint', $clientFromUserDB);
//             $viewbooking->setRelation('otherclients', $otherMember);
//             $viewbooking->setRelation('otherapplicationDetails', $otherapplicationDetails);
//         }
//     }

//     return $bookings;
// }

public function getSuperadminAllApplication($request){
    // dd("heelo");
$query = VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'agency']);

        // Base query
        $query->with(['downloadDocument', 'clientapplciation']) // clint will be overridden manually
              ->where('sendtoadmin', '1')
              ->orderBy('created_at', 'desc');

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('clint', function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('origin_id')) {
            $query->where('origin_id', $request->origin_id);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('application_status')) {
            $query->where('applicationworkin_status', $request->application_status);
        }

        if ($request->filled('agencyid')) {
            $query->where('agency_id', $request->agencyid);
        }

        // Export
        if ($request->filled('export') && $request->export == 'true') {
            $bookings = $query->get();
        } else {
            $bookings = $query->paginate((int)($request->per_page ?? 10))->withQueryString();
        }

        // Loop and override `clint` with data from the user's DB
        foreach ($bookings as $viewbooking) {
            $database = $viewbooking->agency->database_name ?? null;

            if ($database) {
                $this->agencyService->setConnectionByDatabase($database);

                // ✅ Get client from tenant DB
                $clientFromUserDB = ClientDetails::on('user_database')
                    ->with('clientinfo')
                    ->where('id', $viewbooking->client_id)
                    ->first();

                // ✅ Get other members
                $otherMember = AuthervisaApplication::on('user_database')
                    ->where('clint_id', $viewbooking->client_id)
                    ->where('booking_id', $viewbooking->id)
                    ->get();

                // ✅ Get other application details
                $otherapplicationDetails = null;
                if (!empty($viewbooking->otherclientid)) {
                    $otherapplicationDetails = AuthervisaApplication::on('user_database')
                        ->where('id', $viewbooking->otherclientid)
                        ->first();
                }

                // ✅ Override relationships
                $viewbooking->setRelation('clint', $clientFromUserDB);
                $viewbooking->setRelation('otherclients', $otherMember);
                $viewbooking->setRelation('otherapplicationDetails', $otherapplicationDetails);
            }
        }

        return $bookings;
    
}

    public function getSuperradmiNewApplication(){
//    dd("heelo");
        return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint','clientapplciation'])
        ->where('sendtoadmin', '0')
        ->where('display_notification', '1')
        ->orderBy('created_at', 'desc') // Orders by latest created_at first
        ->get();

    }
    /******Filter Application **** */
    
//     public function getSuperadminshotedapplication($request)
// {
//     // dd("heelo");
//     $query = VisaBooking::with([
//         'visa', 
//         'origin', 
//         'destination', 
//         'visasubtype', 
//         'clint', 
//         'clientapplciation'
//     ])
//     ->where('sendtoadmin', '1')
//     ->orderBy('created_at', 'desc');

//     if ($request->filled('search')) {
//         $search = $request->search;
//         $query->whereHas('clint', function ($q) use ($search) {
//             $q->where(function ($query) use ($search) {
//                 $query->where('client_name', 'like', "%{$search}%")
//                       ->orWhere('email', 'like', "%{$search}%")
//                       ->orWhere('phone_number', 'like', "%{$search}%");
//             });
//         });
//     }

//     if ($request->filled('date_from')) {
//         $query->whereDate('created_at', '>=', $request->date_from);
//     }

//     if ($request->filled('date_to')) {
//         $query->whereDate('created_at', '<=', $request->date_to);
//     }

//     if ($request->filled('origin_id')) {
//         $query->where('origin_id', $request->origin_id);
//     }

//     if ($request->filled('destination_id')) {
//         $query->where('destination_id', $request->destination_id);
//     }

//     if ($request->filled('application_status')) {
//         $query->where('applicationworkin_status', $request->application_status);
//     }

//     if ($request->filled('agencyid')) {
//         $query->where('agency_id', $request->agencyid);
//     }

//     // ✅ Add this check to avoid pagination during export
//     if ($request->filled('export') && $request->export == 'true') {
//         return $query->get(); // used for export
//     }

//     // ✅ Else return paginated result for view
//     return $query->paginate((int)($request->per_page ?? 10))->withQueryString();
// }

public function getSuperadminshotedapplication($request)
{
    $query = VisaBooking::with([
        'visa',
        'origin',
        'destination',
        'visasubtype',
        'clint',
        'clientapplciation'
    ])
    ->where('sendtoadmin', '1')
    ->orderBy('created_at', 'desc');

    // Filtering
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('clint', function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('client_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone_number', 'like', "%{$search}%");
            });
        });
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    if ($request->filled('origin_id')) {
        $query->where('origin_id', $request->origin_id);
    }

    if ($request->filled('destination_id')) {
        $query->where('destination_id', $request->destination_id);
    }

    if ($request->filled('application_status')) {
        $query->where('applicationworkin_status', $request->application_status);
    }

    if ($request->filled('agencyid')) {
        $query->where('agency_id', $request->agencyid);
    }

    // Check for export flag
    if ($request->filled('export') && $request->export == 'true') {
        $bookings = $query->get(); // Fetch all without pagination

        foreach ($bookings as $viewbooking) {
            $database = $viewbooking->agency->database_name ?? null;

            if ($database) {
                $this->agencyService->setConnectionByDatabase($database);

                // Fetch client from user DB
                $clientFromUserDB = ClientDetails::on('user_database')
                    ->with('clientinfo')
                    ->where('id', $viewbooking->client_id)
                    ->first();

                // Fetch other members
                $otherMember = AuthervisaApplication::on('user_database')
                    ->where('clint_id', $viewbooking->client_id)
                    ->where('booking_id', $viewbooking->id)
                    ->get();

                // Fetch other application details
                $otherapplicationDetails = null;
                if (!empty($viewbooking->otherclientid)) {
                    $otherapplicationDetails = AuthervisaApplication::on('user_database')
                        ->where('id', $viewbooking->otherclientid)
                        ->first();
                }

                // Override relationships
                $viewbooking->setRelation('clint', $clientFromUserDB);
                $viewbooking->setRelation('otherclients', $otherMember);
                $viewbooking->setRelation('otherapplicationDetails', $otherapplicationDetails);
            }
        }

        return $bookings; // return complete list for export
    }

    // Return paginated data for view
    return $query->paginate((int)($request->per_page ?? 10))->withQueryString();
}

    
    /******GET data By Client id *** */
    public function getPendingDocumentByCID($clientId)
    {
        return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'clint', 'clientapplciation'])
            ->where('client_id', $clientId)
            ->whereHas('clientapplciation', function ($query) {
                $query->whereIn('document_status', [0, 1]); // ✔️ Matches both 0 and 1
            })
            ->get();

    }

    public function getAllVisas()
    {
        return VisaServices::paginate(10);
    }


    public function getVisaById($id)
    {
        return VisaServices::with('VisavisaSubtype')->find($id);
    }

    /***Create Visa name and sub type**** */
    public function createVisa(array $data)
    {
        
        return DB::transaction(function () use ($data) {
            // Create Visa
            $visa = new VisaServices();
            $visa->name = $data['name'];
            $visa->description = $data['description'];
            $visa->save();

            // Save Visa Subtypes in a loop
            // foreach ($data['subtype'] as $key => $subtypeName) {
            //     VisaSubtype::create([
            //         'visa_type_id' => $visa->id, // Assuming Visa Type ID is the VisaService ID
            //         'name' => $subtypeName,
            //         'price' => $data['subtypeprice'][$key],
            //         'commission' => $data['commission'][$key],
            //         'validity' => $data['validity'][$key],
            //         'processing' => $data['processing'][$key],
            //         'gstin' => $data['gstin'][$key],
            //         'status' => 1 // Default status as active
            //     ]);
            // }
    
            return $visa;
        });
    }
    

/***** Assign Visa to Country ********/
public function assignVisaToCountry(array $data)
{
 
    // dd($data);
    return DB::transaction(function () use ($data) {
        $assign = new VisaServiceType();
        $authUserId = auth()->id();
       
        // Handle file upload if 'title_image' is present
        if (isset($data['title_image'])) {
      
            $uploadedFilePath = $this->fileUploadService->uploadFile(
                $data['title_image'], 
                'images/visa/titleimages/', 
                $authUserId
            );
               // Save file path in DB
             $assign->title_image = $uploadedFilePath;
        }

        $assign->origin = $data['origincoutnry']; // Fixed typo
        $assign->destination = $data['destination'];
        $assign->visa_id = $data['visa_id'];
        $assign->description = $data['description'] ?? null;
        $assign->required = $data['required'];
        $assign->save();
        $assignid = $assign->visa_id;
     
        foreach ($data['subtype'] as $key => $subtypeName) {
                VisaSubtype::create([              
                    'country_type_id' => $assign->id, // Assuming Visa Type ID is the VisaService ID
                    'visa_type_id'=>$assignid,
                    'name' => $subtypeName,
                    'price' => $data['subtypeprice'][$key],
                    'commission' => $data['commission'][$key],
                    'validity' => $data['validity'][$key],
                    'processing' => $data['processing'][$key],
                    'gstin' => $data['gstin'][$key],
                    'status' => 1 // Default status as active
                ]);
            }

        return $assign;
    });
}

/****update assign country *** */
public function updateVisaAssignment(array $data, int $id)
{
   
    return DB::transaction(function () use ($data, $id) {
        $assign = VisaServiceType::findOrFail($id);
        $authUserId = auth()->id();

        // Handle file upload if provided
        if (isset($data['title_image'])) {
            $uploadedFilePath = $this->fileUploadService->uploadFile(
                $data['title_image'],
                'images/visa/titleimages/',
                $authUserId
            );
            $assign->title_image = $uploadedFilePath;
        }

        // Update basic info
        $assign->origin = $data['origincoutnry'];
        $assign->destination = $data['destination'];
        $assign->visa_id = $data['visa_id'];
        $assign->description = $data['description'] ?? null;
        $assign->required = $data['required'];
        $assign->save();

        // Add new subtypes only
        foreach ($data['subtype'] as $key => $subtypeName) {
            VisaSubtype::create([
                'country_type_id' => $assign->id,
                'visa_type_id' => $assign->visa_id,
                'name' => $subtypeName,
                'price' => $data['subtypeprice'][$key],
                'commission' => $data['commission'][$key],
                'validity' => $data['validity'][$key],
                'processing' => $data['processing'][$key],
                'gstin' => $data['gstin'][$key],
                'status' => 1
            ]);
        }

        return $assign;
    });
}



public function getVisabySearch($origin,$destination){
    return VisaServiceType::with('VisaServices','Subvisas','origincountry','destinationcountry')->where('origin',$origin)->where('destination',$destination)->get();
    // $value= VisaServiceType::with('VisaServices','Subvisas')->where('origin',$origin)->where('destination',$destination)->get();
    // dd($value);


}


public function getVisabySearchcoutnry($id){
    return VisaServiceType::with('Subvisas')->where('id',$id)->first();
}


public function updateVisa($id, array $data)
{
    
    // Find the Visa record
    $visa = VisaServices::findOrFail($id);

    // Update Visa details
    $visa->name = $data['name'];
    $visa->description = $data['description'];
    $visa->save();

    // Check if subtypes exist
    if (isset($data['subtype']['0'])) {
  
        foreach ($data['subtype'] as $key => $subtypeName) {
            VisaSubtype::updateOrCreate(
                [
                    'visa_type_id' => $id,
                    'id' => $data['subtype_id'][$key] ?? null // If an ID exists, update it
                ],
                [
                    'name' => $subtypeName,
                    'price' => $data['subtypeprice'][$key] ?? 0,
                    'commission' => $data['commission'][$key] ?? 0,
                    'validity' => $data['validity'][$key]?? 0,
                    'processing' => $data['processing'][$key]?? 0,
                    'gstin' => $data['gstin'][$key]?? 0,
                    'status' => 1, // Default status as active
                ]
            );
        }
    }
  

    return $visa;
}


  public function allVisacoutnry(){
    return VisaServiceType::with('origincountry','destinationcountry','VisaServices','Subvisas')->get(); 
  }



  public function saveBooking(array $data)
  {
    
    
     // Correcting function call
            $getCode = $this->getCountryCode($data['origin'], $data['destination']);

            // Access values
            $originCode = $getCode['origin_code'];
            $destinationCode = $getCode['destination_code'];

            $subtype = VisaSubtype::where('id', $data['category'])->firstOrFail();
            $totalAmount = ($subtype->price ?? 0) + ($subtype->commission ?? 0);
            //   $application = Str::uuid();
            $application = strtolower(now()->format('ymdHis') . '-' . Str::random(3));

            $agency = $this->agencyService->getAgencyData();
            $user=$this->agencyService->getCurrentLoginUser();

  

    if(isset($data['passengerfirstname'])){
    
        $passengerCount = count($data['passengerfirstname'])+1;
     
        $totalAmount=$totalAmount*$passengerCount; 
    }


  
    $booking = new VisaBooking();
      $booking->origin_id = $data['origin'];
      $booking->destination_id = $data['destination'];
      $booking->visa_id = $data['typeof'];
      $booking->subtype_id = $data['category'];
      $booking->agency_id=$agency->id; 
      $booking->user_id = $user->id; // Current logged-in user
      $booking->client_id = $data['clientId']; // Assuming same as user
      $booking->application_number = $application;
      $booking->total_amount = $totalAmount;
      $booking->dateofentry = $data['dateofentry'];
      $booking->save(); // Save booking first
   
  
      if (isset($data['passengerfirstname'])) {
        $user = $this->agencyService->getCurrentLoginUser();  
       
        foreach ($data['passengerfirstname'] as $index => $firstname) {
            $authapplication = new AuthervisaApplication();
            $authapplication->setConnection('user_database');
        

            $authapplication->booking_id = $booking->id;
            $authapplication->clint_id = $data['clientId']; // Change this if clint_id is different
            $authapplication->name = $firstname; // Assign first name dynamically
            $authapplication->lastname = $data['passengerlastname'][$index];
            $authapplication->passport_number = $data['passengerpassportn'][$index];
            $authapplication->passport_issue_date = $data['passportissuedate'][$index];
            $authapplication->passport_expire_date = $data['passportexpiredate'][$index];
            $authapplication->place_of_issue = $data['passengerplace'][$index]; // Assign last name dynamically
            $authapplication->save();
        }
    }
    
  return $booking;

      // Fetch agency based on the current user
    //   $agency = Agency::where('id', Auth::id())->firstOrFail(); 
    // Return the saved booking object
  }

  public function payment($data){


    $balance = Balance::where('agency_id', $data['agency_id'])->first();
    $totalAmount=$data['total_amount'];
  
    // If balance record does not exist, return an error
    if (!$balance) {
    
        throw new \Exception('Balance record not found.'); // Exception is better than dd()
    }

    $fundRemaining = $balance->balance;

    // Check if agency has enough balance
    if ($totalAmount > $fundRemaining) {
      dd('Insufficient balance.');
        throw new \Exception('Insufficient balance.'); // Exception is better than dd()
    }

    // Deduct amount from balance first
    $balance->balance -= $totalAmount;
    $balance->save();
    $deduction = new Deduction();
    $deduction->agency_id = $data['agency_id'];
    $deduction->service = '3';
    $deduction->invoice_number =  $data['application_number'];
    $deduction->flight_booking_id = $data['id'];
    $deduction->amount = $data['total_amount'];
    $deduction->create_userid = $data['total_amount'];
    $deduction->client_id = $data['total_amount'];
    $deduction->displaynotification = 3;
    $deduction->date = now();
    $deduction->save();
    return $deduction;
  }

public function checkBalance($id,$totalAmount){
    $balance = Balance::where('agency_id', $id)->first();
    if (!$balance) {
        return false; // Exception is better than dd()
    }
    $fundRemaining = $balance->balance;
    if ($totalAmount > $fundRemaining) {
      return false;  // Exception is better than dd()
    }
   return true; 
}

  public function getPendingBookingByid($id){
    return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'clint', 'clientapplciation'])
    ->where('agency_id', $id)
    ->whereHas('clientapplciation', function ($query) {
        $query->whereIn('document_status', [0, 1]); // ✔️ Matches both 0 and 1
    })
    ->get();

   
  }


// public function getBookingByid($id, $type)
// {
//     $query = VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'agency']);

//     if ($type === "all") {
//         $query = $query
//             ->with('downloadDocument')
//             ->where('agency_id', $id)
//             ->where('confirm_application', '1')
//             ->orderBy('created_at', 'desc');
//     } elseif ($type === "pending") {
//         $query = $query
//             ->where('agency_id', $id)
//             ->where('confirm_application', '0')
//             ->where('document_status', 'Pending')
//             ->orderBy('created_at', 'desc');
//     } else {
//         return response()->json(['message' => 'Invalid type provided.'], 400);
//     }

//     $bookings = $query->paginate(10);

//     foreach ($bookings as $viewbooking) {
//         $database = $viewbooking->agency->database_name ?? null;

//         if ($database) {
//             // Set connection to user-specific database
//             $this->agencyService->setConnectionByDatabase($database);

//             // Load client and other members from user DB
//             $clientFromUserDB = ClientDetails::on('user_database')
//                 ->with('clientinfo')
//                 ->where('id', $viewbooking->client_id)
//                 ->first();

//             $otherMember = AuthervisaApplication::on('user_database')
//                 ->where('clint_id', $viewbooking->client_id)
//                 ->where('booking_id', $viewbooking->id)
//                 ->get();

//             // Check and load other application details
//             $otherapplicationDetails = null;
//             if (!empty($viewbooking->otherclientid)) {
//                 $otherapplicationDetails = AuthervisaApplication::on('user_database')
//                     ->where('id', $viewbooking->otherclientid)
//                     ->first();
//             }

//             // Set custom relations
//             $viewbooking->setRelation('clint', $clientFromUserDB);
//             $viewbooking->setRelation('otherclients', $otherMember);
//             $viewbooking->setRelation('otherapplicationDetails', $otherapplicationDetails);
//         }
//     }

//     return $bookings;
// }

public function getBookingByid($id, $type, $request)
{
    $query = VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'agency']);

    if ($type === "all") {
        // Base query
        $query->with(['downloadDocument', 'clientapplciation']) // clint will be overridden manually
              ->where('agency_id', $id)
              ->where('confirm_application', '1')
              ->orderBy('created_at', 'desc');

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('clint', function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('origin_id')) {
            $query->where('origin_id', $request->origin_id);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('application_status')) {
            $query->where('applicationworkin_status', $request->application_status);
        }

        if ($request->filled('agencyid')) {
            $query->where('agency_id', $request->agencyid);
        }

        // Export
        if ($request->filled('export') && $request->export == 'true') {
            $bookings = $query->get();
        } else {
            $bookings = $query->paginate((int)($request->per_page ?? 10))->withQueryString();
        }

        // Loop and override `clint` with data from the user's DB
        foreach ($bookings as $viewbooking) {
            $database = $viewbooking->agency->database_name ?? null;

            if ($database) {
                $this->agencyService->setConnectionByDatabase($database);

                // ✅ Get client from tenant DB
                $clientFromUserDB = ClientDetails::on('user_database')
                    ->with('clientinfo')
                    ->where('id', $viewbooking->client_id)
                    ->first();

                // ✅ Get other members
                $otherMember = AuthervisaApplication::on('user_database')
                    ->where('clint_id', $viewbooking->client_id)
                    ->where('booking_id', $viewbooking->id)
                    ->get();

                // ✅ Get other application details
                $otherapplicationDetails = null;
                if (!empty($viewbooking->otherclientid)) {
                    $otherapplicationDetails = AuthervisaApplication::on('user_database')
                        ->where('id', $viewbooking->otherclientid)
                        ->first();
                }

                // ✅ Override relationships
                $viewbooking->setRelation('clint', $clientFromUserDB);
                $viewbooking->setRelation('otherclients', $otherMember);
                $viewbooking->setRelation('otherapplicationDetails', $otherapplicationDetails);
            }
        }

        return $bookings;
    }

    // Pending
    if ($type === "pending") {
        $bookings = $query
            ->where('agency_id', $id)
            ->where('confirm_application', '0')
            ->where('document_status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $bookings;
    }

    return response()->json(['message' => 'Invalid type provided.'], 400);
}



  /*****Form function ******/

    public function allForms(){
        //the name of table is form document
     
        // agency
            
      return Document::with('countries')->paginate(10);
    }

    /***Store From *****/
    public function storeForms(array $data)
    {
    
        DB::beginTransaction(); // Start the transaction
    
        try {
     
       
           $path="";
            if (isset($data['form_upload'])) {
                $authUserId = auth()->id();
                
                // Upload the file
                $uploadedFilePath = $this->fileUploadService->uploadFile(
                    $data['form_upload'], 
                    'images/visa/forms/', 
                    $authUserId
                );
                $path = "images/visa/forms/" . $uploadedFilePath;
            }
                // Save document
                $new = new Document();
                $new->form_name = $data['name'];
                $new->form_description = $data['description'] ?? null; // Handle null case
                $new->document = $path;
                $new->save();
    
                // Save visa service type document
                $service = new VisaServiceTypeDocument();
                $service->form_id  = $new->id;
                $service->origin_id  = $data['origincoutnry'];
                $service->destination_id   = $data['destination'];
                $service->description  = $data['description'];
                $service->fee = '0' ?? null; // Handle null case

                $service->save();
    
                 // Fetch all agencies
                 $agencies = UserServiceAssignment::with('agency')->where('service_id','3')->get();
                //  foreach ($agencies as $agency) {
                //     Mail::to($agency->agency->email)->queue(new NewFormNotification($new));
                // }
                DB::commit(); // Commit transaction if everything is successful
    
                return response()->json(['message' => 'Form saved successfully'], 200);
     
            
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack(); // Rollback transaction on error
    
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    
    /*****Find By Id *****/
    public function findFormById($id){
        return Document::with('countries')->where('id',$id)->first();
    }

   /****** Delete Form ******/
        public function deleteForm($id)
        {
            $form = Document::find($id);

            if (!$form) {
                return response()->json(['error' => 'Form not found'], 404);
            }

            // If there is a relationship that needs detachment before deletion, do it
            // $form->countries()->detach(); // If using a Many-to-Many relationship

            $form->delete();
            return true; 
            // return response()->json(['success' => 'Form deleted successfully'], 200);
        }


        /******Assign Country to Form ******/
        public function assignCountrytoForms($id, $data){

            $new=$this->findFormById($id);
            $service = new VisaServiceTypeDocument();
            $service->visa_id  = '1';
            $service->form_id  = $id;
            $service->origin_id  = $data['origincoutnry'];
            $service->destination_id   = $data['destination'];
            $service->fee = '0' ?? null; // Handle null case
            $service->save();

             // Fetch all agencies
             $agencies = UserServiceAssignment::with('agency')->where('service_id', '3')->get();

             foreach ($agencies as $agency) {
                 // Ensure agency exists before sending email
                 if (!empty($agency->agency) && !empty($agency->agency->email)) {
                     Mail::to($agency->agency->email)->queue(new NewFormNotification($new));
                 }
             }
        }




    // public function bookingDataById($id){
      
    //    $viewbooking=VisaBooking::with(['visa', 'agency','origin', 'destination', 'visasubtype','clint.clientinfo','otherclients','clientapplciation','downloadDocument','clientrequestdocuments'])
    //     ->where('id', $id)
    //    ->first(); 
    
    //     $database=$viewbooking->agency->database_name
    //     $this->agencyService->setDatabase($database);

    //    $viewbooking->setRelation('clint.clientinfo',ClientDe::where('client_id', $data->id)->get());

    //    return $viewbooking;
      
    // }

    // public function bookingDataById($id)
    // {
    //     $viewbooking = VisaBooking::with([
    //         'visa',
    //         'agency',
    //         'origin',
    //         'destination',
    //         'visasubtype',
    //         'clint.clientinfo',
    //         'otherclients',
    //         'clientapplciation',
    //         'downloadDocument',
    //         'clientrequestdocuments'
    //     ])->where('id', $id)->first();
    
    //     if (!$viewbooking) {
    //         return null; // Or handle error as needed
    //     }
    
    //     $database = $viewbooking->agency->database_name;
    //     $this->agencyService->setConnectionByDatabase($database);
    
    //     // Set clientinfo manually from the user-specific database if needed
    //     if ($viewbooking->clint) {
           
    //         $viewbooking->clint->setRelation(
    //             'clint',
    //             ClientDetails::on('user_database')->where('id', $viewbooking->client_id)->first()
    //         );
    //     }
    
    //     return $viewbooking;
    // }
    public function bookingDataById($id)
{
    // Load booking with everything except 'clint.clientinfo'
    $viewbooking = VisaBooking::with([
        'visa',
        'agency',
        'origin',
        'destination',
        'visasubtype',
        // 'otherclients',
        'clientapplciation',
        'downloadDocument',
        'clientrequestdocuments',
        'applicationlog',
        'clientrequiremtsinfo',
        'visarequireddocument'
    ])->where('id', $id)->first();

    if (!$viewbooking) {
        return null;
    }

    // Get the user-specific database name from the agency
    $database = $viewbooking->agency->database_name;
    $this->agencyService->setConnectionByDatabase($database); // Optional if used elsewhere

    // Load the clint relation from the user-specific database, including clientinfo
    $clientFromUserDB = ClientDetails::on('user_database')
        ->with('clientinfo') // You can add other nested relations if needed
        ->where('id', $viewbooking->client_id)
        ->first();
    //   dd( $viewbooking->id);
    $otherMember = AuthervisaApplication::on('user_database')
        ->where('clint_id', $viewbooking->client_id)
        ->where('booking_id', $viewbooking->id)
        ->get();
//   dd($otherMember);
    // Override the default `clint` relation with the correct one from user DB
    $viewbooking->setRelation('clint', $clientFromUserDB);
    $viewbooking->setRelation('otherclients', $otherMember);

    

    return $viewbooking;
}

    


    public function deleteVisa($id)
    {
        $visa=$this->getVisaById($id);
        $visa->delete(); 
    }


    public function assignUpdateBooking($id,$data){
      $visabooking=VisaBooking::with('agency')->where('id',$id)->first(); 
        $visabooking->document_status=$data['document_status']; 
        $visabooking->payment_status=$data['paymentstatus']; 
        if(isset($data['application_status'])){
            $visabooking->application_status=$data['application_status'];
            $visabooking->applicationworkin_status=$data['application_status'];
        }
        $visabooking->save(); 
        return $visabooking;
   
    }

    /****Get Country COde *****/

    public function getCountryCode($origin, $destination)
    {
        $originData = Country::where('id', $origin)->first();
        $destinationData = Country::where('id', $destination)->first();
    
        $originCode = $originData ? $originData->code : null;
        $destinationCode = $destinationData ? $destinationData->code : null;
    
        return [
            'origin_code' => $originCode,
            'destination_code' => $destinationCode
        ];
    }



    /***** View visa form *****/
    public function viewCoutnryFormById($id){
        return VisaServiceTypeDocument::with('visaServiceType','from','origin','destination')->where('form_id',$id)->get();

    }

    /******Disconnected the Country ******/
    public function disConnectCoutnryFormById($id){
        $visa=VisaServiceTypeDocument::where('id',$id)->first();
        $visa->delete(); 
        return true; 
    }


   
    /****** Destroy Application ******/
        public function deleteBooking($id)
        {
            $booking = $this->bookingDataById($id);
            if (!$booking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }
            $bookingInvoice = $booking->application_number;
            $deduction = Deduction::where('invoice_number', $bookingInvoice)->first();
            // Delete deduction only if it exists
            if ($deduction) {
                $deduction->delete();
            }
            $booking->delete();
            return true;
        }

  /*******Send Email *******/
    public function sendEmail(array $data,$agency){
     
        Mail::to($data['emailid'])->queue(new VisaApplicationMail($data, $agency));
       
    }

    public function sendToAdmin($id)
    {

        $booking = $this->bookingDataById($id);
        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }
        $deduction = Deduction::where('flight_booking_id', $booking->id)->first();

        // Mail::to(env('SUPERADMIN_EMAIL'))->send(new ClientRequestNotificationMail($deduction));

        if ($deduction) {
            $deduction->displaynotification = 0;
            $deduction->save();
        }
        $booking->sendtoadmin = 1;
        $booking->save();
        $userId = auth()->id();
       $save=$this->agencyService->saveLog($booking,'agency',' Send to Admin', $userId);
        // Return the booking object
        return $booking;
    }
    

    public function getDataByClientId($id){
        return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint.clientinfo','otherclients','downloadDocument'])
        ->where('client_id', $id)
       ->orderBy('created_at', 'desc') // Orders by latest created_at first
       ->paginate(10);
    }

    public function storeClientDocuemtn($data){
  
        $bookingId = $data['booking_id'];
    //   dd($bookingId);
       foreach ($data['documents'] as $docId => $file) {
        $filename = $file->store('client/documents', 'public');


        // Example: store document path in DB
        ClientApplicationDocument::where('id', $docId)->update([
            'document_file' => $filename,
            'document_status' => 2, // Mark as uploaded
        ]);
    }
    return true;
       
    }

    public function getBookingBySingleId($id){
        return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint.clientinfo','otherclients','downloadDocument'])
        ->where('id', $id)
        ->first();
    }

    public function updateClientBooking($id,$data){
    
        $visabooking=VisaBooking::with('visasubtype')->where('id',$id)->first(); 
        // dd($visabooking);
     
        $price=$visabooking->visasubtype->price+$visabooking->visasubtype->commission;
        $visabooking->total_amount=$price;
        $visabooking->payment_status="Paid";
        $visabooking->confirm_application=1;
        $visabooking->save(); 
        $this->payment($visabooking);

        if (isset($data['othermember']) && is_array($data['othermember'])) {
            foreach ($data['othermember'] as $memberId) {
                $newBooking = $visabooking->replicate(); // clone the existing booking
                $newBooking->client_id = $visabooking->client_id;
                $newBooking->otherclientid = $memberId; // to indicate it's linked to the original client
                $newBooking->application_number = strtolower(now()->format('ymdHis') . '-' . Str::random(3));
                $newBooking->save();
                $this->payment($newBooking);
            }
        }
        return true;
    }

    public function createClientBooking($id, $data)
    {
        $visabooking = VisaBooking::with('visasubtype')->where('id', $id)->first(); 
    
        if (!$visabooking) {
            return false;
        }
    
        $price = $visabooking->visasubtype->price + $visabooking->visasubtype->commission;
        $visabooking->total_amount = $price;
        $visabooking->payment_status = "Paid";
        
        // Set first member as otherclientid in original booking
        if (!empty($data['othermember']) && is_array($data['othermember'])) {
            $visabooking->otherclientid = array_shift($data['othermember']); // Take first and remove from array
        }
    
        $visabooking->confirm_application = 1;
        $visabooking->save();
    
        $this->payment($visabooking);
    
        // Create bookings for remaining other members
        if (!empty($data['othermember']) && is_array($data['othermember'])) {
            foreach ($data['othermember'] as $memberId) {
                $newBooking = $visabooking->replicate(); // Clone
                $newBooking->client_id = $visabooking->client_id;
                $newBooking->otherclientid = $memberId;
                $newBooking->application_number = strtolower(now()->format('ymdHis') . '-' . Str::random(3));
                $newBooking->save();
                $this->payment($newBooking);
            }
        }
    
        return true;
    }
    


    /****Store Visa doucment **** */

    public function visadocumentstore($data)
    {
       
        $visa = VisaRelatedDocument::where('bookingid', $data['bookingid'])->first();
    
        if (!$visa) {
            $visa = new VisaRelatedDocument();
            $visa->bookingid = $data['bookingid'];
        }
        if(($data['step']?? null)=="visahistory"){
         
            $travelHistory = [
                'previous_visas_held' => $data['previous_visas_held'] ?? null,
                'visarejections' => $data['visarejections'] ?? null,
                'overstays' => $data['overstays'] ?? null,
                'countries_visited_last_10_years' => $data['countries_visited_last_10_years'] ?? null,
                'has_previous_uktravel' => $data['has_previous_uktravel'] ?? null,
                'uk_travel_details' => $data['uk_travel_details'] ?? null,
                'previous_usa_travel' => $data['previous_usa_travel'] ?? null,
                'usa_travel_details' => $data['usa_travel_details'] ?? null,
                'previousschengentravel' => $data['previousschengentravel'] ?? null,
                'previousschengentravel_details' => $data['previousschengentravel_details'] ?? null,
                'previouschinatravel' => $data['previouschinatravel'] ?? null,
                'china_travel_details' => $data['china_travel_details'] ?? null,
                'previousrussiatravel' => $data['previousrussiatravel'] ?? null,
                'russia_travel_details' => $data['russia_travel_details'] ?? null,
                'previoustndiatravel' => $data['previoustndiatravel'] ?? null,    
                'indiaaddressstay' => $data['indiaaddressstay'] ?? null,
                'indiacityvisit' => $data['indiacityvisit'] ?? null,
                'indiatypeofvisa' => $data['indiatypeofvisa'] ?? null,
                'indiavisanumber' => $data['indiavisanumber'] ?? null,
                'indiavisaissueplace' => $data['indiavisaissueplace'] ?? null,
                'indiadateofissue' => $data['indiadateofissue'] ?? null,
                'india_travel_details' => $data['india_travel_details'] ?? null,
                'criminalhistory' => $data['criminalhistory'] ?? null,
                'criminal_history' => $data['criminal_history'] ?? null,
                'deniedentryanywhere' => $data['deniedentryanywhere'] ?? null,
                'denied_entry_anywhere' => $data['denied_entry_anywhere'] ?? null,
                'securitybackgroundquestions' => $data['securitybackgroundquestions'] ?? null,
            ];
    
            $visa->visa_history_background = json_encode($travelHistory); 
        }

        if(($data['step']?? null)=='medical'){
            $medicalData = [
                'patient_name' => $data['patient_name'] ?? null,
                'medical_diagnosis' => $data['medical_diagnosis'] ?? null,
                'hospital_name' => $data['hospital_name'] ?? null,
                'hospital_address' => $data['hospital_address'] ?? null,
                'doctor_letter' => $data["doctor's_letter"] ?? null, // key with apostrophe
                'treatment_duration' => $data['treatment_duration'] ?? null,
                'treatment_cost' => $data['treatment_cost'] ?? null,
                'attendant_name' => $data['attendant_name'] ?? null,
                'attendant_details' => $data['attendant_details'] ?? null,
            ];
              $visa->medical_visa_specifics = json_encode($medicalData);
          
        }

        if (($data['step']?? null) == 'studentvisaspecifics') {
            $studentVisaData = [
                'course_name' => $data['course_name'] ?? null,
                'institution_name' => $data['institution_name'] ?? null,
                'institution_address' => $data['institution_address'] ?? null,
                'institution_phone' => $data['institution_phone'] ?? null,
                'sevis_id' => $data['sevis_id'] ?? null,
                'tuition_fee_estimate' => $data['tuition_fee_estimate'] ?? null,
                'living_expenses_estimate' => $data['living_expenses_estimate'] ?? null,
                'attendant_name' => $data['attendant_name'] ?? null,
                'financial_sponsor_name' => $data['financial_sponsor_name'] ?? null,
                'sponsor_details' => $data['sponsor_details'] ?? null,
            ];      
            $visa->student_visa_specifics = json_encode($studentVisaData);
        }
   

        if (($data['step']?? null) == 'accommondation') {
            $accommodationData = [
                'accommodation_type' => $data['accommodation_type'] ?? null,
                'hotel_name' => $data['hotel_name'] ?? null,
                'accommodation_host_name' => $data['accommodation_host_name'] ?? null,
                'full_address_of_stay' => $data['full_address_of_stay'] ?? null,
                'Contact_number_of_hotel' => $data['Contact_number_of_hotel'] ?? null,
                'contact_number_of_host' => $data['contact_number_of_host'] ?? null,
                'relationship_to_host' => $data['relationship_to_host'] ?? null,
            ];
        
            $visa->accommodation_details = json_encode($accommodationData);
        }

        if (($data['step']?? null) == 'hostsponsor') {
            $hostSponsorData = [
                'host_Full_name' => $data['host_Full_name'] ?? null,
                'company_name' => $data['company_name'] ?? null,
                'relationship_to_applicant' => $data['relationship_to_applicant'] ?? null,
                'host_address' => $data['host_address'] ?? null,
                'host_phone_number' => $data['host_phone_number'] ?? null,
                'host_email' => $data['host_email'] ?? null,
                'company_registration' => $data['company_registration'] ?? null,
                'invitation_letter' => $data['invitation_letter'] ?? null,
            ];
        
            $visa->host_sponsor_inviter_details = json_encode($hostSponsorData);
        }
    
        if (($data['step']?? null) == 'financial') {
    
            $financialData = [
                'funding_source' => $data['funding_source'] ?? null,
                'sponsor_name' => $data['sponsor_name'] ?? null,
                'Financial_host_name' => $data['Financial_host_name'] ?? null,
                'financial_documents' => $data['financial_documents'] ?? null,
                'financial_monthly_income' => $data['financial_monthly_income'] ?? null,
                'means_of_financial_support' => $data['means_of_financial_support'] ?? null,
                'travel_insurance_company' => $data['travel_insurance_company'] ?? null,
                'travel_insurance_policy_number' => $data['travel_insurance_policy_number'] ?? null,
                'insurance_validity' => $data['insurance_validity'] ?? null,
            ];
        
            $visa->financial_support_details = json_encode($financialData);
        }
    

        // Common assignments for both new and existing records
        $visa->type_of_visa_required = $data['visatype'] ?? $visa->type_of_visa_required;
        $visa->number_of_entries = $data['noofentries'] ?? $visa->number_of_entries;
        $visa->period_of_visa_month = $data['periodofvisa'] ?? $visa->period_of_visa_month;
        $visa->expected_date_of_journey = $data['expecteddate'] ?? $visa->expected_date_of_journey;
        $visa->port_of_arrival = $data['portofarrival'] ?? $visa->port_of_arrival;
        $visa->port_of_exit = $data['portofexit'] ?? $visa->port_of_exit;
        $visa->places_to_be_visited = $data['placeofvisit'] ?? $visa->places_to_be_visited;
        $visa->purpose_of_visit = $data['purposeofvisit'] ?? $visa->purpose_of_visit;

        // backgroudhistory
        $visa->visa_history_background =  $visa->visa_history_background ??  $visa->visa_history_background;
        $visa->medical_visa_specifics = $visa->medical_visa_specifics ?? $visa->medical_visa_specifics;
        $visa->student_visa_specifics = $visa->student_visa_specifics ?? $visa->student_visa_specifics;
        $visa->accommodation_details =  $visa->accommodation_details ?? $visa->accommodation_details;
        $visa->host_sponsor_inviter_details = $visa->host_sponsor_inviter_details ?? $visa->host_sponsor_inviter_details;
        $visa->financial_support_details = $data->financial_support_details ?? $visa->financial_support_details;


    
        $visa->previous_visa_number = $data['previous_visa_number'] ?? $visa->previous_visa_number;
        $visa->previous_visa_issued_place = $data['previous_visa_place'] ?? $visa->previous_visa_issued_place;
        $visa->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? $visa->previous_visa_issue_date;
        $visa->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? $visa->countries_visited_last_10_years;
        $visa->otherdocument = $data['otherdocument'] ?? $visa->otherdocument;
        $visa->visa_refused_or_deported = $data['visa_refused_or_deported'] ?? $visa->visa_refused_or_deported;
    
        $visa->save();
    }
    
}
