<?php

namespace App\Exports;

use App\Models\Deduction;
use App\Models\Airline;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DeductionReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'Booking Number',
            'Agency Name',
            'Price',
            'Service Name',
            'Supplier Name',
            'Total Passenger',
            'Booking Date',
        ];
    }

    public function map($booking): array
    {
        // Decode flight details
        $flight_name = !empty($booking->flightBooking['details'])
            ? json_decode($booking->flightBooking['details'], true)
            : [];

        // Decode flight search passengers
        $passengers = !empty($booking->flightBooking->flightSearch)
            ? json_decode(json_decode($booking->flightBooking->flightSearch, true), true)
            : [];

        $totalPassengers = (int) ($passengers['adult'] ?? 0) +
                           (int) ($passengers['child'] ?? 0) +
                           (int) ($passengers['infant'] ?? 0);

        // Fetch airline name using flight code
        $flight_code = $flight_name[0]['journey'][0]['Carrier'] ?? null;
        $carrier = $flight_code ? Airline::where('iata', $flight_code)->first() : null;
        $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';

        return [
            $booking->invoice_number,
            $booking->agency->name ?? 'N/A',
            $booking->amount ?? 0,
            $booking->service_name->name ?? 'N/A',
            $carrierName,  // Fixed supplier name issue
            $totalPassengers,
            $booking->date,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Bold headings
        ];
    }
}
