<?php

namespace App\Repositories;

use App\Models\ClientDetails;
use App\Models\Country;
use App\Models\VisaServices;
use App\Models\VisaSubtype;
use App\Models\VisaServiceType;
use App\Models\VisaBooking;
use App\Models\Deduction;
use App\Models\Balance;
use App\Models\Agency;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Services\FileUploadService;
use Auth; 
use Illuminate\Support\Str;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Models\ClientMoreInfo;
use App\Services\AgencyService;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeEmail; 
use App\Models\ClientApplicationDocument;



class ClintRepository implements ClintRepositoryInterface
{
    

    protected $fileUploadService,$agencyService;

    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->agencyService = $agencyService;
    }



    // public function getAllClint(){
 
   
    //     /**Get Agency record *****/
    //     $agency = $this->agencyService->getAgencyData();
    //     return ClientDetails::with('clientinfo')->where('agency_id',$agency->id)->paginate(10);
    // }


    // In ClintRepository.php
    public function getAllClint($data)
    {
        $agency = $this->agencyService->getAgencyData();
    
        $query = ClientDetails::on('user_database')->with('clientInfo')
                    ->where('agency_id', $agency->id);
    
        if (!empty($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('client_name', 'like', '%' . $data['search'] . '%')
                  ->orWhere('email', 'like', '%' . $data['search'] . '%')
                  ->orWhere('clientuid', 'like', '%' . $data['search'] . '%')
                  ->orWhere('phone_number', 'like', '%' . $data['search'] . '%');
            });
        }
    
        if (!empty($data['date_from']) && !empty($data['date_to'])) {
            $query->whereBetween('created_at', [$data['date_from'], $data['date_to']]);
        }
    
        if (!empty($data['client_city'])) {
            $query->whereHas('clientInfo', function ($q) use ($data) {
                $q->where('city', 'like', '%' . $data['client_city'] . '%');
            });
        }
    
        return $query->paginate($data['per_page'] ?? 10);
    }
    


    
//     public function getStoreclint(array $data)
// {
//     return DB::transaction(function () use ($data) {

//         if (!empty($data['agency_id'])) {
//             $agencyid = $data['agency_id'];
//         } else {
//             $agency = $this->agencyService->getAgencyData();
//             $agencyid = $agency->id;
//         }

//         $agency = $this->agencyService->getAgencyData();

//         // Generate Unique Client ID
//         do {
//             $clientID = strtoupper(Str::random(4));
//         } while (ClientDetails::where('clientuid', $clientID)->exists());

//         // Create New Client
//         $client = new ClientDetails();
//         $client->setConnection('user_database');

//         $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
//         $client->clientuid = $clientID;
//         $client->agency_id = $agencyid;
//         $client->first_name = $data['first_name'] ?? '';
//         $client->last_name = $data['last_name'] ?? '';
//         $client->gender = $data['gender'] ?? '';
//         $client->marital_status = $data['marital_status'] ?? '';
//         $client->date_of_birth = $data['date_of_birth'] ?? '';
//         $client->phone_number  = $data['phone_number'] ?? '';
//         $client->email = $data['email'] ?? '';
//         $client->zip_code = $data['zip_code'] ?? '';
//         $client->address = $data['address'] ?? '';
//         $client->street = $data['street'] ?? '';
//         $client->city = $data['city'] ?? '';
//         $client->country = $data['country'] ?? '';
//         $client->permanent_address = $data['permanent_address'] ?? '';
//         $client->save();

//         // Create More Info
//         $clientdetails = new ClientMoreInfo();
//         $clientdetails->setConnection('user_database');

//         $clientdetails->clientid = $client->id;
//         $clientdetails->previous_name = $data['previous_name'] ?? '';
//         $clientdetails->passport_issue_date = $data['passport_issue_date']?? '';
//         $clientdetails->religion = $data['religion'] ?? '';
//         $clientdetails->place_of_birth = $data['place_of_birth'] ?? '';
//         $clientdetails->country_of_birth = $data['country_of_birth'] ?? '';
//         $clientdetails->citizenship_id = $data['citizenship_id'] ?? '';
//         $clientdetails->identification_marks = $data['identification_marks'] ?? '';

        
//         $clientdetails->educational_qualification = $data['educational_qualification'] ?? '';
//         $clientdetails->nationality = $data['nationality'] ?? '';
//         $clientdetails->past_nationality = $data['past_nationality'] ?? '';

