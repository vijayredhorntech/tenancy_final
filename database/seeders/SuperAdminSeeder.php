<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Check if the superadmin already exists to avoid duplication
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'], // Unique identifier
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin@1232'),
                'type'  => 'superadmin',
            ]
        );

        // Ensure the role is assigned only if not already assigned
        if (!$superAdmin->hasRole('super admin')) {
            $superAdmin->assignRole('super admin');
        }
    }
}
