<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Deduction;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\SupplierPaymentDetail;

class SupplierController extends Controller
{
    //
    public function hs_hotelSupplier(Request $request){
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
    
        return view('superadmin.pages.supplier.hotel', compact('agencies', 'hotel_recent_booking'));
        // D:\Allproject\tenancy_final\resources\views\superadmin\pages\supplier\hotel.blade.php
    }


    /****Flight Serach ** */
public function hs_flightSupplier(Request $request)
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

    return view('superadmin.pages.supplier.flight', [
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

public function hs_paysupplier($id){
    $booking = Deduction::with(['service_name', 'agency','flightBooking'])
    ->where('id', $id)->first();
    return view('superadmin.pages.supplier.paysupplier', compact('booking'));

}





public function hs_payamountstore(Request $request)
{
  
    // dd($request->all());
    $request->validate([
        'id' => 'required|exists:deductions,id',
        'add_ammount' => 'required|numeric|min:0',
        'modepayment' => 'required|string',
        'payment_number' => 'required|string',
        'remark' => 'nullable|string',
        'receiptcopy' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $booking = Deduction::findOrFail($request->id);

    // Handle file upload
    $receiptPath = null;
    if ($request->hasFile('receiptcopy')) {
        $file = $request->file('receiptcopy');
        $receiptPath = $file->store('suplier/receipts', 'public');
    }

    // Get the latest payment entry to calculate remaining balance
    $latestPayment = SupplierPaymentDetail::where('booking_id', $request->id)
    ->where('supplier_type','Supplier')
    ->orderByDesc('id')
    ->first();

    
    // Calculate previously paid amount
    $totalPaid = SupplierPaymentDetail::where('booking_id', $request->id)
    ->where('supplier_type','Supplier')
    ->sum('paying_amount');
    $remaining = $booking->amount - $totalPaid;

    // Prevent overpayment
    if ($request->add_ammount > $remaining) {
        return back()->with('error', 'Paying amount cannot exceed the remaining balance (₹' . number_format($remaining, 2) . ').')->withInput();
    }

    // Calculate new balance after this payment
    $newBalance = $remaining - $request->add_ammount;
    $status = bccomp($remaining, $request->add_ammount, 2) === 0 ? 1 : 2;

    // Determine payment status
    // $status = ($newBalance <= 0) ? 1 : 2; // 1 = fully paid, 2 = partially paid

    // Determine supplier name
    $supplierName = ($booking->service == 2) ? 'flight' : 'hotel';

    // Save supplier payment
    $supplier = new SupplierPaymentDetail();
    $supplier->booking_id = $request->id;
    $supplier->supplier_type = 'Supplier';
    $supplier->invoice_number = $booking->invoice_number;
    $supplier->service_id = $booking->service;
    $supplier->supplier_name = $supplierName;
    $supplier->payment_type = $request->modepayment;
    $supplier->payment_date = now();
    $supplier->payment_status = $status;
    $supplier->paying_amount = $request->add_ammount;
    $supplier->balance = $newBalance;
    $supplier->receipt = $receiptPath;
    $supplier->transaction_number = $request->payment_number;
    $supplier->remark = $request->remark;
    $supplier->save();

    // Redirect
    $route = ($booking->service == 2) ? 'superadmin.flight' : 'superadmin.hotel';

    return redirect()->route($route)->with('success', 'Supplier payment added successfully.');
}

public function hs_viewpaysupplier($id){
    $booking = Deduction::with(['service_name', 'agency','flightBooking','allpaydetails'])
    ->where('id', $id)->first();
    return view('superadmin.pages.supplier.viewpaysupplier', compact('booking'));
}



}