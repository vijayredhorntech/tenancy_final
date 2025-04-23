<?php

namespace App\Traits\Agency;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Agency;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AgencyExport;
use Illuminate\Http\Request;

trait AgenciesPdfTrait
{

    /**
     * Get Agency data
     */
    public function getAgencyData($request)
    {
        // dd($request);
        $query = Agency::with(['domains', 'userAssignments.service', 'balance', 'details']);
    
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('contact_person', 'LIKE', "%{$search}%");
            });
        }
    
        // Amount range filter (on related 'balance' model)
        if ($request->filled('amount_min')) {
            $query->whereHas('balance', function ($q) use ($request) {
                $q->where('balance', '>=', $request->amount_min);
            });
        }
        if ($request->filled('amount_max')) {
            $query->whereHas('balance', function ($q) use ($request) {
                $q->where('balance', '<=', $request->amount_max);
            });
        }
    
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
    
        // Status filter
        if ($request->filled('status')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }
    
        // Payment method filter (service_id inside userAssignments relationship)
        if ($request->filled('service_id')) {
            $query->whereHas('userAssignments', function ($q) use ($request) {
                $q->where('service_id', $request->service_id);
            });
        }
    
        // Sort
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
    
        // Paginate
        $agencies = $query->paginate($request->input('per_page', 10));
        // dd($agencies);
    
        return $agencies;
    }
    

    public function generateAgenciesPDF($title,$agencies)
    {
     
        $data = [
            'title' =>  $title,
            'agencies' => $agencies
        ];
    
        $pdf = Pdf::loadView('pdf.agencies', $data);
    
        return $pdf->download('agencies.pdf');
    }

    public function generateAgenciesExcel($agencies)
    {
     
        return Excel::download(new AgencyExport($agencies), 'agencies.xlsx');
    }
}
