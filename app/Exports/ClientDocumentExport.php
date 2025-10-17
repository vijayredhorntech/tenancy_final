<?php

namespace App\Exports;

use App\Models\ClientDocument;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ClientDocumentExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $agencyId;
    protected $search;

    public function __construct($agencyId, $search = null)
    {
        $this->agencyId = $agencyId;
        $this->search = $search;
    }

    public function query()
    {
        $query = ClientDocument::with(['client'])
            ->where('agency_id', $this->agencyId)
            ->latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('client', function ($clientQuery) {
                    $clientQuery->where('client_name', 'like', '%' . $this->search . '%')
                              ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                })
                ->orWhere('document_name', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Client Name',
            'Phone Number',
            'Document Name',
            'Received On',
            'Remarks',
            'Returned On',
            'Return Remarks',
            'Status'
        ];
    }

    public function map($document): array
    {
        return [
            $document->id,
            $document->client->client_name ?? 'N/A',
            $document->client->phone_number ?? 'N/A',
            strtoupper($document->document_name),
            $document->received_on ? $document->received_on->format('Y-m-d H:i:s') : 'N/A',
            $document->remarks ?? '',
            $document->returned_on ? $document->returned_on->format('Y-m-d H:i:s') : 'N/A',
            $document->return_remarks ?? '',
            $document->returned_on ? 'Returned' : 'Pending'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
