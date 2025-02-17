<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;

use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use Auth;

class ServiceController extends Controller
{
    
 /**** */
 public function him_test(){

    $id = Auth::user()->id;
    // dd($id); 
    $userData = \session('user_data');
    DatabaseHelper::setDatabaseConnection($userData['database']);
    $user = User::on('user_database')->where('id', $id)->first();
    $agency_record=Agency::where('email',$user->email)->first(); 
    $agency = Agency::with('userAssignments.service')->find($agency_record->id);
   
    $services = $agency->userAssignments->pluck('service.name', 'service.icon');
      return view('agencies.pages.test',[
        'user_data' => $user,
        'services' => $services,
        'agency'=>$agency_record,
        'all_agency'=>$agency
        ]);

 }

 public function him_flight(){
    $id = Auth::user()->id;
    // dd($id); 
    $userData = \session('user_data');
    DatabaseHelper::setDatabaseConnection($userData['database']);
    $user = User::on('user_database')->where('id', $id)->first();
    $agency_record=Agency::where('email',$user->email)->first(); 
    $agency = Agency::with('userAssignments.service')->find($agency_record->id);
    $services = $agency->userAssignments->pluck('service.name', 'service.icon');
    
    return view('agencies.pages.flight.flight',[
        'user_data' => $user,
        'services' => $services,
        'agency'=>$agency_record,
        'all_agency'=>$agency
        ]);
 }

}
