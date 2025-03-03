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

use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class AgencyRoleController extends Controller
{
    /**** Function for Roles *****/

    public function hs_roleindex(){

        // $roles = Role::all();

        $userData = session('user_data');

        // Set the dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);
        
        // Get the user from the corresponding database
        $user = User::on('user_database')->where('email', $userData['email'])->first();
        // $roles = $user->getRoleNames(); // Get role names
    //    $permissions = $user->getAllPermissions()->pluck('name');
     
        
        if ($user->type == "staff") {
            $agency_record = Agency::where('database_name', $userData['database'])->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        } else {
            $agency_record = Agency::where('email', $user->email)->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        }
        
        // Fetch user roles dynamically
        $roles = Role::on('user_database')->get(); 
        $permissions = Permission::on('user_database')->get();

        //  $id = Auth::user()->id;
        // $user = User::find($id);
        // $permissions = Permission::all();
        $alluser=User::on('user_database')->get();

        return view('agencies.pages.role.role', ['user_data' => $user,'roles'=>$roles,'permissions'=>$permissions]);
    }


 /** Register  role  **/
    public function hs_rolecreate(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $alluser=User::get();
        $service=Service::get();
        return view('auth.admin.pages.Roles.role_form', ['user_data' => $user,'services' => $service,'users'=>$alluser]);
    }

    /** Store role  **/
    public function hs_rolestore(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
         ]);
         Role::create(['name' => $request->name]);
         return redirect()->route('superadmin.role')->with('success', 'Role created successfully.');
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

        $userData = session('user_data');

        // Set the dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);
        
        // Get the user from the corresponding database
        $user = User::on('user_database')->where('email', $userData['email'])->first();
        
        if ($user->type == "staff") {
            $agency_record = Agency::where('database_name', $userData['database'])->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        } else {
            $agency_record = Agency::where('email', $user->email)->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        }
        
        // Fetch user roles dynamically
   
          $role = Role::on('user_database')->findOrFail($id);
          $permissions = Permission::on('user_database')->get();
     
          $active_permissions = $role->permissions->pluck('name');
      
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
      

    /*** Assigend permssion ***/

    public function hs_permissioned(Request $request){
     
       
        $request->validate([
            'role_name' => 'required|string|exists:roles,name',
            'permissions' => 'array',
        ]);
    
        $userData = session('user_data');

        // Set the dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);
        
        // Get the user from the corresponding database
        $user = User::on('user_database')->where('email', $userData['email'])->first();
        
        if ($user->type == "staff") {
            $agency_record = Agency::where('database_name', $userData['database'])->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        } else {
            $agency_record = Agency::where('email', $user->email)->first();
            $agency = Agency::with('userAssignments.service')->find($agency_record->id);
        }
        
        // Fetch user roles dynamically
   
          $role = Role::on('user_database')->where('name', $request->role_name)->firstOrFail();

        // Find the role by name
       
    
        // Assign permissions to the role
        $role->syncPermissions($request->permissions);
    
        // return back()->with('success', 'Permissions Test!');
        return redirect()->route('agency.role')->with('success', 'Permissions assigned successfully!');
    }

}
