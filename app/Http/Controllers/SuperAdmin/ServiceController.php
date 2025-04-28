<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Http\Requests\FlightSearchRequest;
use App\Models\Deduction;
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


use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use Auth;

class ServiceController extends Controller
{
    
 /**** */
 public function him_test(){

    $id = Auth::user()->id;
    // dd($id); 
    $userData = \session('user_data');
    DatabaseHelper::setDatabaseConnection($userData['database']);
    $user = User::on('user_database')->where('id', $id)->first();
    $agency_record=Agency::where('email',$user->email)->first(); 
    $agency = Agency::with('userAssignments.service')->find($agency_record->id);
   
    $services = $agency->userAssignments->pluck('service.name', 'service.icon');
      return view('agencies.pages.test',[
        'user_data' => $user,
        'services' => $services,
        'agency'=>$agency_record,
        'all_agency'=>$agency
        ]);

 }

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

 public function him_flightsearch(FlightSearchRequest $request){

dd("heelo");
    // http://127.0.0.1:8002/

    $origin = $request->origin;
    $destination = $request->destination;
    $type = $request->type;
    $cabinClass = $request->cabinClass;
    $adult = $request->adult;
    $child = $request->child;
    $infant = $request->infant;
    $currency = $request->currency;
    $fareType = $request->fareType;
    $flexi = $request->flexi ? true : false;
    $preferredAirline = $request->preferredAirline;
    $directFlight = $request->directFlight ? true : false;
    $deptime = $request->departureDate;
    if ($type == 'return') {
        $returnDeptime = $request->returnDate;
    }

    $data = [
        'origin' => $origin,
        'destination' => $destination,
        'deptime' => $deptime,
        'preferredAirline' => $preferredAirline,
        'directFlight' => $directFlight,
        'flexi' => $flexi,
        'type' => $type,
        'cabinClass' => $cabinClass,
        'adult' => $adult,
        'child' => $child,
        'infant' => $infant,
        'currency' => $currency,
        'fareType' => $fareType,
    ];
    if ($type == 'return') {
        $data['returndeptime'] = $returnDeptime;
    }

 

    $token = 'JSDkdhf73hdkHFKjdsf7Hkdsf83hskfd7HsdjfKJHdf738dhskfjhS';
    
    // Data array

    // Convert data array to query string
    $queryString = http_build_query($data);
    
    // Append query string to URL
    $baseUrl = env('APP_BASE_URL');  
    // $url = 'http://127.0.0.1:8006/api/flight/search/results?' . $queryString;
    $url = $baseUrl . '/api/flight/search/results?' . $queryString;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json"
    ]);

    // Remove CURLOPT_POSTFIELDS (not needed for GET)
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); // Explicitly set GET request

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Decode JSON response
    $responseData = json_decode($response, true);

    // Print response
    if ($httpCode === 200) {
      
    //   dd($responseData);
        return view('agencies.pages.flight.result')
        ->with('airlines', $responseData['data']['airlines'])
        ->with('defaultSettings', $responseData['data']['defaultSettings'])
        ->with('customSettings', $responseData['data']['customSettings'])
        ->with('flights', collect($responseData['data']['flights'])->sortBy('totalPrice'))
        ->with('uniqueStops', $responseData['data']['uniqueStops'])
        ->with('uniqueAirlines', $responseData['data']['uniqueAirlines'])
        ->with('costliestFlight', $responseData['data']['costliestFlight'])
        ->with('costliestPrice', $responseData['data']['costliestPrice'])
        ->with('cheapestFlight', $responseData['data']['cheapestFlight'])
        ->with('cheapestPrice', $responseData['data']['cheapestPrice'])
        ->with('flightSearch', $responseData['data']['flightSearch']);

        

    } else {
        echo "Error: " . $httpCode . "<br>";
        echo "Response: " . $response;
    }
}


/****For Flight Price  ****/

