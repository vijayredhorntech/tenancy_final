<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    public function collection()
    {
        return $this->roles;
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'Role Name',
            'Permissions Count',
            'Created At'
        ];
    }

    public function map($role): array
    {
        static $index = 0;
        $index++;
        
        return [
            $index,
            strtoupper($role->name),
            $role->permissions->count(),
            $role->created_at ? $role->created_at->format('Y-m-d H:i:s') : 'N/A'
        ];
    }
}
