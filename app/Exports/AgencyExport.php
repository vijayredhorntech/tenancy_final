<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AgencyExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $agencies;

    public function __construct(Collection $agencies)
    {
        $this->agencies = $agencies;
    }

    public function collection()
    {
        return $this->agencies;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Agency Name',
            'Email',
            'Services',
            'Contact Person Name',
            'Contact Person Email',
            'Fund Allotted',
            'Fund Remaining',
            'Status'
        ];
    }

    public function map($agency): array
    {
        return [
            $agency->id,
            $agency->name,
            $agency->email,
            $agency->userAssignments->pluck('service.name')->implode(', '),
            $agency->contact_person,
            $agency->contact_phone,
            $agency->balance ? $agency->balance->balance : '0',
            $agency->balance ? $agency->balance->balance : '0',
            $agency->details->status == '0' ? 'Inactive' : 'Active'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Bold headings
            1 => ['font' => ['bold' => true]],
        ];
    }
}
