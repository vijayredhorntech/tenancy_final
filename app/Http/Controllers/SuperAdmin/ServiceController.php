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

    // dd($request->all());
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
        $query['returndeptime'] = $returnDeptime;
    }


    $token = 'JSDkdhf73hdkHFKjdsf7Hkdsf83hskfd7HsdjfKJHdf738dhskfjhS';
    
    // Data array

    // Convert data array to query string
    $queryString = http_build_query($data);
    
    // Append query string to URL
    $url = 'http://127.0.0.1:8002/api/flight/search/results?' . $queryString;

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

}