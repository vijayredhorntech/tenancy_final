<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoleExport;

class RoleController extends Controller
{
       /**** Function for Roles *****/

       public function hs_roleindex(Request $request){

        // Build query with search functionality
        $query = Role::with('permissions');
        
        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $roles = $query->paginate(10)->withQueryString();
         $id = Auth::user()->id;
        $user = User::find($id);
        $permissions = Permission::all();
        $alluser=User::get();
        $service=Service::get();
        return view('superadmin.pages.role.role', ['user_data' => $user,'services' => $service,'roles'=>$roles,'permissions'=>$permissions]);
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

          $user = User::findOrFail(Auth::id());
          $role = Role::findOrFail($id);
          $permissions = Permission::all();
        // $permissions = Permission::paginate(10);
      
          // Get active permissions assigned to this role
          $active_permissions = $role->permissions->pluck('name');
      
          // Get all services (if needed)
          $services = Service::all();
      
          // Pass data to Blade view
          return view('superadmin.pages.role.single_role', [
              'user_data' => $user,
              'services' => $services,
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
    
        // Find the role by name
        $role = Role::where('name', $request->role_name)->firstOrFail();
    
        // Assign permissions to the role
        $role->syncPermissions($request->permissions);
    
        // return back()->with('success', 'Permissions Test!');
        return redirect()->route('superadmin.role')->with('success', 'Permissions assigned successfully!');
    }

    /*** Export Role to Excel ***/
    public function exportExcel(Request $request)
    {
        $query = Role::with('permissions');

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->get();

        return Excel::download(new RoleExport($roles), 'roles.xlsx');
    }

    /*** Export Role to PDF ***/
    public function exportPDF(Request $request)
    {
        $query = Role::with('permissions');

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->get();

        $data = [
            'roles' => $roles,
            'request' => $request
        ];

        $pdf = Pdf::loadView('pdf.roles_report', $data);
        return $pdf->download('roles.pdf');
    }

}
