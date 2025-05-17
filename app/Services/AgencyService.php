<?php

namespace App\Services;

use App\Helpers\DatabaseHelper;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Support\Facades\Config;
use Auth;

class AgencyService
{

    

    // public function setConnection(){
    //     $userData = session('user_data');
    //     DatabaseHelper::setDatabaseConnection($userData['database']);
    // }

    public function getAgencyData()
    {
        $userData = session('user_data');
        if (!$userData) {
            return null; // Handle case where session data is missing
        }
        // Set dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);
        // Fetch user from dynamic database
        $user = User::on('user_database')->where('email', $userData['email'])->first();

        if (!$user) {
            return null; // Handle case where user is not found
        }

        // Fetch agency based on user type
        if ($user->type === "staff") {
            $agencyRecord = Agency::where('database_name', $userData['database'])->first();
        } else {
            $agencyRecord = Agency::where('email', $user->email)->first();
        }

        if (!$agencyRecord) {
            return null; // Handle case where agency is not found
        }

        // Fetch agency with user assignments and services
        return Agency::with('userAssignments.service')->find($agencyRecord->id);
    }


    /*****Get Record by Database *****/
    public function getAgencyDataByDatabase($database)
    {
        DatabaseHelper::setDatabaseConnection($database);
        $user = User::on('user_database')->where('email', $database)->first();

        if (!$user) {
            return null; 
        }
        // Fetch agency based on user type
        if ($user->type === "staff") {
            $agencyRecord = Agency::where('database_name', $database)->first();
        } else {
            $agencyRecord = Agency::where('email', $user->email)->first();
        }

        if (!$agencyRecord) {
            return null; // Handle case where agency is not found
        }

        // Fetch agency with user assignments and services
        return Agency::with('userAssignments.service')->find($agencyRecord->id);
    }




     /*****Get Record by Database *****/
     public function getCurrentLoginUser()
     {
        $userData = session('user_data');

        if (!$userData) {
            return null; // Handle case where session data is missing
        }

         DatabaseHelper::setDatabaseConnection($userData['database']);
         $user = User::on('user_database')->where('email', $userData['email'])->first();
         return  $user ; 
 
     }

     public function getAgencyDataWithToken($token){
        $agency = Agency::where('agencytoken',$token)->first();
        return $agency;
     }

     public function setDatabaseConnection(){
          $userData = \session('user_data');
          if(isset($userData))
          {
            DatabaseHelper::setDatabaseConnection($userData['database']);
             return true;  
          }
         
          return false;
        // DatabaseHelper::setDatabaseConnection($userData['database']);
     }

     public function setConnectionByDatabase($database){
        DatabaseHelper::setDatabaseConnection($database);
     }

     
}
