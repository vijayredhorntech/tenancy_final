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

 
    $id = Auth::user()->id;
    // dd($id); 
    $userData = \session('user_data');
    DatabaseHelper::setDatabaseConnection($userData['database']);
    $user = User::on('user_database')->where('id', $id)->first();
    $agency_record=Agency::where('email',$user->email)->first(); 
    $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    $services = $agency->userAssignments->pluck('service.name', 'service.icon');

    return view('agencies.pages.flight.flight',[
        'user_data' => $user,
        'services' => $services,
        'agency'=>$agency_record,
        'all_agency'=>$agency
        ]);
 }

 public function him_flightsearch(FlightSearchRequest $request){


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

    return view('agencies.pages.flight.pricing')->with('details', $responseData['details'])->with('flightSearch', json_decode($request->flightSearch))->with('airports', $responseData['airports']);
    
   
}


/****For passangerDetails  */
public function passengerDetails(Request $request){

       $details = json_decode($request->details);
        $flightSearch =json_decode($request->flightSearch);
        return view('agencies.pages.flight.passengerdetails')->with('details', $details)->with('flightSearch', $flightSearch);

}


public function payment(Request $request)
{
    // Retrieve session data
    $userData = session('user_data');

    // Debugging output
    // echo "<pre>";
    // print_r($userData);
    // dd($request->all());

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
 
    $agency = Agency::where('email', $userData['email'])->first();
 
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
        $flight->booking_number = $bookingNumber;
        $flight->invoice_number = $invoiceNumber;
        $flight->details = json_encode($request->details);
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

        dd('hello'); 
        return response()->json([
            'message' => 'Payment and booking successfully recorded',
            'booking_number' => $bookingNumber,
            'invoice_number' => $invoiceNumber,
            'flight' => $flight,
            'passenger' => $passenger
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to process booking: ' . $e->getMessage()], 500);
    }

}

}