<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HotelBookingsExport implements FromCollection, WithHeadings
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function collection()
    {
        return $this->bookings->map(function ($booking) {
            return [
                'Agency Name'   => optional($booking->agency)->name,
                'Invoice No.'   => $booking->invoice_number ?? '',
                'Service'       => optional($booking->service_name)->name ?? '',
                'Hotel Name'    => optional($booking->hotelDetails)->hotel_name ?? '',
                'Amount'        => $booking->amount ?? '0.00',
                'Vendor Name'   => optional($booking->hotelDetails)->vendor_name ?? '',
                'Booking Date'  => $booking->date ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return ['Agency Name', 'Invoice No.', 'Service', 'Hotel Name', 'Amount', 'Vendor Name', 'Booking Date'];
    }
}
