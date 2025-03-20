<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles
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
            'Employee Id',
            'Staff Name',
            'Email',
            'Phone Number',
            'Department',
            'Role',
        ];
    }



    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->email,
            $student->userdetails->phone_number ?? '',
            '',
            $student->roles->isNotEmpty() ? $student->roles->pluck('name')->implode(', ') : 'No Role'
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
