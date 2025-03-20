<?php

namespace App\Traits\Agency;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Agency;

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
}
