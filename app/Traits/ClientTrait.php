<?php

namespace App\Traits;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientExport;


trait ClientTrait
{

    public function generateClintPDF($title, $clints)
    {
     
        $data = [
            'title' =>  $title,
            'clients' => $clints
        ];

        $pdf = Pdf::loadView('pdf.clintpdf', $data);
        return $pdf->download('Client.pdf');
    }





      public function generateClintsExcel($clints)
        {
            return Excel::download(new ClientExport($clints), 'clients.xlsx');
        }

        public function savedata($data){
            dd($data);
        }
}
