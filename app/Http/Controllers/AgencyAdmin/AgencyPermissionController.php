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

class AgencyPermissionController extends Controller
{
    /*** Permission index ***/
    public function hs_permissionindex(){
        $id = Auth::user()->id;
        $user = User::find($id);
        // $permissions = Permission::all();
        $permissions = Permission::paginate(10);
        $service=Service::get();
    
        return view('superadmin.pages.permission.permission', ['user_data' => $user,'services' => $service,'permissions'=>$permissions]);
    }
    

    /*** Permission Create  ***/
    public function hs_permissioncreate(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $service=Service::get();
        return view('auth.admin.pages.permission.permission_form', ['user_data' => $user,'services' => $service]);
    }

    /** Store role  **/
    public function hs_permissionstore(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name',
         ]);
         Permission::create(['name' => $request->name]);
         return redirect()->route('superadmin.permission')->with('success', 'Permission created successfully.');
    }
    
    

      /*** Delete Permission ***/
      public function hs_permissiondelete($id){

        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('success', 'Permission deleted successfully');
    }
}
