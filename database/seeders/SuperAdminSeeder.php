<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming you're using the User model for authentication

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Check if the superadmin already exists to avoid duplication
       
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'], // email is unique for superadmin
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('admin@1232'), // Set a default password
                
            ]
        );

        // Optionally, you can assign roles or permissions here
    }
}
