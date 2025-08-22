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
use App\Exports\PermissionExport;

class PermissionController extends Controller
{
   
    /*** Permission index ***/
    public function hs_permissionindex(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        
        // Build query with search functionality
        $query = Permission::query();
        
        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $permissions = $query->paginate(10)->withQueryString();
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

    /*** Export Permission to Excel ***/
    public function exportExcel(Request $request)
    {
        $query = Permission::query();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $permissions = $query->get();

        return Excel::download(new PermissionExport($permissions), 'permissions.xlsx');
    }

    /*** Export Permission to PDF ***/
    public function exportPDF(Request $request)
    {
        $query = Permission::query();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $permissions = $query->get();

        $data = [
            'permissions' => $permissions,
            'request' => $request
        ];

        $pdf = Pdf::loadView('pdf.permissions_report', $data);
        return $pdf->download('permissions.pdf');
    }
}
