<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\FlightBooking;
use App\Traits\Booking\BookingExportTrait;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\VisaRepositoryInterface;


use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class InventoryController extends Controller
{
    protected $visaRepository;

    use BookingExportTrait;

    public function __construct( VisaRepositoryInterface $visaRepository) {
        $this->visaRepository = $visaRepository;
    
      
    }

    /****Flight Export **** */
     public function exportFlightBookingsExcel(Request $request)
        {
            $bookings = $this->getFilteredFlightBookings($request); // get all filtered results
            return $this->generateBookingExcel($bookings);
        }

    public function exportFlightBookingsPDF(Request $request)
        {
            $bookings = $this->getFilteredFlightBookings($request)->get(); // get all filtered results
            $title = "Booking Reports";
            return $this->generateBookingPDF($title, $bookings);
        }


        /****Hotel BOoking Export **** */
        
    public function exportHotelBookingsExcel(Request $request){
        $bookings = $this->getFilteredHotelBookings($request)->get();
        return $this->generateHotelBookingExcel($bookings);
    }

    public function exportHotelBookingsPDF(Request $request){
        $bookings = $this->getFilteredHotelBookings($request)->get();
        $title = "Hotel Bookings Report";
    
        return $this->generateHotelBookingPDF($title, $bookings); 
    }
        


    /****Visa APplication Export **** */

    public function exportVisaBookingsPDF(Request $request)
        {
            $request->merge(['export' => 'true']); // mark this request as export
            $bookings = $this->visaRepository->getSuperadminshotedapplication($request);
            $title = "Booking Reports";
            return $this->generateVisaBookingPDF($title, $bookings);
        }


        public function exportVisaBookingsExcel(Request $request)
        {
            $request->merge(['export' => 'true']); // mark this request as export
            $bookings = $this->visaRepository->getSuperadminshotedapplication($request);
            return $this->exportVisaExcel($bookings);
        }




    public function hs_inventory(Request $request)
{
    // Fetch all records with agency relationship
    $inventory = AddBalance::with('agency')
    ->where('status', 0) // Filter by status = 0
    ->get()
    ->map(function ($item) {
        $item->type = 'credit'; // Mark as credit
        $item->amount = $item->amount; // Standardize amount field
        unset($item->added_amount);
        return $item;
    });

   

    // Fetch all Deduction records (debits)
    $deduction = Deduction::with('agency')->get()->map(function ($item) {
        $item->type = 'debit'; // Mark as debit
        $item->amount = $item->amount; // Standardize amount field
        unset($item->deducted_amount);
        return $item;
    });
    // dd($inventory);
    // Merge and sort both datasets by created_at
    $sorted = $inventory->concat($deduction)->sortByDesc('created_at')->values();

    return view('superadmin.pages.inventory.inventory', [
        'inventories' => $sorted
    ]);
}



Public function hs_bookingManagment(){

    $bookings=Deduction::with('agency','service_name','flightBooking')->get(); 

    $flights = []; 
    foreach ($bookings as $booking) {
    
 
        $flight_name = !empty($booking->flightBooking->details)
            ? json_decode($booking->flightBooking->details, true)
            : [];
        $flight_code = $flight_name[0]['journey'][0]['Carrier'] ?? null;

        $carrier = $flight_code ? \App\Models\Airline::where('iata', $flight_code)->first() : null;
        $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';
 
        $flights[$flight_code] = $carrierName;
    }

    $services=Service::get(); 
   
    $flight_recent_booking = Deduction::with(['service_name', 'agency','flightBooking'])
    ->orderBy('created_at', 'desc') // Orders by latest records
    ->where('service','2')
    ->take(5)
    ->get();

    $visa_recent_booking = Deduction::with([
        'service_name', 
        'agency',
        'visaBooking', // Ensure this relationship is defined correctly
        'visaBooking.visa',
        'visaBooking.origin',
        'visaBooking.destination',
        'visaBooking.visasubtype',
        'visaBooking.clint',
        'visaApplicant' // Ensure the correct spelling: 'clint' → 'client' (if it's a typo)
    ])
    ->where('service', 3) // No need for quotes around integer
    ->orderBy('created_at', 'desc') // Order by latest records
    ->take(5)
    ->get();

  

    return view('superadmin.pages.booking.booking', [
        'bookings' => $bookings,
        'flights' => $flights, // Fixed: Correctly passing flights array
        'services' => $services,
        'flight_recent_booking' => $flight_recent_booking,
        'visa_recent_booking' => $visa_recent_booking
    ]);
    
}



/****Flight Serach ** */
public function hs_flightbooking(Request $request)
{
    $filters = $request->all();
    $perPage = $filters['per_page'] ?? 10;

    // Initial query (basic filters only)
    $bookings = Deduction::with(['service_name', 'agency','flightBooking'])
        ->where('service', '2')
        ->latest()
        ->get();

    // Now filter by airline from JSON
    if (!empty($filters['supplier'])) {
        $bookings = $bookings->filter(function ($booking) use ($filters) {
            if (!$booking->flightBooking) return false;

            $flight_details = json_decode($booking->flightBooking->details, true);
            if (!isset($flight_details[0]['journey'])) return false;

            foreach ($flight_details[0]['journey'] as $journey) {
                if (($journey['Carrier'] ?? '') === $filters['supplier']) {
                    return true;
                }
            }
            return false;
        });
    }

    // Filter by agency ID
    if (!empty($filters['agencyid'])) {
        $bookings = $bookings->where('agency_id', $filters['agencyid']);
    }

    // Filter by date
    if (!empty($filters['date_from'])) {
        $bookings = $bookings->where('created_at', '>=', $filters['date_from']);
    }

    if (!empty($filters['date_to'])) {
        $bookings = $bookings->where('created_at', '<=', $filters['date_to']);
    }

    // Paginate manually using LengthAwarePaginator
    $page = LengthAwarePaginator::resolveCurrentPage();
    $bookings = collect($bookings);
    $paginated = new LengthAwarePaginator(
        $bookings->forPage($page, $perPage),
        $bookings->count(),
        $perPage,
        $page,
        ['path' => url()->current(), 'query' => $filters]
    );

    $agencies = Agency::all();
    $airlineData = $this->getTotalAireline(); // Optional: pass filters here if needed

    return view('superadmin.pages.booking.flightbooking', [
        'bookings' => $paginated,
        'agencies' => $agencies,
        'airlineBookings' => $airlineData['airlineBookings'],
        'airlinePassengerTotals' => $airlineData['airlinePassengerTotals'],
        'flight_recent_booking' => $paginated
    ]);
}



private function getTotalAireline()
{
    $bookings = Deduction::with(['service_name', 'agency','flightBooking'])
        ->orderBy('created_at', 'desc')
        ->get();

    $airlineBookings = []; // Bookings grouped by airline
    $airlinePassengerTotals = []; // Total passengers per airline
    $processedBookings = []; // Track processed flight_booking_id per airline

    foreach ($bookings as $booking) {
        if (!$booking->flightBooking) {
            continue;
        }

        $flight_booking_id = $booking->flight_booking_id;
        $flight_details = json_decode($booking->flightBooking->details, true);
        $flightsearch = json_decode($booking->flightBooking->flightSearch, true);

        $adult = $flightsearch['adult'] ?? 0;
        $child = $flightsearch['child'] ?? 0;
        $infant = $flightsearch['infant'] ?? 0;
        $total = $adult + $child + $infant;

        if (isset($flight_details[0]['journey']) && is_array($flight_details[0]['journey'])) {
            foreach ($flight_details[0]['journey'] as $journey) {
                $carrier = $journey['Carrier'] ?? 'Unknown';

                $airlineBookings[$carrier][] = [
                    'booking' => $booking,
                    'total_passengers' => $total
                ];

                if (!isset($processedBookings[$carrier])) {
                    $processedBookings[$carrier] = [];
                }

                if (!in_array($flight_booking_id, $processedBookings[$carrier])) {
                    $processedBookings[$carrier][] = $flight_booking_id;

                    if (!isset($airlinePassengerTotals[$carrier])) {
                        $airlinePassengerTotals[$carrier] = 0;
                    }
                    $airlinePassengerTotals[$carrier] += $total;
                }
            }
        }
    }

    return [
        'airlineBookings' => $airlineBookings,
        'airlinePassengerTotals' => $airlinePassengerTotals
    ];
}



public function hs_hotelbooking(Request $request)
{
    $query = Deduction::with([
        'service_name', 
        'agency',
        'hotelBooking',
        'hotelDetails'
    ])
    ->where('service', 1) // 1 = Hotel
    ->orderBy('created_at', 'desc');

    // 🔍 Apply Filters
    if ($request->filled('supplier')) {
        $query->whereHas('hotelDetails', function ($q) use ($request) {
            $q->where('vendor_name', $request->supplier);
        });
    }

    if ($request->filled('agencyid')) {
        $query->where('agency_id', $request->agencyid);
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('reference', 'like', "%$search%")
              ->orWhereHas('agency', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%$search%");
              });
        });
    }

    // 🔁 Pagination
    $perPage = $request->input('per_page', 10); // default 10
    $hotel_recent_booking = $query->paginate($perPage);

    $agencies = Agency::all();

    return view('superadmin.pages.booking.hotelbooking', compact('agencies', 'hotel_recent_booking'));
}


public function hsvisaApplication(Request $request){

    

    $allbookings = $this->visaRepository->getSuperadminshotedapplication($request);
    // dd($allbookings);

   
    $agencies = Agency::all();
   $countries=Country::get();

    return view('superadmin.pages.booking.visaapplication', compact('agencies', 'allbookings','countries'));
}

}