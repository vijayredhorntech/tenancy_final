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

public function passengerDetails(Request $request){

       $details = json_decode($request->details);
        $flightSearch =json_decode($request->flightSearch);
        return view('agencies.pages.flight.passengerdetails')->with('details', $details)->with('flightSearch', $flightSearch);

}



}