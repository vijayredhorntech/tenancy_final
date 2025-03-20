<?php

namespace App\Traits\Agency;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Agency;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AgencyExport;

trait AgenciesPdfTrait
{

    
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
