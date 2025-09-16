<?php

namespace App\Http\Controllers\AgencyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Agency;
use App\Services\AgencyService;



use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class AgencyRoleController extends Controller
{

    
    protected $agencyService;

    public function __construct( AgencyService $agencyService) {
               $this->agencyService = $agencyService;
        }

    /**** Function for Roles *****/

    public function hs_roleindex(){

 
        
        $agency = $this->agencyService->getAgencyData();
        $user = $this->agencyService->getCurrentLoginUser();

        // Fetch user roles dynamically
        $roles = Role::on('user_database')->get(); 
        $permissions = Permission::on('user_database')->get();

        //  $id = Auth::user()->id;
        // $user = User::find($id);
        // $permissions = Permission::all();
        $alluser=User::on('user_database')->get();

        return view('agencies.pages.role.role', ['user_data' => $user,'roles'=>$roles,'permissions'=>$permissions]);
    }


 

    /** Store role  **/
    public function hs_rolestore(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
         ]);

         
        $agency = $this->agencyService->getAgencyData();
        $user = $this->agencyService->getCurrentLoginUser();
        Role::on('user_database')->create([
                    'name' => $validated['name'],
                    'guard_name' => 'web', // required if Spatie Permission is used
                ]);
         return redirect()->route('agency.role')->with('success', 'Role created successfully.');
    }



    /*** Delete Role ***/
    public function hs_roledelete($id){

        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }

      /*** Assign Permission ***/
     
      public function hs_permissionassign($id)
      {

       
        $agency = $this->agencyService->getAgencyData();
        $user = $this->agencyService->getCurrentLoginUser();
        
        // Fetch user roles dynamically
   
          $role = Role::on('user_database')->findOrFail($id);
          $permissions = Permission::on('user_database')->get();

          $active_permissions = $role->permissions->pluck('name')->toArray();
        //   dd($active_permissions);
      
          // Get all services (if needed)
        //   $services = Service::all();

          // Pass data to Blade view
          return view('agencies.pages.role.single_role', [
              'user_data' => $user,
              'roles' => $role,
              'permissions' => $permissions,
              'active_permissions' => $active_permissions, // Fixed variable name
          ]);
      }


// public function hsCLonePermission()
// {
//     $agency = $this->agencyService->getAgencyData();
//     $user   = $this->agencyService->getCurrentLoginUser();

//     $permissions = [
//         'visa view',
//         'service view',
//         'manage everything',
//         'requestform',
//         'client',
//         'invoice',
//         'booking view',
//         'flightbooking',
//         'hotelbooking',
//         'staff view',
//         'team',
//         'expensive',
//         'role view',
//         'term condition',
//         'create client history',
//         'export client history',
//         'delete client history'

//     ];

//     $createdPermissions = [];

//     foreach ($permissions as $permName) {
//         // Check if permission exists in user_database
//         $perm = Permission::on('user_database')
//             ->where('name', $permName)
//             ->where('guard_name', 'web')
//             ->first();

//         if (!$perm) {
//             // Not exists → create in user_database
//             $perm = Permission::on('user_database')->create([
//                 'name'       => $permName,
//                 'guard_name' => 'web',
//             ]);
//         }

//         // Collect ID (or you could collect name instead)
//         $createdPermissions[] = $perm->id;
//     }

//     // Create/find super admin role in user_database
//     $superAdmin = Role::on('user_database')->firstOrCreate(
//         ['name' => 'super admin', 'guard_name' => 'web']
//     );

//     // Assign all permissions to superadmin
//     $superAdmin->syncPermissions($createdPermissions);

//     return "Permissions synced successfully!";
// }

public function hsCLonePermission()
{
    $agency = $this->agencyService->getAgencyData();
    $user   = $this->agencyService->getCurrentLoginUser();

    $permissions = [
        'visa view',
        'service view',
        'manage everything',
        'requestform',
        'client',
        'invoice',
        'booking view',
        'flightbooking',
        'hotelbooking',
        'staff view',
        'team',
        'expensive',
        'role view',
        'term condition',
        'create client history',
        'export client history',
        'delete client history'
    ];

    $createdPermissions = collect();

    foreach ($permissions as $permName) {
        // Check if permission exists in user_database
        $perm = Permission::on('user_database')
            ->where('name', $permName)
            ->where('guard_name', 'web')
            ->first();

        if (!$perm) {
            // Create permission if it doesn't exist
            $perm = Permission::on('user_database')->create([
                'name'       => $permName,
                'guard_name' => 'web',
            ]);
        }

        $createdPermissions->push($perm); // collect the full Permission model
    }

    // Create/find super admin role in user_database
    $superAdmin = Role::on('user_database')->firstOrCreate(
        ['name' => 'super admin', 'guard_name' => 'web']
    );

    // Assign all permissions (models, not IDs) to superadmin
    $superAdmin->syncPermissions($createdPermissions->all());

    return "Permissions synced successfully!";
}




    /*** Assigend permssion ***/

public function hs_permissioned(Request $request)
{
    $request->validate([
        'role_name'   => 'required|string',
        'permissions' => 'array',
    ]);

    $agency = $this->agencyService->getAgencyData();
    $user = $this->agencyService->getCurrentLoginUser();

    // Fetch role from the user_database connection
    $role = Role::on('user_database')
        ->where('name', $request->role_name)
        ->firstOrFail();

    // Ensure permissions exist and belong to the same guard
    $permissions = Permission::on('user_database')
        ->whereIn('name', $request->permissions)
        ->where('guard_name', $role->guard_name) // make sure guard matches role
        ->get();

    if ($permissions->isEmpty() && !empty($request->permissions)) {
        return back()->with('error', 'One or more permissions do not exist for this guard.');
    }

    // Sync permissions safely
    $role->syncPermissions($permissions);

    return redirect()->route('agency.role')
        ->with('success', 'Permissions assigned successfully!');
}


}
