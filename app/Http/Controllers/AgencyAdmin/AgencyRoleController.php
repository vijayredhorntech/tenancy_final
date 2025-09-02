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


    public function hsCLonePermission()
    {
        $agency = $this->agencyService->getAgencyData();
        $user = $this->agencyService->getCurrentLoginUser();

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
        ];
            $createdPermissions = [];
        foreach ($permissions as $permName) {
            // Check if permission exists in user_database
            $exists = Permission::on('user_database')
                ->where('name', $permName)
                ->exists();

            if (!$exists) {
                // Not exists → create in user_database
                Permission::on('user_database')->create([
                    'name' => $permName,
                    'guard_name' => 'web',
                ]);
                 $createdPermissions[] = $perm->id;
            }
        }
          $superAdmin = Role::on('user_database')->firstOrCreate(
        ['name' => 'super admin', 'guard_name' => 'web']
    );

    // Assign all permissions to superadmin
    $superAdmin->syncPermissions($createdPermissions);
        return "Permissions synced successfully!";
    }


    /*** Assigend permssion ***/

    public function hs_permissioned(Request $request){
     
  
        $request->validate([
            'role_name' => 'required|string',
            'permissions' => 'array',
        ]);
    
        $agency = $this->agencyService->getAgencyData();
        $user = $this->agencyService->getCurrentLoginUser();       
        // Fetch user roles dynamically
   
        $role = Role::on('user_database')->where('name', $request->role_name)->firstOrFail();

            // Fetch the permissions from the same connection as the role
            $permissions = Permission::on('user_database')
                ->whereIn('name', $request->permissions)
                ->get();

            // Now sync using the models, not just names
            $role->syncPermissions($permissions);
    
        // return back()->with('success', 'Permissions Test!');
        return redirect()->route('agency.role')->with('success', 'Permissions assigned successfully!');
    }

}
