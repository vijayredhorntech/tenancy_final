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
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Traits\ClientTrait;





class ClintRepository implements ClintRepositoryInterface
{
    
    use ClientTrait;

    protected $fileUploadService,$agencyService,$visaRepository;

    

    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService,VisaRepositoryInterface $visaRepository)
    {
        $this->visaRepository = $visaRepository;

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

        // Save in user database
        $client = new ClientDetails();
        $this->saveClientData($data, $client, $clientID, $agencyid, 'user_database');

        $moreInfo = new ClientMoreInfo();
        $this->saveMoreClientInfo($client->id, $moreInfo, $data, 'user_database');

        // Save in default database
        $clientDefault = new ClientDetails();
        $this->saveClientData($data, $clientDefault, $clientID, $agencyid, 'mysql');

        $moreInfoDefault = new ClientMoreInfo();
        $this->saveMoreClientInfo($clientDefault->id, $moreInfoDefault, $data, 'mysql');


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

private function saveClientData(array $data, ClientDetails $client, string $clientID, int $agencyid, string $connection = null)
{
    if ($connection) {
        $client->setConnection($connection);
    }

    $client->client_name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
    $client->clientuid = $clientID;
    $client->agency_id = $agencyid;
    $client->first_name = $data['first_name'] ?? '';
    $client->last_name = $data['last_name'] ?? '';
    $client->gender = $data['gender'] ?? null;
    $client->marital_status = $data['marital_status'] ?? null;
    $client->date_of_birth = $data['date_of_birth'] ?? null;
    $client->phone_number = $data['phone_number'] ?? null;
    $client->email = $data['email'] ?? '';
    $client->zip_code = $data['zip_code'] ?? null;
    $client->address = $data['address'] ?? null;
    $client->street = $data['street'] ?? null;
    $client->city = $data['city'] ?? null;
    $client->country = $data['country'] ?? null;
    $client->permanent_address = $data['permanent_address'] ?? null;

    $client->save();

    return $client;
}

private function saveMoreClientInfo(int $clientId, ClientMoreInfo $info, array $data, string $connection = null)
{
    if ($connection) {
        $info->setConnection($connection);
    }

    $info->clientid = $clientId;
    $info->previous_name = $data['previous_name'] ?? null;
    $info->passport_issue_date = $data['passport_issue_date'] ?? null;
    $info->religion = $data['religion'] ?? null;
    $info->place_of_birth = $data['place_of_birth'] ?? null;
    $info->country_of_birth = $data['country_of_birth'] ?? null;
    $info->citizenship_id = $data['citizenship_id'] ?? null;
    $info->identification_marks = $data['identification_marks'] ?? null;
    $info->educational_qualification = $data['educational_qualification'] ?? null;
    $info->nationality = $data['nationality'] ?? null;
    $info->past_nationality = $data['past_nationality'] ?? null;
    $info->passport_country = $data['passport_country'] ?? null;
    $info->passport_issue_place = $data['passport_issue_place'] ?? null;
    $info->passport_ic_number = $data['passport_ic_number'] ?? null;
    $info->passport_expiry_date = $data['passport_expiry_date'] ?? null;
    $info->father_details = $data['father_name'] ?? null;
    $info->mother_details = $data['mother_name'] ?? null;
    $info->spouse_details = $data['spouse_name'] ?? null;
    $info->children = $data['children'] ?? null;

    $info->present_occupation = $data['present_occupation'] ?? null;
    $info->designation = $data['designation'] ?? null;
    $info->employer_name = $data['employer_name'] ?? null;
    $info->employer_address = $data['employer_address'] ?? null;
    $info->employer_phone = $data['employer_phone'] ?? null;
    $info->past_occupation = $data['past_occupation'] ?? null;
    $info->reference_name = $data['reference_name'] ?? null;
    $info->reference_address = $data['reference_address'] ?? null;

    $info->save();
}




// private function saveClientData(array $data, $client, string $clientID, int $agencyid, string $connection = null)
// {
//     // $client = new ClientDetails();

//     if ($connection) {
//         $client->setConnection($connection);
//     }

//     $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
//     $client->clientuid = $clientID;
//     $client->agency_id = $agencyid;
//     $client->first_name = $data['first_name'] ?? '';
//     $client->last_name = $data['last_name'] ?? '';
//     $client->gender = $data['gender'] ?? null;
//     $client->marital_status = $data['marital_status'] ?? null;
//     $client->date_of_birth = $data['date_of_birth'] ?? null;
//     $client->phone_number = $data['phone_number'] ?? null;
//     $client->email = $data['email'] ?? '';
//     $client->zip_code = $data['zip_code'] ?? null;
//     $client->address = $data['address'] ?? null;
//     $client->street = $data['street'] ?? null;
//     $client->city = $data['city'] ?? null;
//     $client->country = $data['country'] ?? null;
//     $client->permanent_address = $data['permanent_address'] ?? null;
//     $client->save();

//     return $client;
// }

// private function saveMoreClientInfo(int $clientId,$info, array $data, string $connection = null)
// {
//     // $info = new ClientMoreInfo();

//     if ($connection) {
//         $info->setConnection($connection);
//     }

//     $info->clientid = $clientId;
//     $info->previous_name = $data['previous_name'] ?? null;
//     $info->passport_issue_date = $data['passport_issue_date'] ?? null;
//     $info->religion = $data['religion'] ?? null;
//     $info->place_of_birth = $data['place_of_birth'] ?? null;
//     $info->country_of_birth = $data['country_of_birth'] ?? null;
//     $info->citizenship_id = $data['citizenship_id'] ?? null;
//     $info->identification_marks = $data['identification_marks'] ?? null;
//     $info->educational_qualification = $data['educational_qualification'] ?? null;
//     $info->nationality = $data['nationality'] ?? null;
//     $info->past_nationality = $data['past_nationality'] ?? null;
//     $info->passport_country = $data['passport_country'] ?? null;
//     $info->passport_issue_place = $data['passport_issue_place'] ?? null;
//     $info->passport_ic_number = $data['passport_ic_number'] ?? null;
//     $info->passport_expiry_date = $data['passport_expiry_date'] ?? null;
//     $info->father_details = $data['father_name'] ?? null;
//     $info->mother_details = $data['mother_name'] ?? null;
//     $info->spouse_details = $data['spouse_name'] ?? null;
//     $info->children = $data['children'] ?? null;
//     $info->previous_visa_number = $data['previous_visa_number'] ?? '';
//     $info->previous_visa_place = $data['previous_visa_place'] ?? '';
//     $info->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? null;
//     $info->cities_visited = $data['cities_visited'] ?? '';
//     $info->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? null;
//     $info->present_occupation = $data['present_occupation'] ?? '';
//     $info->designation = $data['designation'] ?? '';
//     $info->employer_name = $data['employer_name'] ?? '';
//     $info->employer_address = $data['employer_address'] ?? '';
//     $info->employer_phone = $data['employer_phone'] ?? '';
//     $info->past_occupation = $data['past_occupation'] ?? '';
//     $info->reference_name = $data['reference_name'] ?? '';
//     $info->reference_address = $data['reference_address'] ?? '';
//     $info->save();
// }


 

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


    public function step1createclient($data)
{
    
    // Assuming this gets visa booking data from default DB
    $visabooking = $this->visaRepository->bookingDataById($data['bookingid']);
    $agency = $this->agencyService->getAgencyData();
    $user = $this->agencyService->getCurrentLoginUser();
    $userDbConnection = 'user_database'; // Your second DB connection name
    $client = ClientDetails::on($userDbConnection)->where('id', $visabooking->client_id)->first();
    $this->updateClientData($data, $client,  'user_database');
    $moreInfo = ClientMoreInfo::on($userDbConnection)->where('clientid', $visabooking->client_id)->first();
    // $clientDefault = ClientDetails::where('id', $visabooking->client_id)->first();
    //  $moreInfoDefault = ClientMoreInfo::where('clientid', $clientDefault->id ?? 0)->first();
     $this->updateMoreClientInfo($moreInfo, $data, 'user_database');
    // $this->updateMoreClientInfo($visabooking->client_id, $moreInfoDefault, $data, 'mysql');   // You can return something or continue your flow here
}


private function updateClientData(array $data, ClientDetails $client, string $connection = null)
{
    if ($connection) {
        $client->setConnection($connection);
    }

    $client->client_name = trim(($data['first_name'] ?? $client->first_name) . ' ' . ($data['last_name'] ?? $client->last_name));
    $client->first_name = $data['first_name'] ?? $client->first_name;
    $client->last_name = $data['last_name'] ?? $client->last_name;
    $client->gender = $data['gender'] ?? $client->gender;
    $client->marital_status = $data['marital_status'] ?? $client->marital_status;
    $client->date_of_birth = $data['date_of_birth'] ?? $client->date_of_birth;
    $client->phone_number = $data['phone_number'] ?? $client->phone_number;
    $client->email = $data['email'] ?? $client->email;
    $client->zip_code = $data['zip_code'] ?? $client->zip_code;
    $client->address = $data['address'] ?? $client->address;
    $client->street = $data['street'] ?? $client->street;
    $client->city = $data['city'] ?? $client->city;
    $client->country = $data['country'] ?? $client->country;
    $client->permanent_address = $data['permanent_address'] ?? $client->permanent_address;

    $client->save();

    return $client;
}




// private function updateMoreClientInfo(ClientMoreInfo $info, array $data, string $connection = null)
// {
//     if ($connection) {
//         $info->setConnection($connection);
//     }

//     // Step 4: Spouse Details
//     if (($data['marital_status'] ?? null) === 'married') {
//         $info->spouse_details = json_encode([
//             'name' => $data['spouse_name'] ?? null,
//             'nationality' => $data['spouse_nationality'] ?? null,
//             'birth_place' => $data['spouse_birth_place'] ?? null,
//             'previous_nationality' => $data['spouse_previous_nationality'] ?? null,
//             'dob' => $data['spouse_dob'] ?? null,
//             'employementstatus' => $data['spouse_employment'] ?? null,
//             'address' => $data['spouse_address'] ?? null,
//         ]);
//     }

//     // Step 5: Children
//     if (($data['step'] ?? null) == 5) {
//         $children = [];
//         $childNames = $data['child_name'] ?? [];
//         $childDobs = $data['child_dob'] ?? [];
//         $childNationalities = $data['child_nationality'] ?? [];
//         $childAddresses = $data['child_address'] ?? [];

//         for ($i = 0; $i < count($childNames); $i++) {
//             $children[] = [
//                 'name' => $childNames[$i] ?? '',
//                 'dob' => $childDobs[$i] ?? '',
//                 'nationality' => $childNationalities[$i] ?? '',
//                 'address' => $childAddresses[$i] ?? '',
//             ];
//         }

//         $info->children = json_encode($children);
//     }

//     // Step 7: Father & Mother
//     if (($data['step'] ?? null) == 7) {
//         $info->father_details = json_encode([
//             'name' => $data['father_name'] ?? null,
//             'nationality' => $data['father_nationality'] ?? null,
//             'birth_place' => $data['father_birth_place'] ?? null,
//             'previous_nationality' => $data['father_previous_nationality'] ?? null,
//             'dob' => $data['father_dob'] ?? null,
//             'employementstatus' => $data['father_employment'] ?? null,
//             'address' => $data['father_address'] ?? null,
//         ]);

//         $info->mother_details = json_encode([
//             'name' => $data['mother_name'] ?? null,
//             'nationality' => $data['mother_nationality'] ?? null,
//             'birth_place' => $data['mother_birth_place'] ?? null,
//             'previous_nationality' => $data['mother_previous_nationality'] ?? null,
//             'dob' => $data['mother_dob'] ?? null,
//             'employementstatus' => $data['mother_employment'] ?? null,
//             'address' => $data['mother_address'] ?? null,
//         ]);
//     }

//     if (($data['step'] ?? null) == 8) {
//         if ($info->haspassportidenty === 'yes') {
//             $otherDetails = [
//                 'country' => $data['other_passport_country'] ?? '',
//                 'issue_place' => $data['other_passport_issue_place'] ?? '',
//                 'ic_number' => $data['other_passport_ic_number'] ?? '',
//                 'issue_date' => $data['other_passport_issue_date'] ?? '',
//             ];
    
//             $other_passport_details = json_encode($otherDetails);
//     }
//     }
//     // Common info
//     $info->previous_name = $data['previous_name'] ?? $info->previous_name;
//     $info->passport_issue_date = $data['passport_issue_date'] ?? $info->passport_issue_date;
//     $info->religion = $data['religion'] ?? $info->religion;
//     $info->place_of_birth = $data['place_of_birth'] ?? $info->place_of_birth;
//     $info->country_of_birth = $data['country_of_birth'] ?? $info->country_of_birth;
//     $info->citizenship_id = $data['citizenship_id'] ?? $info->citizenship_id;
//     $info->identification_marks = $data['identification_marks'] ?? $info->identification_marks;
//     $info->educational_qualification = $data['educational_qualification'] ?? $info->educational_qualification;
//     $info->nationality = $data['nationality'] ?? $info->nationality;
//     $info->past_nationality = $data['past_nationality'] ?? $info->past_nationality;
//     $info->passport_country = $data['passport_country'] ?? $info->passport_country;
//     $info->passport_issue_place = $data['passport_issue_place'] ?? $info->passport_issue_place;
//     $info->passport_ic_number = $data['passport_ic_number'] ?? $info->passport_ic_number;
//     $info->passport_expiry_date = $data['passport_expiry_date'] ?? $info->passport_expiry_date;
//     $info->previous_visa_number = $data['previous_visa_number'] ?? $info->previous_visa_number;
//     $info->previous_visa_place = $data['previous_visa_place'] ?? $info->previous_visa_place;
//     $info->previous_visa_issue_date = $data['previous_visa_issue_date'] ?? $info->previous_visa_issue_date;
//     $info->cities_visited = $data['cities_visited'] ?? $info->cities_visited;
//     $info->countries_visited_last_10_years = $data['countries_visited_last_10_years'] ?? $info->countries_visited_last_10_years;
//     $info->present_occupation = $data['present_occupation'] ?? $info->present_occupation;
//     $info->designation = $data['designation'] ?? $info->designation;
//     $info->employer_name = $data['employer_name'] ?? $info->employer_name;
//     $info->employer_address = $data['employer_address'] ?? $info->employer_address;
//     $info->employer_phone = $data['employer_phone'] ?? $info->employer_phone;
//     $info->past_occupation = $data['past_occupation'] ?? $info->past_occupation;
//     $info->reference_name = $data['reference_name'] ?? $info->reference_name;
//     $info->reference_address = $data['reference_address'] ?? $info->reference_address;

//     $info->haspassportidenty = $data['haspassportidenty'] ?? $info->haspassportidenty;
//     $info->other_passport_details = $other_passport_details ?? $info->other_passport_details;


//     $info->save();

//     return $info;
// }

private function updateMoreClientInfo(ClientMoreInfo $info, array $data, string $connection = null)
{
    if ($connection) {
        $info->setConnection($connection);
    }

    

    // Step 5: Children


    // Step 7: Father & Mother
    if (($data['step'] ?? null) == 7) {
      
        $info->father_details = json_encode([
            'name' => $data['father_name'] ?? null,
            'nationality' => $data['father_nationality'] ?? null,
            'birth_place' => $data['father_birth_place'] ?? null,
            'previous_nationality' => $data['father_previous_nationality'] ?? null,
            'country_of_birth' => $data['father_country_of_birth'] ?? null,
            'dob' => $data['father_dob'] ?? null,
            'employment' => $data['father_employment'] ?? null,
            'address' => $data['father_address'] ?? null,
        ]);
    
        $info->mother_details = json_encode([
            'name' => $data['mother_name'] ?? null,
            'nationality' => $data['mother_nationality'] ?? null,
            'birth_place' => $data['mother_birth_place'] ?? null,
            'previous_nationality' => $data['mother_previous_nationality'] ?? null,
            'country_of_birth' => $data['mother_country_of_birth'] ?? null,
            'dob' => $data['mother_dob'] ?? null,
            'employment' => $data['mother_employment'] ?? null,
            'address' => $data['mother_address'] ?? null,
        ]);
    
        $info->spouse_details = json_encode([
            'name' => $data['spouse_name'] ?? null,
            'birth_place' => $data['spouse_birth_place'] ?? null,
            'nationality' => $data['spouse_nationality'] ?? null,
            'previous_nationality' => $data['spouse_previous_nationality'] ?? null,
            'dob' => $data['spouse_dob'] ?? null,
            'employment' => $data['spouse_employment'] ?? null,
            'address' => $data['spouse_address'] ?? null,
        ]);
    
        if (($data['has_child'] ?? null) === 'yes') {
            $children = [];
            $childNames = $data['child_name'] ?? [];
            $childDobs = $data['child_dob'] ?? [];
            $childNationalities = $data['child_nationality'] ?? [];
            $childAddresses = $data['child_address'] ?? [];
    
            for ($i = 0; $i < count($childNames); $i++) {
                $children[] = [
                    'name' => $childNames[$i] ?? '',
                    'dob' => $childDobs[$i] ?? '',
                    'nationality' => $childNationalities[$i] ?? '',
                    'address' => $childAddresses[$i] ?? '',
                ];
            }
    
            $info->children = json_encode($children);
        }
}


    // Step 8: Other Passport Info
    if (($data['step'] ?? null) == 8) {
        $info->haspassportidenty = $data['haspassportidenty'] ?? 'no';

        if ($info->haspassportidenty === 'yes') {
            $otherDetails = [
                'country' => $data['other_passport_country'] ?? '',
                'issue_place' => $data['other_passport_issue_place'] ?? '',
                'ic_number' => $data['other_passport_ic_number'] ?? '',
                'issue_date' => $data['other_passport_issue_date'] ?? '',
            ];
            $info->other_passport_details = json_encode($otherDetails);
        } else {
            $info->other_passport_details = null;
        }
    }

    if(($data['step']?? null)=="socialmedia"){
        $socialMedia = [
            'facebook' => $data['facebook'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'twitter' => $data['twitter'] ?? null,
            'linkedIn' => $data['linkedIn'] ?? null,
            'other_social_media_accounts' => $data['othersocialmediaaccounts'] ?? null,
            'personal_website' => $data['personalwebsite'] ?? null,
            'blog_url' => $data['blogurl'] ?? null,
        ];

        $info->social_media = json_encode($socialMedia);
    }

    if(($data['step'] ?? null)=="employment"){
        $employmentEducationData = [
            'business_name' => $data['business_name'] ?? null,
            'school_name' => $data['school_name'] ?? null,
            'duration_of_employment' => $data['duration_of_employment'] ?? null,
            'duration_of_study' => $data['duration_of_study'] ?? null,
            'employment_monthly_income' => $data['employment_monthly_income'] ?? null,
            'employment_history' => $data['employment_history'] ?? null,
            'education_history' => $data['education_history'] ?? null,
        ];
        $info->employment = json_encode($employmentEducationData);

    }


    // Common info (applies to all steps)
    $info->previous_name = $data['previous_name'] ?? $info->previous_name;
    $info->passport_issue_date = $data['passport_issue_date'] ?? $info->passport_issue_date;
    $info->religion = $data['religion'] ?? $info->religion;
    $info->place_of_birth = $data['place_of_birth'] ?? $info->place_of_birth;
    $info->country_of_birth = $data['country_of_birth'] ?? $info->country_of_birth;
    $info->citizenship_id = $data['citizenship_id'] ?? $info->citizenship_id;
    $info->identification_marks = $data['identification_marks'] ?? $info->identification_marks;
    $info->educational_qualification = $data['educational_qualification'] ?? $info->educational_qualification;
    $info->nationality = $data['nationality'] ?? $info->nationality;
    $info->past_nationality = $data['past_nationality'] ?? $info->past_nationality;
    $info->passport_country = $data['passport_country'] ?? $info->passport_country;
    $info->passport_issue_place = $data['passport_issue_place'] ?? $info->passport_issue_place;
    $info->passport_ic_number = $data['passport_ic_number'] ?? $info->passport_ic_number;
    $info->passport_expiry_date = $data['passport_expiry_date'] ?? $info->passport_expiry_date;
    $info->present_occupation = $data['present_occupation'] ?? $info->present_occupation;
    $info->designation = $data['designation'] ?? $info->designation;
    $info->employer_name = $data['employer_name'] ?? $info->employer_name;
    $info->employer_address = $data['employer_address'] ?? $info->employer_address;
    $info->employer_phone = $data['employer_phone'] ?? $info->employer_phone;
    $info->past_occupation = $data['past_occupation'] ?? $info->past_occupation;
    $info->reference_name = $data['reference_name'] ?? $info->reference_name;
    $info->reference_address = $data['reference_address'] ?? $info->reference_address;
    $info->title = $data['title'] ?? $info->title;
    $info->language_spoken = $data['languages_spoken'] ?? $info->language_spoken;

    // family
    $info->father_details = $info->father_details ?? $info->father_details;
    $info->mother_details = $info->mother_details ?? $info->mother_details;
    $info->spouse_details = $info->spouse_details ?? $info->spouse_details;
    $info->children = $info->children ?? $info->children;



    $info->employment=  $info->employment ?? $info->employment;
    $info->social_media =$info->social_media ?? $info->social_media;


    $info->haspassportidenty = $info->haspassportidenty ??  $info->haspassportidenty;
    $info->other_passport_details = $info->other_passport_details ?? $info->other_passport_details;

    $info->save();

    return $info;
}



  


}