<?php

namespace App\Traits\Booking;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeductionReportExport;
use App\Models\Deduction;
use App\Exports\HotelBookingsExport;
use App\Exports\VisaBookingExport;
use Illuminate\Support\Collection;

trait BookingExportTrait
{
    /**
     * Generate Booking PDF
     */
    public function generateBookingPDF($title, $bookings)
    {
        $data = [
            'title' =>  $title,
            'bookings' => $bookings
        ];

        $pdf = Pdf::loadView('pdf.bookingpdf', $data); // Ensure you have 'pdf.bookingpdf' Blade file
        return $pdf->download('Bookings.pdf');
    }

    /**
     * Generate Booking Excel
     */
    public function generateBookingExcel($bookings)
    {
        return Excel::download(new DeductionReportExport($bookings), 'bookings.xlsx');
    }


    /****Get Filter BOoking *** */
    private function getFilteredFlightBookings($request)
            {

                $query = Deduction::with(['agency', 'service_name', 'flightBooking'])
                    ->where('service', 2); // Only flight service

                // Filter by date range
                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                // Filter by agency
                if ($request->filled('agencyid')) {
                    $query->where('agency_id', $request->agencyid);
                }

                // Filter by supplier (assuming this is airline code in JSON)
                if ($request->filled('supplier')) {
                    $query->whereHas('flightBooking', function ($q) use ($request) {
                        $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(details, '$[0].journey[0].Carrier')) = ?", [$request->supplier]);
                    });
                }

                // Search filter (change field name as needed)
                if ($request->filled('search')) {
                    $query->where('reference', 'like', '%' . $request->search . '%'); // Replace `reference` if needed
                }

                return $query;
            }

/***Hotel Booking Filter *** */
/*** Hotel Booking Filter ***/
        private function getFilteredHotelBookings($request)
        {
            // Build the filtered query
            $query = Deduction::with([
                'service_name', 
                'agency',
                'hotelBooking',
                'hotelDetails'
            ])
            ->where('service', 1); // Hotel bookings

            // Apply filters
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

            // Return filtered results (no pagination)
            return $query;
        }



  /**
     * Generate Booking PDF
     */
    public function generateHotelBookingPDF($title, $bookings)
    {
        $data = [
            'title' =>  $title,
            'bookings' => $bookings
        ];

        $pdf = Pdf::loadView('pdf.hotelpdf', $data); // Ensure you have 'pdf.bookingpdf' Blade file
        return $pdf->download('HotelBooking.pdf');
        
    }



    /**
     * Generate Booking Excel
     */
    public function generateHotelBookingExcel($filteredBookings)
    {
     
        return Excel::download(new HotelBookingsExport($filteredBookings), 'hotel-bookings.xlsx');
    }

    /***Visa export */

    public function exportVisaExcel($bookings)
    {
      
        return Excel::download(new VisaBookingExport($bookings), 'visa_bookings.xlsx');
    }


    public function generateVisaBookingPDF($title, $bookings)
    {
        $data = [
            'title' =>  $title,
            'bookings' => $bookings
        ];

        $pdf = Pdf::loadView('pdf.visa-report', $data); // Ensure you have 'pdf.bookingpdf' Blade file
        return $pdf->download('VisaApplication.pdf');
        
    }

}
