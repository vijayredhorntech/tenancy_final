<?php

namespace App\Traits\Student;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentReportExport;

trait StudentPdfTrait
{



    public function generateStudentPDF($title, $users)
    {
        $data = [
            'title' =>  $title,
            'users' => $users
        ];

        $pdf = Pdf::loadView('pdf.staffpdf', $data);
        return $pdf->download('Staff.pdf');
    }





    public function generateStudentExcel($students)
        {
            return Excel::download(new StudentReportExport($students), 'students.xlsx');
        }
}
