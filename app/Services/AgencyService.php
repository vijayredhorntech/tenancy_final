<?php

namespace App\Services;

use App\Helpers\DatabaseHelper;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Support\Facades\Config;
use Auth;
use App\Models\VisaApplicationAudit;

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

     public function getLoginClient(){
         $userData = session('user_data');
         return $userData;

     }

    //  public function saveLog($applicationId, $applicationNumber, $userType, $auditName, $userId, $description = null)
    //  {
    //      $audit = new VisaApplicationAudit();
    //      $audit->application_id     = $applicationId;
    //      $audit->application_number = $applicationNumber;
    //      $audit->user_id            = $userId;
    //      $audit->user_type          = $userType;
    //      $audit->audit_name         = $auditName;
    //      $audit->description        = $description;
    //      $audit->audit_date         = now()->toDateString();
    //      $audit->audit_time         = now()->toTimeString();
    //      $audit->save();
     
    //      return true;
    //  }
  
     public function saveLog($booking, $user_type, $auditName, $userId, $description = null)
     {
        $visa = new VisaApplicationAudit();
        $visa->application_id     = $booking->id;
        $visa->application_number = $booking->application_number;
        $visa->user_id            = $userId;
        $visa->user_type          = $user_type;
        $visa->audit_name         = $auditName;
        $visa->description        = $description;
        $visa->audit_date         = now()->toDateString();
        $visa->audit_time         = now()->toTimeString();
        $visa->save();
        return true;
    
     }
     
}
