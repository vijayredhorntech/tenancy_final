<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use App\Http\Requests\FlightSearchRequest;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight\FlightSetting;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\harry\Travelport\src\FlightDataTrait;
use App\harry\Travelport\src\Travelport;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\AgencyDetail;
use App\Models\TermsCondition;
// use Vin33t\Travelport\Travelport;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use Auth;
use App\Services\AgencyService;

class FlightController extends Controller
{
    protected $agencyService;
    use FlightDataTrait;

    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
       
    }

 

    public function search(FlightSearchRequest $request)
    {

   
       
        // \Log::info('Request Data:', $request->all());


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
        $query = [
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
    //   dd('heelo');
        // \Log::info('Query Parameters:', $query);
        return redirect()->route('flight.results', $query);
    }


    public function results(Request $request)
    {
  
        //   dd($request->all());
        // $travelport = app(Travelport::class);
        
      
        $origin = $request->origin;
        $destination = $request->destination;
        $deptime = $request->deptime;
        $type = $request->type;
        $cabinClass = $request->cabinClass;
        $adult = $request->adult;
        $child = $request->child;
        $infant = $request->infant;
        $currency = $request->currency;
        $fareType = $request->fareType;
        $flexi = $request->flexi;
        $directFlight = $request->directFlight;
        $preferredAirline = $request->preferredAirline;
        $flightRoutes = [
            ['origin' => $origin, 'destination' => $destination, 'deptime' => $deptime],
        ];
        if ($type == 'return') {
            $flightRoutes[] = ['origin' => $destination, 'destination' => $origin, 'deptime' => $request->returndeptime];
        }

        $flightSearch = ['route' => $flightRoutes, 'directFlight' => $directFlight, 'preferredAirline' => $preferredAirline, 'flexi' => $flexi, 'fareType' => $fareType, 'type' => $type, 'cabinClass' => $cabinClass, 'adult' => $adult, 'child' => $child, 'infant' => $infant, 'currency' => $currency];

        if ($flexi == 1) {
            $flexiDepartureDates = $this->getFlexiDepartureDates($deptime);
            //            dd($deptime);
            $flexiReturnDates = $this->getFlexiReturnDates(($type == 'return') ? $request->returndeptime : $deptime);
            dd($flexiReturnDates);
        }
        $start = microtime(true);

        //        if (session()->has('flightResponse')) {
//            $response = session('flightResponse');
//        }else{
         $travelport = new Travelport(config('travelport'));
        $response = $travelport->checkAirAvailability($flightSearch);
        //            session(['flightResponse' => $response]);
//        }

        //    dd($response);
        if ($type == 'oneWay') {
            $searchedFlights = $this->formatOneWayFlightData($this->parseXMLOneWay($response), $flightSearch);
        } else {
            $searchedFlights = $this->formatRoundTripFlightData($this->parseXMLRoundTrip($response), $flightSearch);
        }

        $cheapestFlight = null;
        $cheapestPrice = $searchedFlights->count() ? $searchedFlights[0]['totalPrice'] : 0;
        $costliestFlight = null;
        $costliestPrice = 0;
        $uniqueStops = [];
        $uniqueAirlines = [];
        if ($type == 'oneWay') {
            foreach ($searchedFlights as $flight) {
                $airline = $flight['airline'];
                if (!in_array($airline, $uniqueAirlines)) {
                    $uniqueAirlines[] = $airline;
                }
                $totalPrice = $flight['totalPrice'];
                if ($totalPrice < $cheapestPrice) {
                    $cheapestFlight = $flight;
                    $cheapestPrice = $totalPrice;
                }
                if ($totalPrice > $costliestPrice) {
                    $costliestFlight = $flight;
                    $costliestPrice = $totalPrice;
                }
                $stops = $flight['stops'];

                if (!in_array($stops, $uniqueStops)) {
                    $uniqueStops[] = $stops;
                }
            }
        } elseif ($type == 'return') {

            foreach ($searchedFlights as $flight) {
                $totalPrice = $flight['totalPrice'];
                if ($totalPrice < $cheapestPrice) {
                    $cheapestFlight = $flight;
                    $cheapestPrice = $totalPrice;
                }
                if ($totalPrice > $costliestPrice) {
                    $costliestFlight = $flight;
                    $costliestPrice = $totalPrice;
                }
                $segments = ['inbound', 'outbound'];
                foreach ($segments as $segment) {
                    $airline = $flight[$segment]['airline'];
                    if (!in_array($airline, $uniqueAirlines)) {
                        $uniqueAirlines[] = $airline;
                    }
                    $stops = $flight[$segment]['stops'];
                    if (!in_array($stops, $uniqueStops)) {
                        $uniqueStops[] = $stops;
                    }
                }
            }

        }
        $customSettings = FlightSetting::where('type', 'custom')->where('validFrom', '<=', now())->where('validTill', '>=', now())->get();
        $defaultSettings = FlightSetting::where('type', 'default')->first();


        $airlines = Airline::all();
        if ($customSettings->count()) {
            $settings = $customSettings->first();
        } else {
            $settings = $defaultSettings;
        }
        $cheapestPrice = $settings->markupType == 'percentage' ? $cheapestPrice + ($cheapestPrice * $settings->markupValue / 100) : $cheapestPrice + $settings->markupValue;
        $costliestPrice = $settings->markupType == 'percentage' ? $costliestPrice + ($costliestPrice * $settings->markupValue / 100) : $costliestPrice + $settings->markupValue;


        // dd($customSettings);
        //        $end = microtime(true);
//        $timeTaken = $end - $start;
//        $timeTaken = round($timeTaken, 2);
        // paginate SearchedFlights
//        $searchedFlights = new LengthAwarePaginator($searchedFlights, count($searchedFlights), 15);
//        $searchedFlights->setPath(url()->current());
        //   dd($flightSearch,$defaultSettings,$customSettings);




            //   dd($searchedFlights->sortBy('totalPrice'));



        return view('agencies.pages.flight.result')
            ->with('airlines', $airlines)
            ->with('defaultSettings', $defaultSettings)
            ->with('customSettings', $customSettings)
            ->with('flights', $searchedFlights->sortBy('totalPrice'))
            ->with('uniqueStops', $uniqueStops)
            ->with('uniqueAirlines', $uniqueAirlines)
            ->with('costliestFlight', $costliestFlight)
            ->with('costliestPrice', $costliestPrice)
            ->with('cheapestFlight', $cheapestFlight)
            ->with('cheapestPrice', $cheapestPrice)
            ->with('flightSearch', $flightSearch);
    }




    public function pricing(Request $request)
    {
      
   
        if (\Route::current()->methods()[0] == "POST") {
     
       
            // $travelport = app(Travelport::class);
            $travelport = new Travelport(config('travelport'));
            //        $segmets = collect();
//        dd(json_decode($request->flight, true));
            $details = $travelport->airPriceRequest(json_decode($request->flight, true));
         
            $details = $this->AirPrice($this->XMlToJSON($details));
        
            // dd($details);
             $airports = Airport::all();
             
            //  feach balance
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
            //        dd($details[3]);
        
            // dd($details);agencies.pages.flight.pricing
            return view('agencies.pages.flight.pricing')
            ->with('details', $details)
            ->with('flightSearch', json_decode($request->flightSearch))
            ->with('airports', $airports)
            ->with('balance', $balance);
            // return view('agencies.pages.flight.pricing')->with('details', $details)->with('flightSearch', $request->flightSearch)->with('airports', $airports);
        } else {
            return redirect()->route('agency_dashboard');
        }
    }

    public function detailModal()
    {
        return view('flight.modals.detailsModal');
    }

    public function passengerDetails(Request $request)
    {
        $details = json_decode($request->details);
        $flightSearch = $request->flightSearch;
        return view('agencies.pages.flight.passengerdetails')
        ->with('details', $details)->with('flightSearch', $flightSearch)
        ->with('service', $service)
        ->with('balance', $balance);

        // return view('flight.passengerDetails')->with('details', $details)->with('flightSearch', $flightSearch);
    }


    public function payment(Request $request)
    {
        $travelport = app(Travelport::class);
        $flightSearch = json_decode($request->flightSearch, true);
        $details = json_decode($request->details, true);

        $adultPassengerDetails = [$request->adultPrefix, $request->adultFirstName, $request->adultMiddleName, $request->adultLastName, $request->adultGender, $request->adultDateOfBirth];
        $childPassengerDetails = [$request->childTitle, $request->childFirstName, $request->childMiddleName, $request->childLastName, $request->childGender, $request->childDateOfBirth];
        $infantPassengerDetails = [$request->infantPrefix, $request->infantFirstName, $request->infantMiddleName, $request->infantLastName, $request->infantGender, $request->infantDateOfBirth];
        $passengerAddress = [$request->postcode, $request->addressLine1, $request->addressLine2, $request->city, $request->state, $request->country, $request->mobile, $request->email];
        $currentDate = now()->format('d M Y');

        session()->put('flightSearch', $flightSearch);
        session()->put('details', $details);
        session()->put('adultPassengerDetails', $adultPassengerDetails);
        session()->put('childPassengerDetails', $childPassengerDetails);
        session()->put('infantPassengerDetails', $infantPassengerDetails);
        session()->put('passengerAddress', $passengerAddress);
        session()->put('currentDate', $currentDate);
        return redirect()->route('flight.invoice');
    }

    public function invoice()
    {
       
        $flightSearch = session('flightSearch');
        $details = session('details');
        $adultPassengerDetails = session('adultPassengerDetails');
        $childPassengerDetails = session('childPassengerDetails');
        $infantPassengerDetails = session('infantPassengerDetails');
        $passengerAddress = session('passengerAddress');
        $currentDate = session('currentDate');
             $travelport = app(Travelport::class);
             $flightSearch = [];
             $details = [];
        // $response = $travelport->airBookingRequset([$flightSearch, $details, $adultPassengerDetails, $childPassengerDetails, $passengerAddress, $currentDate, $infantPassengerDetails]);
        // return $response;
        return view('Invoice.flightInvoice')
            ->with('flightSearch', $flightSearch)
            ->with('details', $details)
            ->with('adultPassengerDetails', $adultPassengerDetails)
            ->with('childPassengerDetails', $childPassengerDetails)
            ->with('infantPassengerDetails', $infantPassengerDetails)
            ->with('passengerAddress', $passengerAddress)
            ->with('currentDate', $currentDate);
    }



    // public function payment(Request $request)
    // {
    //     // dd($request->adultFirstName);

    //     $travelport = app(Travelport::class);
    //     $flightSearch = json_decode($request->flightSearch, true);
    //     $details = json_decode($request->details, true);


    //     // $response = $travelport->airBookingRequset([$flightSearch, $details, $adultPassengerDetails, $childPassengerDetails, $passengerAddress, $currentDate, $infantPassengerDetails]);
    //     return view('Invoice.flightInvoice')
    //         ->with('flightSearch', $flightSearch);
    // }

}
