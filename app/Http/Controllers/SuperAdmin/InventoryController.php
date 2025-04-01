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
use Illuminate\Support\Facades\DB;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\FlightBooking;
use App\Traits\Booking\BookingExportTrait;

use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class InventoryController extends Controller
{

    use BookingExportTrait;

    public function exportBookingsPDF()
        {
            $bookings=Deduction::with('agency','service_name','flightBooking')->get();
            $title = "Booking Reports";
            return $this->generateBookingPDF($title, $bookings);
        }


    public function exportBookingsExcel()
        {
            $bookings=Deduction::with('agency','service_name','flightBooking');
            return $this->generateBookingExcel($bookings);
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

public function searchFilter(Request $request){
    $query = Deduction::with('agency', 'service_name', 'flightBooking');

    // Filter by supplier name in flightBooking table
    if ($request->filled('supplier_name')) {
        $query->whereHas('flightBooking', function ($q) use ($request) {
            $q->where('supplier_name', $request->supplier_name);
        });
    }

    $bookings = $query->get();
    dd($bookings);

}



    
}
