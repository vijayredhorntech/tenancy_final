<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientExport implements FromQuery, WithHeadings, WithMapping, WithStyles
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
            'Client ID',
            'Full Name',
            'Email',
            'Phone Number',
            'Gender',
            'Marital Status',
            'Nationality',
            'Passport Issue Date',
            'Passport Expiry Date',
            'Residential Address',
        ];
    }

    public function map($client): array
    {
        return [
            $client->id,
            $client->name,
            $client->email,
            $client->phone_number ?? '',
            $client->clientinfo->gender ?? '',
            $client->clientinfo->marital_status ?? '',
            $client->clientinfo->nationality ?? '',
            $client->clientinfo->passport_issue_date ?? '',
            $client->clientinfo->passport_expiry_date ?? '',
            $client->clientinfo->residential_address ?? '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Bold headers
            1 => ['font' => ['bold' => true]],
        ];
    }
}
