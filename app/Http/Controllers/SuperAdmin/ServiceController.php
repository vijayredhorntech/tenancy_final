<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Http\Requests\FlightSearchRequest;
use App\Models\Deduction;
use App\Models\VisaBooking;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;
use App\Models\FlightBooking;
use App\Models\PassengerInformation;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Airport;
use App\Models\AgencyDetail;
use App\Models\TermsCondition;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Country;
use App\Models\RequestApplication;
use App\Services\AgencyService;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Repositories\Interfaces\VisaRepositoryInterface;







use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Traits\ClientTrait;

use Auth;

class ServiceController extends Controller
{

    
    use ClientTrait;

    protected $clintRepository,$agencyService,$visaRepository;

     public function __construct( AgencyService $agencyService,VisaRepositoryInterface $visaRepository,ClintRepositoryInterface $clintRepository,) {
       
        $this->agencyService = $agencyService;
        $this->visaRepository = $visaRepository;
        $this->clintRepository = $clintRepository;

    }
    
 /**** */

/*****Flight Serach Function **** */
 public function him_flight(){

 
    // $id = Auth::user()->id;
    // dd($id); 
    $data = session()->all();

    $userData = \session('user_data');
    DatabaseHelper::setDatabaseConnection($userData['database']);
    
    // $user = User::on('user_database')->where('id', $id)->first();
    $user = User::on('user_database')->where('email', $userData['email'])->first();
  
    if($user->type=="staff"){
        $agency_record=Agency::where('database_name',$userData['database'])->first(); 
        $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    }else{
        $agency_record=Agency::where('email',$user->email)->first(); 
        $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    }
   
    $services = $agency->userAssignments->pluck('service.name', 'service.icon');


    return view('agencies.pages.flight.flight',[
        'user_data' => $user,
        'services' => $services,
        'agency'=>$agency_record,
        'all_agency'=>$agency
        ]);
 }


/****For Flight Price  ****/



/****For passangerDetails  */
public function passengerDetails(Request $request){

 

       $details = json_decode($request->details);
        $flightSearch =json_decode($request->flightSearch);
        $service=Service::where('name','Flight')->first();

    
        // $userData = session('user_data');
        // $agency = Agency::where('email', $userData['email'])->first();

        // DatabaseHelper::setDatabaseConnection($userData['database']);
        
        // // $user = User::on('user_database')->where('id', $id)->first();
        // $user = User::on('user_database')->where('email', $userData['email'])->first();
      
        // if($user->type=="staff"){
        //     $agency_record=Agency::where('database_name',$userData['database'])->first(); 
        //     $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        // }else{
        //     $agency_record=Agency::where('email',$user->email)->first(); 
        //     $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        // }

        // echo "Heelo";
        // dd($agency);

       $agency = $this->agencyService->getAgencyData();

     

        
                
        if($agency==null){
           
            $balance=0;
           return view('agencies.pages.flight.frontend.passengerdetails')
              ->with('details', $details)->with('flightSearch', $flightSearch)
            ->with('service', $service)
            ->with('canbook',true)
            ->with('balance', $balance);
           
        }

        $balance = Balance::where('agency_id', $agency->id)->first();

        return view('agencies.pages.flight.passengerdetails')
        ->with('details', $details)->with('flightSearch', $flightSearch)
        ->with('service', $service)
        ->with('canbook',false)
        ->with('balance', $balance);

}



public function hs_flightRequest(Request $request)
{
    try {
        // Debug information - this should appear in logs if function is called
        \Log::info('=== HS_FLIGHTREQUEST FUNCTION CALLED ===');
        \Log::info('Flight request method called', [
            'method' => $request->method(),
            'url' => $request->url(),
            'route_name' => $request->route()->getName(),
            'has_data' => $request->has('details'),
            'session_data' => session()->all(),
            'request_data' => $request->all()
        ]);

        // Retrieve session data
        $price_data = json_decode($request->details);
        $userData = session('user_data');

        // Check if user is logged in as agency
        $user = null;
        $agency = null;

        if ($userData && isset($userData['database']) && isset($userData['email'])) {
            $user = $this->agencyService->getCurrentLoginUser();
            $agency = $this->agencyService->getAgencyData();
        }

        if (!$agency) {
            $allSessionData = session()->all();
            \Log::info('Session data: ' . json_encode($allSessionData));

            if (isset($allSessionData['agency_domain'])) {
                $agencyData = Agency::with('domains')
                    ->whereHas('domains', function ($query) use ($allSessionData) {
                        $query->where('domain_name', $allSessionData['agency_domain']);
                    })
                    ->first();

                if ($agencyData) {
                    $agency = $agencyData;
                    \Log::info('Agency found from session domain: ' . $agency->name . ' (ID: ' . $agency->id . ')');
                } else {
                    \Log::info('No agency found for session domain: ' . $allSessionData['agency_domain']);
                }
            } else {
                \Log::info('No agency_domain in session');
            }
        }

        if (!$agency) {
            \Log::info('No agency found - processing as homepage user without agency');
        }

        $data = $request->all();

        // Log the received data
        \Log::info('=== COMPLETE REQUEST DATA DEBUG ===');
        \Log::info('Received request data: ' . json_encode($data));

        // Validation
        if (!isset($data['adultFirstName'])) {
            return response()->json(['error' => 'Missing adultFirstName field'], 400);
        }
        if (!is_array($data['adultFirstName'])) {
            return response()->json(['error' => 'adultFirstName must be an array'], 400);
        }
        if (empty($data['adultFirstName'])) {
            return response()->json(['error' => 'adultFirstName array cannot be empty'], 400);
        }
        if (!isset($data['adultLastName'])) {
            return response()->json(['error' => 'Missing adultLastName field'], 400);
        }
        if (!is_array($data['adultLastName'])) {
            return response()->json(['error' => 'adultLastName must be an array'], 400);
        }
        if (empty($data['adultLastName'])) {
            return response()->json(['error' => 'adultLastName array cannot be empty'], 400);
        }

        $adults = [];
        $children = [];
        $infants = [];

        $adultCount = count($data['adultPrefix'] ?? []);
        $childCount = count($data['childTitle'] ?? []);
        $infantCount = count($data['infantPrefix'] ?? []);

        $clientData = [
            "agency_id"        => $agency ? $agency->id : null,
            "first_name"       => $data['adultFirstName']['0'] ?? null,
            "last_name"        => $data['adultLastName']['0'] ?? null,
            "email"            => $data['email'] ?? null,
            "phone_number"     => $data['phone'] ?? null,
            "nationality"      => $data['adultnationality']['0'] ?? null,
            "zip_code"         => $data['postcode'] ?? null,
            "address"          => $data['addressLine1'] ?? null,
            "permanent_address"=> $data['addressLine2'] ?? null,
            "street"           => $data['state'] ?? null,
            "city"             => $data['city'] ?? null,
            "country"          => $data['country'] ?? null,
        ];

        if ($agency) {
            $this->clintRepository->getStoreclint($clientData);
        }

        // Process Adults
        for ($i = 0; $i < $adultCount; $i++) {
            $adults[] = [
                'prefix'            => $data['adultPrefix'][$i] ?? null,
                'firstName'         => $data['adultFirstName'][$i] ?? null,
                'middleName'        => $data['adultMiddleName'][$i] ?? null,
                'lastName'          => $data['adultLastName'][$i] ?? null,
                'gender'            => $data['adultGender'][$i] ?? null,
                'dob'               => $data['adultDateOfBirth'][$i] ?? null,
                'seatingPreference' => $data['adultSeatingPreference'][$i] ?? null,
                'assistance'        => $data['adultAssistance'][$i] ?? null,
                'mealPreference'    => $data['adultMealPreference'][$i] ?? null,
            ];
        }

        // Process Children
        for ($i = 0; $i < $childCount; $i++) {
            $children[] = [
                'title' => $data['childTitle'][$i] ?? null,
                'firstName' => $data['childFirstName'][$i] ?? null,
                'middleName' => $data['childMiddleName'][$i] ?? null,
                'lastName' => $data['childLastName'][$i] ?? null,
                'gender' => $data['childGender'][$i] ?? null,
                'dob' => $data['childDateOfBirth'][$i] ?? null,
                'seatingPreference' => $data['childSeatingPreference'][$i] ?? null,
                'assistance' => $data['childAssistance'][$i] ?? null,
                'mealPreference' => $data['childMealPreference'][$i] ?? null,
            ];
        }

        // Process Infants
        for ($i = 0; $i < $infantCount; $i++) {
            $infants[] = [
                'prefix' => $data['infantPrefix'][$i] ?? null,
                'firstName' => $data['infantFirstName'][$i] ?? null,
                'middleName' => $data['infantMiddleName'][$i] ?? null,
                'lastName' => $data['infantLastName'][$i] ?? null,
                'gender' => $data['infantGender'][$i] ?? null,
                'dob' => $data['infantDateOfBirth'][$i] ?? null,
                'seatingPreference' => $data['infantSeatingPreference'][$i] ?? null,
                'assistance' => $data['infantAssistance'][$i] ?? null,
                'mealPreference' => $data['infantMealPreference'][$i] ?? null,
            ];
        }

        try {
            // Store request in request_applications
            $requestApplicationData = [
                'service_type' => 'Flight',
                'agency_id' => $agency ? $agency->id : null,
                'country_id' => 0,
                'visa_id' => 0,
                'visa_subtype' => 0,
                'first_name' => $data['adultFirstName'][0] ?? $data['adultFirstName'] ?? 'N/A',
                'last_name' => $data['adultLastName'][0] ?? $data['adultLastName'] ?? 'N/A',
                'full_name' => ($data['adultFirstName'][0] ?? $data['adultFirstName'] ?? '') . ' ' . ($data['adultLastName'][0] ?? $data['adultLastName'] ?? ''),
                'email' => $data['email'] ?? 'N/A',
                'phone_number' => $data['phone'] ?? 'N/A',
                'nationality' => $data['adultnationality'][0] ?? $data['adultnationality'] ?? 'N/A',
                'zipcode' => $data['postcode'] ?? 'N/A',
                'address' => $data['addressLine1'] ?? 'N/A',
                'city' => $data['city'] ?? 'N/A',
                'date_of_entry' => now()->format('Y-m-d'),
                'status' => 'pending',
                'adultdetails' => count($adults),
                'childrendetails' => count($children),
                'infantsdetails' => count($infants),
                'details' => $request->details,
                'flightserach' => json_encode($request->flightSearch),
            ];

            RequestApplication::create($requestApplicationData);

            if (!$agency) {
                return redirect()->route('visa.thank-you')
                    ->with('success', 'Your flight request has been submitted successfully! We will contact you soon.');
            }

            try {
                // Booking, Passenger, Balance, Deduction logic...
                // (Your existing logic remains here)
            } catch (\Exception $e) {
                \Log::error('Error in hs_flightRequest (booking): ' . $e->getMessage());
                return response()->json(['error' => 'Failed to process flight request: ' . $e->getMessage()], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Error in hs_flightRequest (requestApplication): ' . $e->getMessage());
            return response()->json(['error' => 'Failed to save flight request: ' . $e->getMessage()], 500);
        }

    } catch (\Exception $e) {
        \Log::error('Error in hs_flightRequest (outer): ' . $e->getMessage());
        return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
    }
}

    public function payment(Request $request)
{
    // Debug information
    \Log::info('Payment method called', [
        'method' => $request->method(),
        'url' => $request->url(),
        'has_data' => $request->has('details'),
        'session_data' => session()->all(),
        'request_data' => $request->all()
    ]);

    // Check if this is a direct GET request (which shouldn't happen)
    if ($request->isMethod('get')) {
        return response()->json(['error' => 'Invalid request method. This endpoint expects POST data.'], 405);
    }

    // Check if required data is present
    if (!$request->has('details') || !$request->has('flightSearch')) {
        return response()->json(['error' => 'Missing required flight data'], 400);
    }

    // Retrieve session data
    $price_data=json_decode($request->details);
    $userData = session('user_data');
    
    // Check if user data exists in session
    if (!$userData) {
        return response()->json(['error' => 'User session not found. Please try logging in again.'], 401);
    }
    
    // DatabaseHelper::setDatabaseConnection($userData['database']);
    
    // $user = User::on('user_database')->where('id', $id)->first();
    // $user = User::on('user_database')->where('email', $userData['email'])->first();
       $user = $this->agencyService->getCurrentLoginUser();
            $agency = $this->agencyService->getAgencyData();

    // If agency service fails, try alternative method
    if (!$agency && isset($userData['email'])) {
        $agency = Agency::where('email', $userData['email'])->first();
    }
    
    // If still no agency, try with domain
    if (!$agency && isset($userData['domain'])) {
        $agency = Agency::whereHas('domains', function ($query) use ($userData) {
            $query->where('domain_name', $userData['domain']);
        })->first();
    }

    if (!$agency) {
        return response()->json(['error' => 'Agency not found. Please ensure you are logged in as an agency.'], 404);
    }


 
    $data = $request->all(); // Use $request->all() as $data
 


    $adults = [];
    $children = [];
    $infants = [];

    $adultCount = count($data['adultPrefix'] ?? []);
    $childCount = count($data['childTitle'] ?? []);
    $infantCount = count($data['infantPrefix'] ?? []);

      $clientData = [
                    "agency_id"        => $agency ? $agency->id : null,
                    "first_name"       => $data['adultFirstName']['0'] ?? null,
                    "last_name"        => $data['adultLastName']['0'] ?? null,
                    "email"            => $data['email'] ?? null,
                    "phone_number"     => $data['phone'] ?? null,
                    "nationality"      => $data['adultnationality']['0'] ?? null,
                    "zip_code"         => $data['postcode'] ?? null,
                    "address"          => $data['addressLine1'] ?? null,
                    "permanent_address"=> $data['addressLine2'] ?? null,
                    "street"           => $data['state'] ?? null,
                    "city"             => $data['city'] ?? null,
                    "country"          => $data['country'] ?? null,
                ];

                // Only store client if agency exists
                if ($agency) {
                    $this->clintRepository->getStoreclint($clientData);
                }

    // Process Adults
    $adultCount = count($data['adultPrefix'] ?? []);
    for ($i = 0; $i < $adultCount; $i++) {
        $adults[] = [
            'prefix'            => $data['adultPrefix'][$i] ?? null,
            'firstName'         => $data['adultFirstName'][$i] ?? null,
            'middleName'        => $data['adultMiddleName'][$i] ?? null,
            'lastName'          => $data['adultLastName'][$i] ?? null,
            'gender'            => $data['adultGender'][$i] ?? null,
            'dob'               => $data['adultDateOfBirth'][$i] ?? null,
            'seatingPreference' => $data['adultSeatingPreference'][$i] ?? null,
            'assistance'        => $data['adultAssistance'][$i] ?? null,
            'mealPreference'    => $data['adultMealPreference'][$i] ?? null,
        ];
    }

    // Process Children
    $childCount = count($data['childTitle'] ?? []);
    for ($i = 0; $i < $childCount; $i++) {
        $children[] = [
            'title' => $data['childTitle'][$i] ?? null,
            'firstName' => $data['childFirstName'][$i] ?? null,
            'middleName' => $data['childMiddleName'][$i] ?? null,
            'lastName' => $data['childLastName'][$i] ?? null,
            'gender' => $data['childGender'][$i] ?? null,
            'dob' => $data['childDateOfBirth'][$i] ?? null,
            'seatingPreference' => $data['childSeatingPreference'][$i] ?? null,
            'assistance' => $data['childAssistance'][$i] ?? null,
            'mealPreference' => $data['childMealPreference'][$i] ?? null,
        ];
    }

    // Process Infants
    $infantCount = count($data['infantPrefix'] ?? []);
    for ($i = 0; $i < $infantCount; $i++) {
        $infants[] = [
            'prefix' => $data['infantPrefix'][$i] ?? null,
            'firstName' => $data['infantFirstName'][$i] ?? null,
            'middleName' => $data['infantMiddleName'][$i] ?? null,
            'lastName' => $data['infantLastName'][$i] ?? null,
            'gender' => $data['infantGender'][$i] ?? null,
            'dob' => $data['infantDateOfBirth'][$i] ?? null,
            'seatingPreference' => $data['infantSeatingPreference'][$i] ?? null,
            'assistance' => $data['infantAssistance'][$i] ?? null,
            'mealPreference' => $data['infantMealPreference'][$i] ?? null,
        ];
    }

    // Fetch agency based on email
 
    //  if($user->type=="staff"){
    //     // dd("heelo");
    //         $agency_record=Agency::where('agency_database',$userData['database'])->first(); 
    //         $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    //     }else{
    //         $agency_record=Agency::where('email',$user->email)->first(); 
    //         $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    //     }
  


    try {
        // Generate unique booking & invoice numbers
        $now = Carbon::now();
        $dateTime = $now->format('Ymd-His'); // Format: YYYYMMDD-HHMMSS
        $randomPart = strtoupper(Str::random(4)); // Random 4-character string

        $bookingNumber = "BN-{$dateTime}-{$randomPart}";
        $invoiceNumber = "INV-{$dateTime}-{$randomPart}";

        // Create Flight Booking
        $flight = new FlightBooking();
        $flight->agnecy_email = $agency ? $agency->email : 'homepage@example.com';
        $flight->domain = $userData['domain'] ?? 'homepage';
        $flight->database = $userData['database'] ?? 'main';
        $flight->agency_id = $agency ? $agency->id : null;
        $flight->user_id = $user ? $user->id : null;
        $flight->booking_number = $bookingNumber;
        $flight->invoice_number = $invoiceNumber;
        $flight->details = $request->details;
        $flight->flightSearch = json_encode($request->flightSearch);
        $flight->save();

        // Create Passenger Information
        $passenger = new PassengerInformation();
        $passenger->agency_id = $agency ? $agency->id : null;
        $passenger->flight_booking_id = $flight->id;
        $passenger->booking_number = $bookingNumber;
        $passenger->invoice_number = $invoiceNumber;
        $passenger->adult = json_encode($adults);
        $passenger->children = json_encode($children);
        $passenger->infant = json_encode($infants);
        $passenger->postcode = $request->postcode;
        $passenger->address_line = $request->addressLine1;
        $passenger->address_line_2 = $request->addressLine2;
        $passenger->city = $request->city;
        $passenger->state = $request->state;
        $passenger->country = $request->country;
        $passenger->email_id = $request->email;
        $passenger->mobile = $request->phone;
        $passenger->save();

        // Store flight request in request_applications table
        $requestApplicationData = [
            'service_type' => 'Flight',
            'agency_id' => $agency ? $agency->id : null,
            'country_id' => 0, // For flights, we might not have specific country_id
            'visa_id' => 0, // Not applicable for flights
            'visa_subtype' => 0, // Not applicable for flights
            'first_name' => $data['adultFirstName']['0'] ?? 'N/A',
            'last_name' => $data['adultLastName']['0'] ?? 'N/A',
            'full_name' => ($data['adultFirstName']['0'] ?? '') . ' ' . ($data['adultLastName']['0'] ?? ''),
            'email' => $data['email'] ?? 'N/A',
            'phone_number' => $data['phone'] ?? 'N/A',
            'nationality' => $data['adultnationality']['0'] ?? 'N/A',
            'zipcode' => $data['postcode'] ?? 'N/A',
            'address' => $data['addressLine1'] ?? 'N/A',
            'city' => $data['city'] ?? 'N/A',
            'date_of_entry' => now()->format('Y-m-d'), // Use current date for flights
            'status' => 'pending',
            'adultdetails' => json_encode($adults),
            'childrendetails' => json_encode($children),
            'infantsdetails' => json_encode($infants),
            'details' => $request->details,
            'flightserach' => json_encode($request->flightSearch),
        ];

        // Create RequestApplication record
        RequestApplication::create($requestApplicationData);

        // Redirect to visa thank-you page (similar to visa flow)
        return redirect()->route('visa.thank-you')
            ->with('success', 'Your flight request has been submitted successfully!');


   
    } catch (\Exception $e) {
        dd($e);
        return response()->json(['error' => 'Failed to process booking: ' . $e->getMessage()], 500);
    }

}


/*** Invoice details ****/
public function hs_generateinvocie($invoice){
    // $invoice_number ="INV-20250220-080104-9ZMZ";

   $agency_data=AddBalance::with('agency')->where('invoice_number',$invoice)->first(); 

//    $termcondition=TermsCondition::where('name','super admin')->where('status',1)->first(); 
     $termcondition=TermsCondition::where('status',1)->first(); 

    // $flight=FlightBooking::where('invoice_number',$invoice_number)->first(); 
    // $flight_serach=json_decode($flight->flightSearch);
    // $details=json_decode($flight->details);
    $segment = request()->segment(1); // Gets the first segment
    
    if($segment=='agencies'){
        return view('agencies.pages.invoices.paymentInvoice',['agency_data'=>$agency_data,'termcondition'=>$termcondition]);
    }else{
         return view('superadmin.pages.invoice.paymentInvoice',['agency_data'=>$agency_data,'termcondition'=>$termcondition]);
    }
   
}


/*** Invoice details ****/
public function hs_invoice($invoice_number){
    // $invoice_number ="INV-20250220-080104-9ZMZ";

   
    $booking=Deduction::with('agency.details','flightBooking.passengersdetails')->where('invoice_number',$invoice_number)->first(); 
    //   dd($booking);
    // $agency_id=$booking->agency->id;
    // $agency_address=AgencyDetail::where('agency_id',$agency_id)->first();
    // $termcondition=TermsCondition::where('name','agency')->where('status',1)->first(); 
    $termcondition=TermsCondition::where('status',1)->first(); 
    // $passenger_deatils=PassengerInformation::where('invoice_number',$invoice_number)->first(); 

    // $adults=json_decode($passenger_deatils->adult, true);
    // $children=json_decode($passenger_deatils->children, true);
    // $infants=json_decode($passenger_deatils->infant, true);
   

    // $details = json_decode($flight->details, true);
    // $flight_search = json_decode($flight->flightSearch, true);
  


    $segment = request()->segment(1); // Gets the first segment

   
    if($segment=='agencies'){
        return view('agencies.pages.invoices.flightinvoice',[
            'booking'=>$booking,
            'termcondition'=>$termcondition,
        ]);
        // return view('agencies.pages.invoices.paymentInvoice',['agency_data'=>$agency_data]);
    }else{
     
        return view('superadmin.pages.invoice.bookinginvoice',[
            'booking'=>$booking,
            'termcondition'=>$termcondition,
        ]);
    }
   
}


/****
 * 
 * 
 * Serach function for flight
 * 
 * 
 * ******/
public function airport($input){

    //    dd($input);
        $airports = Airport::where('code', 'LIKE', '%' . $input . '%')
            ->orWhere('country', 'LIKE', '%' . $input . '%')
            ->orWhere('airport', 'LIKE', '%' . $input . '%')
            ->orderByRaw("CASE
                WHEN code LIKE '%$input%' THEN 1
                WHEN airport LIKE '%$input%' THEN 2
                ELSE 3
            END")
            ->orderBy('airport', 'desc')
            ->get()
            ->map(function ($airport) {
                return $airport->airport . ', [' . $airport->code . '], ' . $airport->country;
            });
    

    
        return $airports;

}

/****
 * 
 * 
 * Serach for flight details
 * 
 * 
 * ******/

 public function getflight()
 {
     $invoice = "INV-20250221-111550-RYZY";
 
     $flight = FlightBooking::where('invoice_number', $invoice)->first();
 
     if (!$flight) {
         return "No flight found for this invoice.";
     }
 
     // Decode JSON
    //  $data = json_decode($flight->details, true);
    $data = json_decode(json_decode($flight->details, true), true);
    $flight_serach=json_decode(json_decode($flight->flightSearch, true), true);

 
    dd($data);
     if (!is_array($data)) {
         return "Invalid JSON format.";
     }
 
     // Extract journey data
     $journeyData = [];
     foreach ($data as $item) {
         if (isset($item['journey'])) {
             $journeyData = $item['journey']; // Store journey data
             break; // Stop after finding first journey
         }
     }
 
     // Print journey data in the controller
     dd($journeyData); // Debug and check output
 }



 public function him_hotel(){
   
 return view('agencies.pages.hotel.hotel');
 }

 public function him_visa(Request $request){
  
    $countries=Country::get();
    $applicationData = $request->query('booking');
     $formAction  = route('searchvisa');

    return view('superadmin.pages.visa.searchvisa',compact('countries','applicationData','formAction'));
 }


 /******Application Part Store here **** */
 public function hsrequestApplication(Request $request){

    $agencyData= $this->agencyService->getAgencyData(); 
    // dd($agencyData);
  $requestDatas = RequestApplication::with([
        'visa',
        'visasubtype',
        'combination.origincountry',
        'combination.destinationcountry'
    ])
    ->where([
        ['status', 'pending'],
        ['agency_id', $agencyData->id],
    ])
    ->get();
    // dd($requestDatas);
    return view('agencies.pages.service.all-application',compact('requestDatas'));

 }


 
    public function hsRequestView($id){
        $agencyData= $this->agencyService->getAgencyData(); 
            // dd($agencyData);
        $requestDatas = RequestApplication::with([
                'visa',
                'visasubtype',
                'combination.origincountry',
                'combination.destinationcountry'
            ])
            ->where([
                ['status', 'pending'],
                ['agency_id', $agencyData->id],
            ])
            ->where('id',$id)->first();
            $clientData=[];
    return view('agencies.pages.service.view-application',compact('requestDatas','clientData'));
         
    }
       


  public function hsRequestproceed($id)
    {
                $application = RequestApplication::with([
                'visa',
                'visasubtype',
                'combination.origincountry',
                'combination.destinationcountry'
            ])->where('id',$id)->first();

                
            $agencyData= $this->agencyService->getAgencyData(); 
            // $getClient= $this->agencyService->checkValidationInfo($application->email,$agencyData,$application->phone_number); 
              
            // dd($getClient);
            if($application->client_id==null){
            $clientData=$this->hsClientCreate($application,$agencyData);
            $clientAllData=$clientData; 
            }else{
                 $agencyData= $this->agencyService->getAgencyData(); 
               $clientData=$this->agencyService->getClientDetails($application->client_id,$agencyData);
                 $clientAllData=$clientData; 
            }

            
            $booking=$this->hsconvertApplicationStore($clientAllData,$application);
                  if (!$booking) {
                return redirect()->back()->with('error', 'Visa booking failed. Please try again.');
            }
                // Example: update status to "in progress"
                $application->status = 'send';
                $application->save();

          

            return redirect()->route('edit.visa.selectvisa', [
                'id' => $application->visa_id,
                'applicationid' => $booking->application_number
            ]);


            // return redirect()
            //     ->route('verify.application', ['id' => $booking->id])
            //     ->with('success', 'Booking successful. Please verify your application.');
 }


         public function hsClientCreate($application,$agencyData){
                

                $data=[
                    'agency_id'=>$agencyData->id,
                    'first_name'=>$application->first_name,
                    'last_name'=>$application->last_name,
                    'email'=>$application->email,
                    'phone_number'=>$application->phone_number,
                    'nationality'=>$application->nationality,

                ];
                
            $clients = $this->clintRepository->getStoreclint($data);
            return $clients;    
    }

    public function hsconvertApplicationStore($clientAllData,$applicationData){

                    $agencyData= $this->agencyService->getAgencyData(); 
                    $existing = VisaBooking::where('client_id', $clientAllData->id)
                    ->where('agency_id', $agencyData->id)
                    ->where('applicationworkin_status', 'Pending')
                    ->first();
                    // dd($existing);

                if ($existing) {
                    return redirect()->back()->with('error', 'You have already applied for a visa. Kindly check your pending application or wait for approval.');
                }

            $data = [
                "origin"        => $applicationData->combination->origin,
                "destination"   => $applicationData->combination->destination,
                "applicant_type"=>['self'],
                "typeof"        => $applicationData->visa_id,
                "category"      => $applicationData->visa_subtype,
                "processing"    => $applicationData->visasubtype->processing,
                "clientId"      => $clientAllData->id,
                "last_name"     => $clientAllData->client_name,
                "first_name"    => $clientAllData->last_name,
                "citizenship"   => $clientAllData->clientinfo->nationality,
                "email"         => $clientAllData->email,
                "phone_number"  => $clientAllData->phone_number,
                "dateofentry" => $applicationData->date_of_entry,
            ];
            // Proceed to book visa
                $booking = $this->visaRepository->saveBooking($data);
            return $booking;

                    
            
    }

    
    

}