public function him_flightprice(Request $request)
{
    // Retrieve JSON-encoded flight data from the request

    $data = $request->input('flight');
 


    // Ensure it's properly formatted
    $formattedData = [
        "flight" => json_encode(json_decode($data, true), JSON_UNESCAPED_SLASHES) 
    ];


    $baseUrl = env('APP_BASE_URL'); 

    $token = 'JSDkdhf73hdkHFKjdsf7Hkdsf83hskfd7HsdjfKJHdf738dhskfjhS'; // API Token

    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => $baseUrl . '/api/flight/pricing',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30, // Better timeout for API requests
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($formattedData, JSON_UNESCAPED_SLASHES), // Encode data properly
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token", // Fixed string interpolation issue
            "Content-Type: application/json",
        ],
    ]);
    
    $response = curl_exec($curl);
    $responseData = json_decode($response, true);

   

    $userData = session('user_data');

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


    $balance = Balance::where('agency_id', $agency->id)->first();
    return view('agencies.pages.flight.pricing')
    ->with('details', $responseData['details'])
    ->with('flightSearch', json_decode($request->flightSearch))
    ->with('airports', $responseData['airports'])
    ->with('balance', $balance);;

}


/****For passangerDetails  */
public function passengerDetails(Request $request){

        $userData = session('user_data');
        $agency = Agency::where('email', $userData['email'])->first();

       $details = json_decode($request->details);
        $flightSearch =json_decode($request->flightSearch);
        $service=Service::where('name','Flight')->first();

        $userData = session('user_data');

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

        $balance = Balance::where('agency_id', $agency->id)->first();
     


        return view('agencies.pages.flight.passengerdetails')
        ->with('details', $details)->with('flightSearch', $flightSearch)
        ->with('service', $service)
        ->with('balance', $balance);

}


