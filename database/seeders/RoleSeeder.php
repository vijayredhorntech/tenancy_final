<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::transaction(function () {
            // Define Permissions
            $permissions = [
                'manage everything', // Super Admin full access
            
                // Service Permissions
                'service view',
                'service create',
                'service update',
                'service delete',
            
                // Agency Permissions
                'agency view',
                'agency create',
                'agency update',
                'agency delete',
            
                // Staff Permissions
                'staff view',
                'staff create',
                'staff update',
                'staff delete',
            
                // Role Permissions
                'role view',
                'role create',
                'role update',
                'role delete',
            
                // Permission Management
                'permission view',
                'permission create',
                'permission update',
                'permission delete',
                       
                // Reports
                'view reports'
            ];

            // Create Permissions if they do not exist
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }

            // Create Roles
            $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
            $admin = Role::firstOrCreate(['name' => 'admin']);
            $agency = Role::firstOrCreate(['name' => 'agencies']);

            // Assign Permissions to Roles
            $superAdmin->syncPermissions(Permission::all()); // Full access to Super Admin
            $admin->syncPermissions();
            $agency->syncPermissions();

            // Assign Super Admin Role to Default User (Optional)
            $defaultUser = User::find(1); // Change the ID if needed
            if ($defaultUser && !$defaultUser->hasRole('super admin')) {
                $defaultUser->assignRole('super admin');
            }
        });
    }
}
