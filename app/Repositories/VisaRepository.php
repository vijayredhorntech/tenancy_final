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
use App\Models\UserServiceAssignment;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewFormNotification;
use App\Mail\VisaApplicationMail;



class VisaRepository implements VisaRepositoryInterface
{
    
    protected $fileUploadService;
    protected $agencyService;
    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->agencyService = $agencyService;
    }

    public function getAllCountry(){

       return Country::paginate(10);
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
            foreach ($data['subtype'] as $key => $subtypeName) {
                VisaSubtype::create([
                    'visa_type_id' => $visa->id, // Assuming Visa Type ID is the VisaService ID
                    'name' => $subtypeName,
                    'price' => $data['subtypeprice'][$key],
                    'commission' => $data['commission'][$key],
                    'status' => 1 // Default status as active
                ]);
            }
    
            return $visa;
        });
    }
    

/***** Assign Visa to Country ********/
public function assignVisaToCountry(array $data)
{
 
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

        return $assign;
    });
}


public function getVisabySearch($origin,$destination){
    return VisaServiceType::with('VisaServices','Subvisas')->where('origin',$origin)->where('destination',$destination)->get();
}


public function getVisabySearchcoutnry($id){
    return VisaServiceType::where('id',$id)->first();
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
    $application = strtolower($originCode . '-' . $destinationCode . '-' . now()->format('ymdHis') . '-' . Str::random(3));

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
        foreach ($data['passengerfirstname'] as $index => $firstname) {
            $authapplication = new AuthervisaApplication();
            $authapplication->booking_id = $booking->id;
            $authapplication->clint_id = $data['clientId']; // Change this if clint_id is different
            $authapplication->name = $firstname; // Assign first name dynamically
            $authapplication->lastname = $data['passengerfirstname'][$index].$data['passengerlastname'][$index];
            $authapplication->passport_number = $data['passengerpassportn'][$index];
            $authapplication->passport_issue_date = $data['passportissuedate'][$index];
            $authapplication->passport_expire_date = $data['passportexpiredate'][$index];
            $authapplication->place_of_issue = $data['passengerplace'][$index]; // Assign last name dynamically
            $authapplication->save();
        }
    }
    
  

      // Fetch agency based on the current user
    //   $agency = Agency::where('id', Auth::id())->firstOrFail(); 
      $balance = Balance::where('agency_id', $agency->id)->first();
  
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
  
      // Create deduction record
      $deduction = new Deduction();
      $deduction->agency_id = $agency->id;
      $deduction->service = '3';
      $deduction->invoice_number = $application;
      $deduction->flight_booking_id = $booking->id;
      $deduction->amount = $totalAmount;
      $deduction->date = now();
      $deduction->save();
  
      return $booking; // Return the saved booking object
  }


  public function getBookingByid($id,$type){
    
    if($type=="all"){

    return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint'])
    ->where('agency_id', $id)
    ->orderBy('created_at', 'desc') // Orders by latest created_at first
    ->paginate(10);
  }else if($type=="documentpending"){
    return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint'])
    ->where('agency_id', $id)
    ->where('document_status','Pending')
    ->orderBy('created_at', 'desc') // Orders by latest created_at first
    ->paginate(10);
  }elseif($type=="feepending")
    return VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint'])
    ->where('agency_id', $id)
    ->where('payment_status','Pending')
    ->orderBy('created_at', 'desc') // Orders by latest created_at first
    ->paginate(10);
    //  return VisaBooking::get('visa')->get();
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
            // Debugging (optional, can be removed)
            // dd($data);
    
            if (isset($data['form_uploade'])) {
                $authUserId = auth()->id();
                
                // Upload the file
                $uploadedFilePath = $this->fileUploadService->uploadFile(
                    $data['form_uploade'], 
                    'images/visa/forms/', 
                    $authUserId
                );
                $path = "images/visa/forms/" . $uploadedFilePath;
    
                // Save document
                $new = new Document();
                $new->form_name = $data['name'];
                $new->form_description = $data['description'] ?? null; // Handle null case
                $new->document = $path;
                $new->save();
    
                // Save visa service type document
                $service = new VisaServiceTypeDocument();
                $service->visa_id  = '1';
                $service->form_id  = $new->id;
                $service->origin_id  = $data['origincoutnry'];
                $service->destination_id   = $data['destination'];
                $service->description  = $data['description'];
                $service->fee = '0' ?? null; // Handle null case

                $service->save();
    
                 // Fetch all agencies
                 $agencies = UserServiceAssignment::with('agency')->where('service_id','3')->get();
                 foreach ($agencies as $agency) {
                    Mail::to($agency->agency->email)->queue(new NewFormNotification($new));
                }
                DB::commit(); // Commit transaction if everything is successful
    
                return response()->json(['message' => 'Form saved successfully'], 200);
            }
    
            return response()->json(['error' => 'No file uploaded'], 400);
            
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




    public function bookingDataById($id){
       $viewbooking=VisaBooking::with(['visa', 'origin', 'destination', 'visasubtype','clint.clientinfo','otherclients'])
        ->where('id', $id)
       ->first(); 
       return $viewbooking;
      
    }

    public function deleteVisa($id)
    {
        $visa=$this->getVisaById($id);
        $visa->delete(); 
    }


    public function assignUpdateBooking($id,$data){
   
        $visabooking=VisaBooking::where('id',$id)->first(); 

        $visabooking->document_status=$data['document_status']; 
        $visabooking->applicationworkin_status=$data['application_status']; 
        $visabooking->payment_status=$data['paymentstatus']; 
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

}
