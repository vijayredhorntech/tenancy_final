<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthocheckHelper
{
    public function logincheck($redirect){
        // dd('heelo');
        $id = Auth::user()->id;
        if(isset($id)){
            return redirect()->route($redirect);
        }
    
    }

}