//         $clientdetails->passport_country = $data['passport_country'] ?? '';
//         $clientdetails->passport_issue_place = $data['passport_issue_place'] ?? '';
//         $clientdetails->passport_ic_number = $data['passport_ic_number'] ?? '';
//         $clientdetails->passport_issue_date = $data['passport_issue_date'] ?? '';
//         $clientdetails->passport_expiry_date = $data['passport_expiry_date'] ?? '';

        

//         $clientdetails->father_details = $data['father_name'] ?? '';
//         $clientdetails->mother_details = $data['mother_name'] ?? '';
//         $clientdetails->spouse_details = $data['spouse_name'] ?? '';
//         $clientdetails->children = $data['children']?? '';

//         $clientdetails->previous_visa_number = $data['previous_visa_number'] ?? '';
//         $clientdetails->previous_visa_place = $data['previous_visa_place'] ?? '';
//         $clientdetails->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? '';
//         $clientdetails->cities_visited = $data['cities_visited'] ?? '';

        
//         $clientdetails->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? '';
//         $clientdetails->present_occupation = $data['present_occupation'] ?? '';
//         $clientdetails->designation = $data['designation'] ?? '';
//         $clientdetails->employer_name = $data['employer_name'] ?? '';
//         $clientdetails->employer_address = $data['employer_address'] ?? '';
//         $clientdetails->employer_phone = $data['employer_phone'] ?? '';
//         $clientdetails->past_occupation = $data['past_occupation'] ?? '';
//         $clientdetails->reference_name = $data['reference_name'] ?? '';
//         $clientdetails->reference_address = $data['reference_address'] ?? '';
//         $clientdetails->save();


//         $originalclient = new ClientDetails();
        

//         $originalclient->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
//         $originalclient->clientuid = $clientID;
//         $originalclient->agency_id = $agencyid;
//         $originalclient->first_name = $data['first_name'] ?? '';
//         $originalclient->last_name = $data['last_name'] ?? '';
//         $originalclient->gender = $data['gender'] ?? '';
//         $originalclient->marital_status = $data['marital_status'] ?? '';
//         $originalclient->date_of_birth = $data['date_of_birth'] ?? '';
//         $originalclient->phone_number  = $data['phone_number'] ?? '';
//         $originalclient->email = $data['email'] ?? '';
//         $originalclient->zip_code = $data['zip_code'] ?? '';
//         $originalclient->address = $data['address'] ?? '';
//         $originalclient->street = $data['street'] ?? '';
//         $originalclient->city = $data['city'] ?? '';
//         $originalclient->country = $data['country'] ?? '';
//         $originalclient->permanent_address = $data['permanent_address'] ?? '';
//         $originalclient->save();

//         // Create More Info
//         $originalclientdetails = new ClientMoreInfo();
        
//         $originalclientdetails->clientid = $client->id;
//         $originalclientdetails->previous_name = $data['previous_name'] ?? '';
//         $originalclientdetails->passport_issue_date = $data['passport_issue_date']?? '';
//         $originalclientdetails->religion = $data['religion'] ?? '';
//         $originalclientdetails->place_of_birth = $data['place_of_birth'] ?? '';
//         $originalclientdetails->country_of_birth = $data['country_of_birth'] ?? '';
//         $originalclientdetails->citizenship_id = $data['citizenship_id'] ?? '';
//         $originalclientdetails->identification_marks = $data['identification_marks'] ?? '';

        
//         $originalclientdetails->educational_qualification = $data['educational_qualification'] ?? '';
//         $originalclientdetails->nationality = $data['nationality'] ?? '';
//         $originalclientdetails->past_nationality = $data['past_nationality'] ?? '';

