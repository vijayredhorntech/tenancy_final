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
use App\Models\Invoice;
use App\Models\AmendmentHistory;


use App\Models\AuthervisaApplication;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Services\FileUploadService;
use Auth; 
use Illuminate\Support\Arr;

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
       $query = Country::query();
       if ($s = request('search')) {
           $query->where(function ($q) use ($s) {
               $q->where('countryName', 'like', "%{$s}%")
                 ->orWhere('countryCode', 'like', "%{$s}%");
           });
       }
       return $query->orderBy('countryName')->paginate(10)->withQueryString();
    }


public function getSuperadminAllApplication($request){
    // dd("heelo");
   $query = VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'agency', 'deduction']);

        // Base query
        $query->with(['downloadDocument', 'clientapplciation']) // clint will be overridden manually
              ->whereIn('sendtoadmin', [1, 3]) // Include both sent to admin (1) and updated applications (3)
              ->orderBy('created_at', 'desc');

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // Search inside the visa_bookings table / related tables
                $q->whereHas('deduction', function ($qd) use ($search) {
                        $qd->where('superadmin_invoice_number', 'like', "%{$search}%");
                    })
                    ->orWhere('application_number', 'like', "%{$search}%")
                    // OR search inside the related 'clint' model
                    ->orWhereHas('clint', function ($q1) use ($search) {
                        $q1->where('client_name', 'like', "%{$search}%")
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
        return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint','clientapplciation','deduction'])
        ->where('sendtoadmin', '0')
        ->where('display_notification', '1')
        ->orderBy('created_at', 'desc') // Orders by latest created_at first
        ->get();

    }

public function getSuperadminshotedapplication($request)
{
    // dd("heelo");
    
   $query = VisaBooking::with(['agency',
        'visa',
        'origin',
        'destination',
        'visasubtype',
 ]);

        // Base query
        $query->with(['downloadDocument', 'clientapplciation']) // clint will be overridden manually
              ->whereIn('sendtoadmin', [1, 3]) // Include both sent to admin (1) and updated applications (3)
              ->orderBy('created_at', 'desc');

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // Search inside the visa_bookings table
                $q->where('application_number', 'like', "%{$search}%")
                
                // OR search inside the related 'clint' model
                ->orWhereHas('clint', function ($q1) use ($search) {
                    $q1->where('client_name', 'like', "%{$search}%")
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
                // Use the SAME logic as bookingDataById() method
                $this->agencyService->setConnectionByDatabase($database);

                // Load the clint relation from the user-specific database
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

public function getagencyVisaApplication($request,$id)
{
    $query = VisaBooking::with([
        'visa',
        'origin',
        'destination',
        'visasubtype',
        'clint',
        'clientapplciation'
    ])
    ->whereIn('sendtoadmin', [1, 3]) // Include both sent to admin (1) and updated applications (3)
    ->where('agency_id',$id)
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
        return VisaServices::with('visaAssignCountries')->paginate(10);
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
    return VisaServiceType::with('Subvisas','origincountry','destinationcountry','VisaServices')->where('id',$id)->first();
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


//   public function allVisacoutnry($request){
//     return VisaServiceType::with('origincountry','destinationcountry','VisaServices','Subvisas')->get(); 
//   }

public function allVisacoutnry($request)
{
 
    $query = VisaServiceType::with(['origincountry', 'destinationcountry', 'VisaServices', 'Subvisas']);
    if (!empty($request->visatype)) {
        $query->where('visa_id', $request->visatype);
    }
    if (!empty($request->origincountry)) {
        $query->where('origin', $request->origincountry);
    }
    if (!empty($request->destinationcountry)) {
        $query->where('destination', $request->destinationcountry);
    }
    if (!empty($request->status)) {
        $query->where('required', $request->status);
    }
    if (!empty($request->date_from)) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }
    if (!empty($request->date_to)) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }
    $perPage = $request->per_page ?? 10;
    return $query->paginate($perPage);
}





public function saveBooking(array $data)
{
 
    // Get country codes
    // dd($data);
    $getCode = $this->getCountryCode($data['origin'], $data['destination']);
    $originCode = $getCode['origin_code'];
    $destinationCode = $getCode['destination_code'];

    // Subtype and amount calculation
    $subtype = VisaSubtype::where('id', $data['category'])->firstOrFail();
    //   dd($subtype);
    // $totalAmount = ($subtype->price ?? 0) + ($subtype->commission ?? 0);
    $price = (float) ($subtype->price ?? 0);
    $commission = (float) ($subtype->commission ?? 0);
    $gstPercent = (float) ($subtype->gstin ?? 0);

    $subtotal = $price + $commission;
    $gstAmount = ($subtotal * $gstPercent) / 100;
    $totalAmount = $subtotal + $gstAmount; // ✅ total including GST

    

    // Get agency, client details, user
    $agency = $this->agencyService->getAgencyData();
    $client_id = $data['clientId']; 
    $client_details = $this->agencyService->getClientDetails($client_id, $agency);
    $user = $this->agencyService->getCurrentLoginUser();
    
    // Use the agency's user_id from the main database instead of Auth::id()
    // This ensures we use a valid user ID that exists in the main database
    $mainDbUserId = $agency->user_id;
    
    // Ensure agency has a valid user_id
    if (!$mainDbUserId) {
        throw new \Exception('Agency does not have a valid user assigned. Please contact administrator.');
    }

    // Passenger count-based total amount
    // if (isset($data['passengerfirstname'])) {
    //     $passengerCount = count($data['passengerfirstname']) + 1;
    //     $totalAmount *= $passengerCount;
    // }
    $totalPassengers = 0;

        // Self
        if (!empty($data['applicant_type']) && in_array('self', $data['applicant_type'])) {
            $totalPassengers++;
        }

        // Family
        if (!empty($data['applicant_type']) && in_array('family', $data['applicant_type'])) {
            if (isset($data['family_passengerfirstname']) && is_array($data['family_passengerfirstname'])) {
                $totalPassengers += count($data['family_passengerfirstname']);
            }
        }

        // Additional Passengers (Add More)
        if (isset($data['passengerfirstname']) && is_array($data['passengerfirstname'])) {
            $totalPassengers += count($data['passengerfirstname']);
        }

        // Fallback to at least one passenger
        if ($totalPassengers === 0) {
            $totalPassengers = 1;
        }

        // Final total amount
        $totalAmount *= $totalPassengers;

        // dd($totalAmount);
    
     // Save booking first (without application number)
        // Save booking first (with temporary application number)
    $booking = new VisaBooking();
    $booking->origin_id = $data['origin'];
    $booking->destination_id = $data['destination'];
    $booking->visa_id = $data['typeof'];
    $booking->subtype_id = $data['category'];
    $booking->agency_id = $agency->id;
    $booking->user_id = $mainDbUserId; // Use agency's owner user ID from main database
    $booking->client_id = $data['clientId'];
    $booking->total_amount = $totalAmount;
    $booking->dateofentry = $data['dateofentry'];
    $booking->application_number = ''; // ✅ Temporary to pass NOT NULL
    $booking->save(); // Now ID is available
    
    // Generate application number
    $agencyInitial = strtoupper(substr($agency->name, 0, 1)); // First letter of agency name
    $application = "CLDA" . $agencyInitial . "I00" . $booking->id;

    // Update booking with real application number
    $booking->application_number = $application;
    $booking->save();

        // Save passenger details (additional passengers)
        if (isset($data['passengerfirstname'])) {
            foreach ($data['passengerfirstname'] as $index => $firstname) {
                $authapplication = new AuthervisaApplication();
                $authapplication->setConnection('user_database');
                $authapplication->booking_id = $booking->id;
                $authapplication->clint_id = $data['clientId'];
                $authapplication->name = $firstname;
                $authapplication->lastname = $data['passengerlastname'][$index];
                $authapplication->passport_number = $data['passengerpassportn'][$index];
                $authapplication->passport_issue_date = $data['passportissuedate'][$index];
                $authapplication->passport_expire_date = $data['passportexpiredate'][$index];
                $authapplication->place_of_issue = $data['passengerplace'][$index];
                $authapplication->save();
            }
        }

        // Save family member details
        if (isset($data['family_passengerfirstname'])) {
            foreach ($data['family_passengerfirstname'] as $index => $firstname) {
                $authapplication = new AuthervisaApplication();
                $authapplication->setConnection('user_database');
                $authapplication->booking_id = $booking->id;
                $authapplication->clint_id = $data['clientId'];
                $authapplication->name = $firstname;
                $authapplication->lastname = $data['family_passengerlastname'][$index];
                $authapplication->passport_number = $data['family_passengerpassportn'][$index] ?? null;
                $authapplication->citizenship = $data['family_passengerplace'][$index] ?? null; // Nationality
                $authapplication->phone = $data['family_passengerphonenumber'][$index] ?? null;
                $authapplication->save();
            }
        }

    return $booking;
}

public function updateBooking(array $data)
{

    $getCode = $this->getCountryCode($data['origin'], $data['destination']);
    $originCode = $getCode['origin_code'];
    $destinationCode = $getCode['destination_code'];

    // Subtype and amount calculation
    $subtype = VisaSubtype::where('id', $data['category'])->firstOrFail();
  
    $totalAmount = ($subtype->price ?? 0) + ($subtype->commission ?? 0);

    // Get agency, client details, user
    $agency = $this->agencyService->getAgencyData();
    $client_id = $data['clientId']; 
    $client_details = $this->agencyService->getClientDetails($client_id, $agency);
    $user = $this->agencyService->getCurrentLoginUser();

    $mainDbUserId = $agency->user_id;
    
    // Ensure agency has a valid user_id
    if (!$mainDbUserId) {
        throw new \Exception('Agency does not have a valid user assigned. Please contact administrator.');
    }

    // Passenger count-based total amount
    if (isset($data['passengerfirstname'])) {
        $passengerCount = count($data['passengerfirstname']) + 1;
        $totalAmount *= $passengerCount;
    }

    
     // Save booking first (without application number)
        // Save booking first (with temporary application number)
        
    $booking =VisaBooking::where('application_number', $data['applicationnumber'])->firstOrFail();
    if($booking->payment_status=='Paid'){
            /***Hisotry create  */
                AmendmentHistory::create([
                'origin_id'          => $booking->origin_id,
                'destination_id'     => $booking->destination_id,
                'visa_id'            => $booking->visa_id,
                'subtype_id'         => $booking->subtype_id,
                'agency_id'          => $booking->agency_id,
                'user_id'            => $booking->user_id,
                
                'application_id'         => $booking->id, // ✅ new field
                'booking_id'         => $booking->id, // ✅ new field
                'visa_type'          => $data['typeof'] ?? null, // if you store visa_type
                'application_number' => $booking->application_number,
                'total_price'        => $booking->total_amount,
                'dateofentry'        => $booking->dateofentry,
            ]);
             // dd($booking);
       if ($booking->visaDocSign) {
            $booking->visaDocSign->forceDelete();  // deletes permanently
        }
        }
   


    $booking->origin_id = $data['origin'];
    $booking->destination_id = $data['destination'];
    $booking->visa_id = $data['typeof'];
    $booking->subtype_id = $data['category'];
    $booking->total_amount = $totalAmount;


    
    $booking->agency_id = $agency->id;
    $booking->application_status = 'Pending';
    $booking->applicationworkin_status = 'Pending';
    $booking->document_status = 'Pending';
    $booking->payment_status = 'Pending';
    $booking->confirm_application = 0;

    
    
    $booking->user_id = $mainDbUserId; // Use agency's owner user ID from main database
    $booking->client_id = $data['clientId'];
    $booking->total_amount = $totalAmount;
    $booking->dateofentry = $data['dateofentry'];
    $booking->application_number = ''; // ✅ Temporary to pass NOT NULL
    $booking->isamendment = 1; // ✅ Temporary to pass NOT NULL

    
    $booking->save(); // Now ID is available
    
    // Generate application number
    $agencyInitial = strtoupper(substr($agency->name, 0, 1)); // First letter of agency name
    $application = "CLDA" . $agencyInitial . "I00" . $booking->id;

    // Update booking with real application number
    $booking->application_number = $application;
    $booking->save();

        // Save passenger details (additional passengers)
        if (isset($data['passengerfirstname'])) {
            foreach ($data['passengerfirstname'] as $index => $firstname) {
                $authapplication = new AuthervisaApplication();
                $authapplication->setConnection('user_database');
                $authapplication->booking_id = $booking->id;
                $authapplication->clint_id = $data['clientId'];
                $authapplication->name = $firstname;
                $authapplication->lastname = $data['passengerlastname'][$index];
                $authapplication->passport_number = $data['passengerpassportn'][$index];
                $authapplication->passport_issue_date = $data['passportissuedate'][$index];
                $authapplication->passport_expire_date = $data['passportexpiredate'][$index];
                $authapplication->place_of_issue = $data['passengerplace'][$index];
                $authapplication->save();
            }
        }

        // Save family member details
        if (isset($data['family_passengerfirstname'])) {
            foreach ($data['family_passengerfirstname'] as $index => $firstname) {
                $authapplication = new AuthervisaApplication();
                $authapplication->setConnection('user_database');
                $authapplication->booking_id = $booking->id;
                $authapplication->clint_id = $data['clientId'];
                $authapplication->name = $firstname;
                $authapplication->lastname = $data['family_passengerlastname'][$index];
                $authapplication->passport_number = $data['family_passengerpassportn'][$index] ?? null;
                $authapplication->citizenship = $data['family_passengerplace'][$index] ?? null; // Nationality
                $authapplication->phone = $data['family_passengerphonenumber'][$index] ?? null;
                $authapplication->save();
            }
        }

    return $booking;
}

//   public function payment($data){

   
//     $balance = Balance::where('agency_id', $data['agency_id'])->first();
//     $totalAmount=$data['total_amount'];
  
//     // If balance record does not exist, return an error
//     if (!$balance) {
    
//         throw new \Exception('Balance record not found.'); // Exception is better than dd()
//     }

//     $fundRemaining = $balance->balance;

//     // Check if agency has enough balance
//     if ($totalAmount > $fundRemaining) {
//       dd('Insufficient balance.');
//         throw new \Exception('Insufficient balance.'); // Exception is better than dd()
//     }

//     // Deduct amount from balance first
//     $balance->balance -= $totalAmount;
//     $balance->save();

//     $deduction = new Deduction();
//     $deduction->agency_id = $data['agency_id'];
//     $deduction->service = '3';
//     $deduction->invoice_number =  $data['application_number'];
//     $deduction->flight_booking_id = $data['id'];
//     $deduction->amount = $data['total_amount'];
//     $deduction->create_userid = $data['client_id'];
//     $deduction->client_id = $data['client_id'];
//     $deduction->displaynotification = 3;
//     $deduction->date = now();
//     $deduction->save();
//     return $deduction;

//   }

public function payment($data)
{
    // Validate incoming data
    if (!is_array($data) && !($data instanceof \ArrayAccess)) {
        throw new \Exception('Invalid data format.');
    }

    $balance = Balance::where('agency_id', $data['agency_id'])->first();
    $totalAmount = $data['total_amount'];

    if (!$balance) {
        throw new \Exception('Balance record not found.');
    }

    $fundRemaining = $balance->balance;

    if ($totalAmount > $fundRemaining) {
        throw new \Exception('Insufficient balance.');
    }

    // Deduct from agency balance
    $balance->balance -= $totalAmount;
    $balance->save();

    // ✅ Check if Deduction with same invoice_number (application_number) exists
    $deduction = Deduction::where('invoice_number', $data['application_number'])->first();

    if ($deduction) {
       
       
        // ✅ Update existing deduction
        $deduction->amount += $totalAmount;
        $deduction->invoicestatus = 'amendment';
        $deduction->updated_at = now();
    } else {
      
        // ✅ Create a new deduction
        $deduction = new Deduction();
        $deduction->agency_id = $data['agency_id'];
        $deduction->service = '3';
        $deduction->invoice_number = $data['application_number'];
        $deduction->flight_booking_id = $data['id'];
        $deduction->amount = $totalAmount;
        $deduction->create_userid = $data['client_id'];
        $deduction->client_id = $data['client_id'];
        $deduction->displaynotification = 3;
        $deduction->date = now();
    }

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
            ->whereIn('confirm_application', ['0', '2'])
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
        'visaapplicationlog',
        'clientrequiremtsinfo',
        'visarequireddocument',
        'visaInvoiceStatus.invoice',
        'visaInvoiceStatus.docsign.sign',
        'visaDocSign.docsign'


    ])->where('id', $id)->first();
    // dd($viewbooking);

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
        if ($visa) {
            $visa->forceDelete(); // 🔥 Permanently deletes the record
        }
    }



    public function assignUpdateBooking($id,$data){

      $visabooking=VisaBooking::with('agency')->where('id',$id)->first(); 


        if(isset($data['application_status'])){
            $visabooking->application_status=$data['application_status'];
            $visabooking->applicationworkin_status=$data['application_status'];
        }
         $visabooking->rejection_reason = $data['rejection_reason'] ?? null;
         $visabooking->custom_message = $data['custom_message'] ?? null;

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

    // public function storeClientDocuemtn($data){
  
    //     $bookingId = $data['booking_id'];
    //     //   dd($bookingId);
    //         foreach ($data['documents'] as $docId => $file) {
    //             $filename = $file->store('client/documents', 'public');


    //             // Example: store document path in DB
    //             ClientApplicationDocument::where('id', $docId)->update([
    //                 'document_file' => $filename,
    //                 'document_status' => 2, // Mark as uploaded
    //             ]);
    //         }
    //         return true;
       
    // }
   public function storeClientDocuemtn($data)
{
        $bookingId = $data['booking_id'];

        foreach ($data['documents'] as $docId => $file) {
            // Define destination folder inside public/images/client/documents
            $destinationPath = public_path('images/client/documents');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique filename
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Move file to the destination folder
            $file->move($destinationPath, $filename);

            // Save the relative path to DB (match public path)
            $relativePath = 'images/client/documents/' . $filename;

            ClientApplicationDocument::where('id', $docId)->update([
                'document_file' => $relativePath,
                'document_status' => 2,
            ]);
        }

        return true;
}



    public function getBookingBySingleId($id){

        $bookingData= VisaBooking::with(['visa','agency','origin', 'destination', 'visasubtype','otherclients','downloadDocument'])
        ->where('id', $id)
        ->first();
 
        
     $clientInfo = $this->agencyService->getClientinfoVisaBookingById($bookingData);
     return $clientInfo;
    }

    public function updateClientBooking($id,$data){
    
      $visabooking = VisaBooking::with('visasubtype', 'deduction', 'agency')
                ->where('id', $id)
                ->first();

    if (!$visabooking) {
        throw new \Exception("Visa booking not found.");
    }

    $clientInfo = $this->agencyService->getClientinfoVisaBookingById($visabooking);

    $basePrice = $visabooking->visasubtype->price + $visabooking->visasubtype->commission;

    if (isset($clientInfo->otherclients) && count($clientInfo->otherclients) > 0) {
        $price = $basePrice * (count($clientInfo->otherclients) + 1); 
        // +1 for the main client
    } else {
        $price = $basePrice;

    }

       $visabooking->total_amount = $price;
       $visabooking->amount = $basePrice;

       
        $visabooking->payment_status="Paid";
        $visabooking->confirm_application=1;
        $visabooking->save(); 

        $paymentInfo=$this->payment($visabooking);
        $this->saveInvoice($visabooking,$paymentInfo);


    

        if (isset($clientInfo->otherclients)) {
                $agency = $this->agencyService->getAgencyData();

                foreach ($clientInfo->otherclients as $i => $memberId) {
            
                    $index = $i + 1;
                    $newBooking = $visabooking->replicate(); // clone the existing booking
                    $newBooking->client_id = $visabooking->client_id;
                    $newBooking->otherclientid = $memberId->id; // link to original client
                    $newBooking->application_number = '';
                    
                    // Using loop index instead of memberId
                    $agencyInitial = strtoupper(substr($agency->name, 0, 1)); 
                    $application = "CLDA" . $agencyInitial . "I00" . ($visabooking->id + $index);

                    $newBooking->application_number = $application;
                    $newBooking->save();

                    $this->payment($newBooking);
                }
    }
        return true;
    }

    public function createClientBooking($id, $data)
    {
        // dd("heelo0");
        $visabooking = VisaBooking::with('visasubtype','deduction')->where('id', $id)->first(); 
    
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
                $agency = $this->agencyService->getAgencyData();

            foreach ($data['othermember'] as $memberId) {
                
                $newBooking = $visabooking->replicate(); // Clone
                 $agencyInitial = strtoupper(substr($agency->name, 0, 1)); // First letter of agency name
              $application = "CLDA" . $agencyInitial . "I00" . $newBooking->id+ $memberId;
                $newBooking->client_id = $visabooking->client_id;
                $newBooking->otherclientid = $memberId;
                $newBooking->application_number = $application;
                $newBooking->save();
                $this->payment($newBooking);
            }
        }
    
        return true;
    }
    

    public function saveInvoice($data ,$paymentInfo){
        
               
                $getClientData = $this->agencyService->getClientinfoVisaBookingById($data);
               
                $agency = $this->agencyService->getAgencyData();
                
               $latestInvoice = Invoice::where('agency_id', $agency->id)
                    ->latest() // orders by created_at by default
                    ->first();
                    $agencyInitial = strtoupper(substr($agency->name, 0, 1)); // First letter of agency name
                    $nextId = $latestInvoice ? $latestInvoice->id + 1 : 1;
                    $application = "CLDA" . $agencyInitial . "I00" . $nextId;
         
                      $existingInvoice = Invoice::where('agency_id', $agency->id)
                       ->where('applicant_id', $getClientData->id)
                       ->where('type','agency')
                       ->first();

                        if($existingInvoice){
                            $existingInvoice->update([
                                'amount'     => $getClientData->total_amount,
                                'discount'     => '0.0',
                                'visa_fee'     => '0.0',
                                'service_charge'=>'0.0',
                                'new_price'=>'0.0',
                                'status'=>'amendment',
                            ]);
                            return $existingInvoice;
                        }


         
         
          $invoiceData = [
                'receiver_name'      => $getClientData->client->client_name,
                'invoice_date'       => now()->toDateString(),
                'invoice_number'     => $application,
                'agency_id'          => $agency->id,
                'client_id'          => $getClientData->client->id,
                'bookingid'          => $paymentInfo->id, 
                'service_id'         => 3,
                'applicant_id'       => $getClientData->id,
                'amount'             => $getClientData->total_amount,
                'type'               => 'agency',
               ];
                $invoice=Invoice::create($invoiceData);
                return $invoice; 
    }

    /****Store Application Log ***** */

    public function createApplicationLog($booking,$newData){


       $ignoreFields = ['_token', '_method', 'bookingid'];
        $oldData = [];
       // Main booking model
        $oldData = array_merge($oldData, $booking->getAttributes());
       // Add clint model if exists
        if ($booking->clint) {
            $oldData = array_merge($oldData, $booking->clint->getAttributes());

            // Add clientinfo inside clint
            if ($booking->clint->clientinfo) {
                $oldData = array_merge($oldData, $booking->clint->clientinfo->getAttributes());
            }
        }

        // Add clientrequiremtsinfo directly (flat)
        if ($booking->clientrequiremtsinfo) {
            $oldData = array_merge($oldData, $booking->clientrequiremtsinfo->getAttributes());
        }

        // Step 2: Compare and log changes
        foreach ($newData as $key => $newValue) {
            if (in_array($key, $ignoreFields)) {
                continue; // Skip ignored/system fieldsF
            }

            $oldValue = Arr::get($oldData, $key);

            // Skip logging if the field doesn't exist in the original model
            if (is_null($oldValue)) {
                continue;
            }

            $oldValue = trim((string) $oldValue);
            $newValue = is_null($newValue) ? null : trim((string) $newValue);

            // Only log if changed
            if ($oldValue !== $newValue) {
                \App\Models\VisaApplicationLog::create([
                    'booking_id' => $booking->id,
                    'application_number' => $booking->application_number,
                    'field_name' => $key,
                    'old_value' => $oldValue,
                    'new_value' => $newValue,
                    'type' => $newData['type'] === 'superadmin' ? 'superadmin' : 'agency',
                ]);
            }
        }

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
    
    /**
     * Store client application data
     */
    public function storeClientApplicationData($bookingId, $applicationData)
    {
        $booking = VisaBooking::find($bookingId);
        
        if (!$booking) {
            throw new \Exception('Booking not found');
        }
        
        // Update client details if provided
        if (isset($applicationData['client_details'])) {
            $client = ClientDetails::find($booking->client_id);
            if ($client) {
                $client->update($applicationData['client_details']);
            }
        }
        
        // Update client info if provided
        if (isset($applicationData['passport_details'])) {
            $clientInfo = $booking->clientinfo;
            if ($clientInfo) {
                $clientInfo->update([
                    'passport_ic_number' => $applicationData['passport_details']['passport_number'] ?? $clientInfo->passport_ic_number,
                    'passport_issue_place' => $applicationData['passport_details']['passport_issue_place'] ?? $clientInfo->passport_issue_place,
                    'passport_issue_date' => $applicationData['passport_details']['passport_issue_date'] ?? $clientInfo->passport_issue_date,
                    'passport_expiry_date' => $applicationData['passport_details']['passport_expiry_date'] ?? $clientInfo->passport_expiry_date,
                    'religion' => $applicationData['passport_details']['religion'] ?? $clientInfo->religion,
                    'past_nationality' => $applicationData['passport_details']['nationality'] ?? $clientInfo->past_nationality,
                ]);
            }
        }
        
        return true;
    }


    public function getBookingByClientId($clientId)
    {
        return VisaBooking::where('client_id', $clientId)->get();
    }

    /****Get Visa BY Application Number */

    public function getBookingByApplicationNumber($applicationNumber){
             return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype', 'deduction'])->where('application_number', $applicationNumber)->first();
    }
}
