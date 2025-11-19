<?php

namespace App\Services;

use App\Helpers\DatabaseHelper;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Support\Facades\Config;
use Auth;
use App\Models\VisaApplicationAudit;
use App\Models\ClientDetails;
use App\Models\AuthervisaApplication;



class AgencyService
{

    

    // public function setConnection(){
    //     $userData = session('user_data');
    //     DatabaseHelper::setDatabaseConnection($userData['database']);
    // }

    public function getAgencyData()
    {
        $userData = session('user_data');
        if (!$userData || !isset($userData['database']) || !isset($userData['email'])) {
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
       
        if (!$userData || !isset($userData['database']) || !isset($userData['email'])) {
            return null; // Handle case where session data is missing
        }

         DatabaseHelper::setDatabaseConnection($userData['database']);
         $user = User::on('user_database')->where('email', $userData['email'])->first();
         return  $user ; 
 
     }

     public function getAgencyDataWithToken($token){
        $agency = Agency::where('agencytoken', $token)->first();
        if ($agency) {
            DatabaseHelper::setDatabaseConnection($agency->database_name);
        }
        return $agency;
    }

     public function setDatabaseConnection(){
    //    dd('here');
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

     public function getClientData($invoices){
          foreach ($invoices as $invoice) {
        
  
         
        if ($invoice->agency && $invoice->visaBooking) {
            // Set dynamic DB connection
            $this->setConnectionByDatabase($invoice->agency->database_name);

            $clientId = $invoice->visaBooking->client_id;
            $bookingId = $invoice->visaBooking->id;

            // Fetch client from user DB
            $clientFromUserDB = ClientDetails::on('user_database')
                ->with('clientinfo')
                ->find($clientId);
        

            // Fetch other visa applicants from user DB
            $otherMembers = AuthervisaApplication::on('user_database')
                ->where('client_id', $clientId)
                ->where('booking_id', $bookingId)
                ->get();

            // Attach to model relationships
            $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
            $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
        }
     }
     
}

public function getClientinfo($invoices){

     
    foreach ($invoices as $invoice) {
           
        if ($invoice->agency && $invoice->visaBooking) {

            $this->setConnectionByDatabase($invoice->agency->database_name);

            $clientId = $invoice->visaBooking->client_id;
            $bookingId = $invoice->visaBooking->id;

            // Fetch related data from the user's database
            $clientFromUserDB = ClientDetails::on('user_database')
                ->with('clientinfo')
                ->find($clientId);

            $otherMembers = AuthervisaApplication::on('user_database')
                ->where('client_id', $clientId)
                ->where('booking_id', $bookingId)
                ->get();

            // Attach dynamically loaded relations
            $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
            $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
        }
    }
    return $invoices;

}

    
    public function getClientinfoById($invoice){
      
        // dd("heelo");
     if ($invoice->agency && $invoice->visaBooking) {
            $this->setConnectionByDatabase($invoice->agency->database_name);
            $clientId = $invoice->visaBooking->client_id;
            $bookingId = $invoice->visaBooking->id;
            // Fetch related data from the user's database
           $clientFromUserDB = ClientDetails::on('user_database')
                ->with('clientinfo','familyMembers')
                ->find($clientId); 
            
            $otherMembers = AuthervisaApplication::on('user_database')
                ->where('client_id', $clientId)
                ->where('booking_id', $bookingId)
                ->get();

            // Attach dynamically loaded relations
            $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
            $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
            return $invoice; // Return the modified invoice objec
        }
        return false;
 }

 /***Get Booking by Visacontroller **** */
 public function getClientinfoVisaBookingById($invoice){
    

    if ($invoice->agency) {
        //   dd($invoice);
   
           $this->setConnectionByDatabase($invoice->agency->database_name);
           $clientId = $invoice->client_id;
           $bookingId = $invoice->id;
           // Fetch related data from the user's database
           $clientFromUserDB = ClientDetails::on('user_database')
               ->with('clientinfo')
               ->find($clientId);
           $otherMembers = AuthervisaApplication::on('user_database')
               ->where('client_id', $clientId)
               ->where('booking_id', $bookingId)
               ->get();

           // Attach dynamically loaded relations
           $invoice->setRelation('client', $clientFromUserDB);
           $invoice->setRelation('otherclients', $otherMembers);
         
           return $invoice; // Return the modified invoice objec
       }
       return false;
}

public function getClientDetails($clientId,$agencyData){
    //   dd($id);
    // dd($agencyData->database_name);
       $this->setConnectionByDatabase($agencyData->database_name);
          
           // Fetch related data from the user's database
           $clientFromUserDB = ClientDetails::on('user_database')
               ->with('clientinfo')
               ->find($clientId);
               return $clientFromUserDB;
           


}

public function checkValidationInfo($email, $agencyData, $phoneNumber)
{
    // Switch to the agency's database
    $this->setConnectionByDatabase($agencyData->database_name);

    // Fetch related data from the user's database
    return ClientDetails::on('user_database')
        ->with('clientinfo')
        ->where('email', $email)
        ->where('phone_number', $phoneNumber)
        ->first();
}


public function getAgencyClicntBYSearchValue($searchVariable)
{
    // Get all session data
    $session = session()->all();

    // Get agency by domain
    $agency = Agency::with('domains')
        ->whereHas('domains', function ($q) use ($session) {
            $q->where('domain_name', $session['agency_domain'] ?? null);
        })
        ->first();

    if (!$agency) {
        return false;
    }

    // Switch DB connection
    $this->setConnectionByDatabase($agency->database_name);

    // Fields to search
    $fields = ['clientuid', 'email', 'phone_number'];

    foreach ($fields as $field) {
        $client = ClientDetails::on('user_database')
            ->where($field, $searchVariable)
            // ->where('agency_id', $agency->id)
            ->first();

        if ($client) {
            return $client;   // Found → return immediately
        }
    }

    return false; // Not found in any field
}



}