//         $originalclientdetails->passport_country = $data['passport_country'] ?? '';
//         $originalclientdetails->passport_issue_place = $data['passport_issue_place'] ?? '';
//         $originalclientdetails->passport_ic_number = $data['passport_ic_number'] ?? '';
//         $originalclientdetails->passport_issue_date = $data['passport_issue_date'] ?? '';
//         $originalclientdetails->passport_expiry_date = $data['passport_expiry_date'] ?? '';

        

//         $originalclientdetails->father_details = $data['father_name'] ?? '';
//         $originalclientdetails->mother_details = $data['mother_name'] ?? '';
//         $originalclientdetails->spouse_details = $data['spouse_name'] ?? '';
//         $originalclientdetails->children = $data['children']?? '';

//         $originalclientdetails->previous_visa_number = $data['previous_visa_number'] ?? '';
//         $originalclientdetails->previous_visa_place = $data['previous_visa_place'] ?? '';
//         $originalclientdetails->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? '';
//         $originalclientdetails->cities_visited = $data['cities_visited'] ?? '';

        
//         $originalclientdetails->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? '';
//         $originalclientdetails->present_occupation = $data['present_occupation'] ?? '';
//         $originalclientdetails->designation = $data['designation'] ?? '';
//         $originalclientdetails->employer_name = $data['employer_name'] ?? '';
//         $originalclientdetails->employer_address = $data['employer_address'] ?? '';
//         $originalclientdetails->employer_phone = $data['employer_phone'] ?? '';
//         $originalclientdetails->past_occupation = $data['past_occupation'] ?? '';
//         $originalclientdetails->reference_name = $data['reference_name'] ?? '';
//         $originalclientdetails->reference_address = $data['reference_address'] ?? '';
//         $originalclientdetails->save();


//         // Send welcome email (outside transaction to avoid rollback on email failure)
//         try {
//             Mail::to($client->email)->queue(new ClientWelcomeEmail($client, $agency));
//         } catch (\Exception $e) {
//             \Log::error('Failed to send welcome email: ' . $e->getMessage());
//             // Do not throw — email failure should not rollback DB
//         }

//         return $client;
//     });
// }
// public function getStoreclint(array $data)
// {
//     return DB::transaction(function () use ($data) {

//         $agencyid = $data['agency_id'] ?? $this->agencyService->getAgencyData()->id;
//         $agency = $this->agencyService->getAgencyData();

//         // Generate Unique Client ID
//         do {
//             $clientID = strtoupper(Str::random(4));
//         } while (ClientDetails::where('clientuid', $clientID)->exists());

//         // Save client in both databases
//         $client = $this->saveClientData($data, $clientID, $agencyid, 'user_database');
//         $this->saveMoreClientInfo($client->id, $data, 'user_database');

//         // Save to default connection
//         $this->saveClientData($data, $clientID, $agencyid);
//         $this->saveMoreClientInfo($client->id, $data);

//         // Send welcome email
//         try {
//             Mail::to($client->email)->queue(new ClientWelcomeEmail($client, $agency));
//         } catch (\Exception $e) {
//             \Log::error('Failed to send welcome email: ' . $e->getMessage());
//         }

