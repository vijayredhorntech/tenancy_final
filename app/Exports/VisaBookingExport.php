<?php
namespace App\Exports;

use App\Models\VisaBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisaBookingExport implements FromCollection, WithHeadings
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
                'Booking Number' => $booking->application_number,
                'Client Name'    => optional($booking->clint)->client_name,
                'Email'          => optional($booking->clint)->email,
                'Phone'          => optional($booking->clint)->phone_number,
                'Price'          => $booking->total_amount,
                'Visa Type'      => optional($booking->visa)->name,
                'Origin'         => optional($booking->origin)->countryName,
                'Destination'    => optional($booking->destination)->countryName,
                'Status'         => $booking->applicationworkin_status,
                'Date'           => $booking->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Booking Number',
            'Client Name',
            'Email',
            'Phone',
            'Price',
            'Visa Type',
            'Origin',
            'Destination',
            'Status',
            'Date',
        ];
    }
}
