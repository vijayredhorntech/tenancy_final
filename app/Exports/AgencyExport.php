<?php

namespace App\Exports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgencyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agency::select('id', 'name', 'email', 'phone', 'created_at')->get();
        // return Agency::all();
    }

    public function headings(): array
    {
        return ["ID", "Agency Name", "Email", "Phone", "Created At"];
    }
}