//         return $client;
//     });
// }
public function getStoreclint(array $data)
{

  
    $dataset = $this->agencyService->getAgencyData();
    if(!$dataset){
       $databasename=Agency::where('id',$data['agency_id'])->first();
       $dataset = $this->agencyService->setConnectionByDatabase($databasename->database_name);
 }  
    $userDb = DB::connection('user_database');
    $defaultDb = DB::connection();

    $userDb->beginTransaction();
    $defaultDb->beginTransaction();

    try {
        $agencyid = $data['agency_id'] ?? $this->agencyService->getAgencyData()->id;
        $agency = $this->agencyService->getAgencyData();

        // Generate Unique Client ID
        do {
            $clientID = strtoupper(Str::random(4));
        } while (ClientDetails::where('clientuid', $clientID)->exists());

        // Save client in user_database connection
        $client = $this->saveClientData($data, $clientID, $agencyid, 'user_database');
        $this->saveMoreClientInfo($client->id, $data, 'user_database');

        // Save client in default connection
        $this->saveClientData($data, $clientID, $agencyid);
        $this->saveMoreClientInfo($client->id, $data);

        // Commit both transactions
        $userDb->commit();
        $defaultDb->commit();

        // Send welcome email
        try {
           
            // Mail::to($data['email'])->queue(new ClientWelcomeEmail($client, $agency));
            Mail::to($data['email'])->send(new ClientWelcomeEmail($client, $agency));

        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        return $client;

    } catch (\Exception $e) {
        // Rollback both on error
        $userDb->rollBack();
        $defaultDb->rollBack();
        throw $e;
    }
}


private function saveClientData(array $data, string $clientID, int $agencyid, string $connection = null)
{
    $client = new ClientDetails();

    if ($connection) {
        $client->setConnection($connection);
    }

    $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
    $client->clientuid = $clientID;
    $client->agency_id = $agencyid;
    $client->first_name = $data['first_name'] ?? '';
    $client->last_name = $data['last_name'] ?? '';
    $client->gender = $data['gender'] ?? '';
    $client->marital_status = $data['marital_status'] ?? '';
    $client->date_of_birth = $data['date_of_birth'] ?? '';
    $client->phone_number = $data['phone_number'] ?? '';
    $client->email = $data['email'] ?? '';
    $client->zip_code = $data['zip_code'] ?? '';
    $client->address = $data['address'] ?? '';
    $client->street = $data['street'] ?? '';
    $client->city = $data['city'] ?? '';
    $client->country = $data['country'] ?? '';
    $client->permanent_address = $data['permanent_address'] ?? '';
    $client->save();

    return $client;
}

private function saveMoreClientInfo(int $clientId, array $data, string $connection = null)
{
    $info = new ClientMoreInfo();

    if ($connection) {
        $info->setConnection($connection);
    }

    $info->clientid = $clientId;
    $info->previous_name = $data['previous_name'] ?? '';
    $info->passport_issue_date = $data['passport_issue_date'] ?? '';
    $info->religion = $data['religion'] ?? '';
    $info->place_of_birth = $data['place_of_birth'] ?? '';
    $info->country_of_birth = $data['country_of_birth'] ?? '';
    $info->citizenship_id = $data['citizenship_id'] ?? '';
    $info->identification_marks = $data['identification_marks'] ?? '';
    $info->educational_qualification = $data['educational_qualification'] ?? '';
    $info->nationality = $data['nationality'] ?? '';
    $info->past_nationality = $data['past_nationality'] ?? '';
    $info->passport_country = $data['passport_country'] ?? '';
    $info->passport_issue_place = $data['passport_issue_place'] ?? '';
    $info->passport_ic_number = $data['passport_ic_number'] ?? '';
    $info->passport_expiry_date = $data['passport_expiry_date'] ?? '';
    $info->father_details = $data['father_name'] ?? '';
    $info->mother_details = $data['mother_name'] ?? '';
    $info->spouse_details = $data['spouse_name'] ?? '';
    $info->children = $data['children'] ?? '';
    $info->previous_visa_number = $data['previous_visa_number'] ?? '';
    $info->previous_visa_place = $data['previous_visa_place'] ?? '';
    $info->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? null;
    $info->cities_visited = $data['cities_visited'] ?? '';
    $info->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? null;
    $info->present_occupation = $data['present_occupation'] ?? '';
    $info->designation = $data['designation'] ?? '';
    $info->employer_name = $data['employer_name'] ?? '';
    $info->employer_address = $data['employer_address'] ?? '';
    $info->employer_phone = $data['employer_phone'] ?? '';
    $info->past_occupation = $data['past_occupation'] ?? '';
    $info->reference_name = $data['reference_name'] ?? '';
    $info->reference_address = $data['reference_address'] ?? '';
    $info->save();
}


 

    /****View Clint detials**** */

    public function getClientById($id,$database=null){
       
        // dd($database);
        $agency = $this->agencyService->setDatabaseConnection();
        
        if(!$agency){
        $agency = $this->agencyService->setConnectionByDatabase($database);
        
          
        }
        // dd($id);
        // $data=ClientDetails::on('user_database')->with('clientinfo','clientchats')->where('id',$id)->first();
        $data = ClientDetails::on('user_database')
        ->with('clientinfo') // Only load clientinfo from user_database
        ->where('id', $id)
        ->first();
    //    dd($)?
        
    // Now manually load clientchats from default database
    if ($data) {
        $data->setRelation('clientchats',Message::where('client_id', $data->id)->get());
    }   
        // $data=ClientDetails::on('user_database')->with('clientinfo','clientchats')->where('id',$id)->first();
        return $data;
        // dd($data); 
    }

    public function updateStoreclint($id, $data){
      
        $user = $this->agencyService->getCurrentLoginUser();  
    
        $client = ClientDetails::where('id',$id)->first();
        $client->setConnection('user_database');

        $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
        $client->agency_id = $data['agency_id'] ?? '' ;
        $client->first_name = $data['first_name'] ?? '';
        $client->last_name = $data['last_name'] ?? '';
        $client->gender = $data['gender'] ?? '';
        $client->marital_status = $data['marital_status'] ?? '';
        $client->date_of_birth = $data['date_of_birth'] ?? '';
        $client->phone_number  = $data['phone_number'] ?? '';
        $client->email = $data['email'] ?? '';
        $client->zip_code = $data['zip_code'] ?? '';
        $client->address = $data['address'] ?? '';
        $client->street = $data['street'] ?? '';
        $client->city = $data['city'] ?? '';
        $client->country = $data['country'] ?? '';
        $client->permanent_address = $data['permanent_address'] ?? '';
        $client->save();


        $clientdetails = ClientMoreInfo::where('clientid',$id)->first();
        $clientdetails->setConnection('user_database');

        $clientdetails->previous_name = $data['previous_name'] ?? '';
        $clientdetails->passport_issue_date = $data['passport_issue_date']?? '';
        $clientdetails->religion = $data['religion'] ?? '';
        $clientdetails->place_of_birth = $data['place_of_birth'] ?? '';
        $clientdetails->country_of_birth = $data['country_of_birth'] ?? '';
        $clientdetails->citizenship_id = $data['citizenship_id'] ?? '';
        $clientdetails->identification_marks = $data['identification_marks'] ?? '';

        
        $clientdetails->educational_qualification = $data['educational_qualification'] ?? '';
        $clientdetails->nationality = $data['nationality'] ?? '';
        $clientdetails->past_nationality = $data['past_nationality'] ?? '';

        $clientdetails->passport_country = $data['passport_country'] ?? '';
        $clientdetails->passport_issue_place = $data['passport_issue_place'] ?? '';
        $clientdetails->passport_ic_number = $data['passport_ic_number'] ?? '';
        $clientdetails->passport_issue_date = $data['passport_issue_date'] ?? '';
        $clientdetails->passport_expiry_date = $data['passport_expiry_date'] ?? '';

        

        $clientdetails->father_details = $data['father_name'] ?? '';
        $clientdetails->mother_details = $data['mother_name'] ?? '';
        $clientdetails->spouse_details = $data['spouse_name'] ?? '';
        $clientdetails->children = $data['children']?? '';

        $clientdetails->previous_visa_number = $data['previous_visa_number'] ?? '';
        $clientdetails->previous_visa_place = $data['previous_visa_place'] ?? '';
        $clientdetails->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? '';
        $clientdetails->cities_visited = $data['cities_visited'] ?? '';

        
        $clientdetails->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? '';
        $clientdetails->present_occupation = $data['present_occupation'] ?? '';
        $clientdetails->designation = $data['designation'] ?? '';
        $clientdetails->employer_name = $data['employer_name'] ?? '';
        $clientdetails->employer_address = $data['employer_address'] ?? '';
        $clientdetails->employer_phone = $data['employer_phone'] ?? '';
        $clientdetails->past_occupation = $data['past_occupation'] ?? '';
        $clientdetails->reference_name = $data['reference_name'] ?? '';
        $clientdetails->reference_address = $data['reference_address'] ?? '';
        $clientdetails->save();
        return $client;
    }


  

}