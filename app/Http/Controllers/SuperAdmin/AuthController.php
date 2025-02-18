<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;

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

        return view('superadmin.pages.welcome');
        $id = Auth::user()->id;
        $user = User::find($id);
        $service=Service::get();
         return view('auth.admin.pages.index', ['user_data' => $user,'services' => $service]);
    }


   public function superadmin_logout(){
            Auth::logout();
            return redirect('/');
   }
}

