<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FundExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Agency Name',
            'Amount',
            'Payment Type',
            'Status',
            'Date',
        ];
    }

    public function map($record): array
    {
        return [
            $record->id,
            $record->agency->name ?? 'N/A',
            $record->amount,
            ucfirst($record->payment_type),
            $record->status == 1 ? 'Under Process ' : 'Complete',
            $record->created_at->format('Y-m-d H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
