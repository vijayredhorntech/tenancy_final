<?php

namespace App\Traits\Student;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentReportExport;
use App\Models\User;


trait StudentPdfTrait
{

    public function generateStudentData($request , $forExport = false)
    {
        $query = User::with(['roles', 'userdetails', 'teams']);
    
        // Exclude users with "Super Admin" role
        $query->whereDoesntHave('roles', function ($q) {
            $q->where('name', 'Super Admin');
        });
    
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
    
        // Date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
    
        // Status (from hasMany userdetails)
        if ($request->filled('status')) {
            $query->whereHas('userdetails', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }
    
        // Department (from hasMany userdetails)
        if ($request->filled('department')) {
            $query->whereHas('userdetails', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }
    
        // Team ID (from hasMany teams relation)
        if ($request->filled('teamid')) {
            $query->whereHas('teams', function ($q) use ($request) {
                $q->where('id', $request->teamid);
            });
        }
    
        // Role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->role);
            });
        }
    
        // Sorting
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
    
        // Pagination
        $users = $query->paginate($request->input('per_page', 10));
    
        return $users;
    }
    

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
