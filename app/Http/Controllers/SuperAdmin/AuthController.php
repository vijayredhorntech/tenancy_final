<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\Agency;


class AuthController extends Controller
{

    public function login_form(){

//   $id = "/superadmin/dashboard";
        // AuthocheckHelper::logincheck();
        return view('auth.login');
    }
    // function for loginm
    public function superadmin_login(Request $request)
    {
        // Validate input
        // dd($request->all());
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect("/superadmin/dashboard");
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }


    public function hs_dashbord(){

       
        $id = Auth::user()->id;
  
        $user = User::find($id);
        $roles = $user->roles->pluck('name')->implode(', ');
        $service = Service::all(); // Use all() instead of get() (optional)
    
    // $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])->get(); // Array format for clarity
    $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])
    ->take(5) // Limits the result to 5 records
    ->get();
    
    $total = Balance::sum('balance'); // Add quotes around balance

    // $bookings = Deduction::with('agency')->orderBy('id', 'desc')->get();
    $bookings = Deduction::with(['service_name', 'agency'])
    // ->orderBy('created_at', 'desc') // Orders by latest records
    // ->take(5)
    ->get();

    $funds = AddBalance::with('agency')
    ->orderBy('created_at', 'desc') // Orders by latest records
    ->take(5)
    ->get();

 

    $recent_booking = Deduction::with(['service_name', 'agency'])
    ->orderBy('created_at', 'desc') // Orders by latest records
    ->take(5)
    ->get();

 
    // dd($bookings); 

    $users = User::get();
        
        return view('superadmin.pages.welcome',compact('roles', 'service', 'agency', 'total', 'bookings','users','recent_booking','funds'));
         return view('auth.admin.pages.index', ['user_data' => $user,'services' => $service]);
    }


   public function superadmin_logout(){
            Auth::logout();
            return redirect('/');
   }


   
}