public function payment(Request $request)
{
    // Retrieve session data
    $userData = session('user_data');


    $price_data=json_decode($request->details);
    
    $userData = session('user_data');

    DatabaseHelper::setDatabaseConnection($userData['database']);
    
    // $user = User::on('user_database')->where('id', $id)->first();
    $user = User::on('user_database')->where('email', $userData['email'])->first();

 
    $data = $request->all(); // Use $request->all() as $data


    $adults = [];
    $children = [];
    $infants = [];

    $adultCount = count($data['adultPrefix'] ?? []);
    $childCount = count($data['childTitle'] ?? []);
    $infantCount = count($data['infantPrefix'] ?? []);

    // Process Adults
    for ($i = 0; $i < $adultCount; $i++) {
        $adults[] = [
            'prefix' => $data['adultPrefix'][$i] ?? null,
            'firstName' => $data['adultFirstName'][$i] ?? null,
            'middleName' => $data['adultMiddleName'][$i] ?? null,
            'lastName' => $data['adultLastName'][$i] ?? null,
            'gender' => $data['adultGender'][$i] ?? null,
            'dob' => $data['adultDateOfBirth'][$i] ?? null,
            'seatingPreference' => $data['adultSeatingPreference'][$i] ?? null,
            'assistance' => $data['adultAssistance'][$i] ?? null,
            'mealPreference' => $data['adultMealPreference'][$i] ?? null,
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

    // Fetch agency based on email
 
     if($user->type=="staff"){
        // dd("heelo");
            $agency_record=Agency::where('database_name',$userData['database'])->first(); 
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        }else{
            $agency_record=Agency::where('email',$user->email)->first(); 
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        }
 
    if (!$agency) {
        return response()->json(['error' => 'Agency not found'], 404);
    }


    try {
        // Generate unique booking & invoice numbers
        $now = Carbon::now();
        $dateTime = $now->format('Ymd-His'); // Format: YYYYMMDD-HHMMSS
        $randomPart = strtoupper(Str::random(4)); // Random 4-character string

        $bookingNumber = "BN-{$dateTime}-{$randomPart}";
        $invoiceNumber = "INV-{$dateTime}-{$randomPart}";

        // Create Flight Booking
        $flight = new FlightBooking();
        $flight->agnecy_email = $userData['email'];
        $flight->domain = $userData['domain'];
        $flight->database = $userData['database'];
        $flight->agency_id = $agency->id;
        $flight->user_id = $user->id;
        $flight->booking_number = $bookingNumber;
        $flight->invoice_number = $invoiceNumber;
        $flight->details = $request->details;
        $flight->flightSearch = json_encode($request->flightSearch);
        $flight->save();

        // Create Passenger Information
        $passenger = new PassengerInformation();
        $passenger->agency_id = $agency->id;
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

        

    $service_id = $request->service_id;
  
    $amount = $price_data[2]->price->TotalPrice;
    $price = preg_replace('/[^0-9.]/', '', $amount);
    // Fetch balance record
    $balance = Balance::where('agency_id', $agency->id)->first();

    // Check if balance record exists
    if (!$balance) {
        dd('soory');
        return back()->with('error', 'Balance record not found.');
    }

    $fundRemaining = $balance->balance;
  

    // Ensure agency has enough balance
    if ($price > $fundRemaining) {
        dd("heelo");
        return back()->with('error', 'Insufficient balance.');
    } else {
        // Deduct amount and save deduction record
        $deduction = new Deduction();
        $deduction->agency_id = $agency->id;
        $deduction->service = $service_id;
        $deduction->invoice_number = $invoiceNumber;
        $deduction->flight_booking_id = $flight->id;
        $deduction->amount = $price;
        $deduction->date = now();
        $deduction->save();

        // Update balance
        $balance->balance -= $price;
        $balance->save();
     
        Mail::to($request->email)->send(new BookingConfirmationMail($flight,$agency));

        return redirect()->route('agency_booking', ['booking_number' => $invoiceNumber])
        ->with('success', 'Your booking is confirmed!');
    }


   
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to process booking: ' . $e->getMessage()], 500);
    }

}


/*** Invoice details ****/
public function hs_generateinvocie($invoice){
    // $invoice_number ="INV-20250220-080104-9ZMZ";

   $agency_data=AddBalance::with('agency')->where('invoice_number',$invoice)->first(); 
   $termcondition=TermsCondition::where('name','super admin')->where('status',1)->first(); 

 
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

 
 
    $flight=FlightBooking::where('invoice_number',$invoice_number)->first(); 
    $price_data=$flight->invoice_number;
    $booking=Deduction::with('agency')->where('invoice_number',$price_data)->first(); 
    $agency_id=$booking->agency->id;
    $agency_address=AgencyDetail::where('agency_id',$agency_id)->first();
    $termcondition=TermsCondition::where('name','agency')->where('status',1)->first(); 
    $passenger_deatils=PassengerInformation::where('invoice_number',$invoice_number)->first(); 

    $adults=json_decode($passenger_deatils->adult, true);
    $children=json_decode($passenger_deatils->children, true);
    $infants=json_decode($passenger_deatils->infant, true);
   

    $details = json_decode($flight->details, true);
    $flight_search = json_decode($flight->flightSearch, true);
  


    $segment = request()->segment(1); // Gets the first segment

   
    if($segment=='agencies'){
        return view('agencies.pages.invoices.flightinvoice',[
            'flight_serach'=>$flight_search,
            'details'=>$details,
            'booking'=>$booking,
            'flight'=>$flight,
            'agency_address'=>$agency_address,
            'termcondition'=>$termcondition,
            'adults'=>$adults,
            'children'=>$children,
            'infants'=>$infants,
            'passenger_deatils'=>$passenger_deatils,
        ]);
        // return view('agencies.pages.invoices.paymentInvoice',['agency_data'=>$agency_data]);
    }else{
         return view('superadmin.pages.invoice.bookinginvoice',[
            'flight_serach'=>$flight_search,
            'details'=>$details,
            'booking'=>$booking,
            'flight'=>$flight,
            'agency_address'=>$agency_address,
            'termcondition'=>$termcondition,
            'adults'=>$adults,
            'children'=>$children,
            'infants'=>$infants,
            'passenger_deatils'=>$passenger_deatils,
        
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

 public function him_visa(){
  
    $countries=Country::get();
    return view('superadmin.pages.visa.searchvisa',compact('countries'));
 }

 /****Doc Sign *****/
 public function him_docsign(){
    return view('agencies.pages.docsign.createdoc');


 }

}