<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PermissionExport implements FromCollection, WithHeadings, WithMapping
{
    protected $permissions;

    public function __construct($permissions)
    {
        $this->permissions = $permissions;
    }

    public function collection()
    {
        return $this->permissions;
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'Permission Name',
            'Created At'
        ];
    }

    public function map($permission): array
    {
        static $index = 0;
        $index++;
        
        return [
            $index,
            strtoupper($permission->name),
            $permission->created_at ? $permission->created_at->format('Y-m-d H:i:s') : 'N/A'
        ];
    }
}
