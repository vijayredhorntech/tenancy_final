<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FlightSearchRequest;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight\FlightSetting;
use App\harry\travelport\src\Travelport;
use App\Models\Agency;
use App\Models\Service;
use App\Models\FlightRequest;
use App\Models\Country;

class PublicFlightController extends Controller
{
    public function search(FlightSearchRequest $request)
    {
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

        // Redirect to public results page
        return redirect()->route('public.flight.results', $query);
    }

    public function results(Request $request)
    {
        // Add safety checks for all required fields
        $origin = $request->origin ?? 'N/A';
        $destination = $request->destination ?? 'N/A';
        $deptime = $request->deptime ?? 'N/A';
        $type = $request->type ?? 'oneWay';
        $cabinClass = $request->cabinClass ?? 'Economy';
        $adult = $request->adult ?? 1;
        $child = $request->child ?? 0;
        $infant = $request->infant ?? 0;
        $currency = $request->currency ?? 'GBP';
        $fareType = $request->fareType ?? 'PublicFaresOnly';
        $flexi = $request->flexi ?? false;
        $directFlight = $request->directFlight ?? false;
        $preferredAirline = $request->preferredAirline ?? '';
        
        $flightRoutes = [
            ['origin' => $origin, 'destination' => $destination, 'deptime' => $deptime],
        ];
        
        if ($type == 'return' && $request->returndeptime) {
            $flightRoutes[] = ['origin' => $destination, 'destination' => $origin, 'deptime' => $request->returndeptime];
        }

        $flightSearch = [
            'route' => $flightRoutes, 
            'directFlight' => $directFlight, 
            'preferredAirline' => $preferredAirline, 
            'flexi' => $flexi, 
            'fareType' => $fareType, 
            'type' => $type, 
            'cabinClass' => $cabinClass, 
            'adult' => $adult, 
            'child' => $child, 
            'infant' => $infant, 
            'currency' => $currency
        ];

        // For public homepage, we'll show a message to login for full search
        // Or you can implement a simplified search here
        
        try {
            $airlines = Airline::all();
            $defaultSettings = FlightSetting::where('type', 'default')->first();
            $customSettings = FlightSetting::where('type', 'custom')
                ->where('validFrom', '<=', now())
                ->where('validTill', '>=', now())
                ->get();
        } catch (\Exception $e) {
            // If there's an error with the database, provide empty defaults
            $airlines = collect();
            $defaultSettings = null;
            $customSettings = collect();
        }

        return view('agencies.pages.flight.public_results')
            ->with('airlines', $airlines)
            ->with('defaultSettings', $defaultSettings)
            ->with('customSettings', $customSettings)
            ->with('flightSearch', $flightSearch)
            ->with('message', 'Please login to your agency account to search for available flights and make bookings.');
    }

    public function showForm(Request $request)
    {
        $countries = Country::all();
        $flightSearch = $request->all();
        
        return view('agencies.pages.flight.request_form', compact('countries', 'flightSearch'));
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after:departure_date',
            'trip_type' => 'required|in:oneWay,return,multiCity',
            'adults' => 'required|integer|min:1',
            'children' => 'integer|min:0',
            'infants' => 'integer|min:0',
            'cabin_class' => 'required|string',
            'currency' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'nationality' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'date_of_entry' => 'required|date',
            'special_requirements' => 'nullable|string',
            'budget_range' => 'nullable|string',
        ]);

        // Get agency from session
        $allSessionData = session()->all();
        $agencyData = Agency::with('domains')
            ->whereHas('domains', function ($query) use ($allSessionData) {
                $query->where('domain_name', $allSessionData['agency_domain'] ?? '');
            })
            ->first();

        $data = [
            'service_type' => 'Flight',
            'agency_id' => $agencyData->id ?? null,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'trip_type' => $request->trip_type,
            'adults' => $request->adults,
            'children' => $request->children ?? 0,
            'infants' => $request->infants ?? 0,
            'cabin_class' => $request->cabin_class,
            'currency' => $request->currency,
            'preferred_airline' => $request->preferred_airline,
            'direct_flight' => $request->has('direct_flight'),
            'flexi_dates' => $request->has('flexi_dates'),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'nationality' => $request->nationality,
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'city' => $request->city,
            'date_of_entry' => $request->date_of_entry,
            'status' => 'pending',
            'special_requirements' => $request->special_requirements,
            'budget_range' => $request->budget_range,
        ];

        FlightRequest::create($data);

        return redirect()->route('flight.request.thank-you')
            ->with('success', 'Your flight request has been submitted successfully. We will contact you soon.');
    }
}
