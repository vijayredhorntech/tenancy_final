<?php

namespace App\Traits\Booking;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeductionReportExport;

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
}
