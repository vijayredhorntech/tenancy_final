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
    
        $query = ClientDetails::with('clientInfo')
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
    


    // public function getStoreclint(array $data)
    // {
    // //    dd($data);
    //    if($data['agency_id']){
    //     $agencyid=$data['agency_id'];
    //    }else{
        
    //     $agency = $this->agencyService->getAgencyData();
    //     $agencyid=$agency->id;
    //    }
      
    //    $agency = $this->agencyService->getAgencyData();
        
    
    //     // Generate Unique Client ID
    //     $randomStr = strtoupper(Str::random(4)); // Generate 4-character random string
    //     $clientID = $randomStr;
    
    //     // Check if the generated client ID already exists (regenerate if necessary)
    //     while (ClientDetails::where('clientuid', $clientID)->exists()) {
    //         $randomStr = strtoupper(Str::random(4));
    //         $clientID =  $randomStr;
    //     }
 
    //     // Create New Client
    //     $client = new ClientDetails();
    //     $client->client_name = $data['first_name']?? '' . ' ' . $data['last_name']?? '';
    //     $client->clientuid = $clientID;
    //     $client->agency_id = $agencyid;
    //     $client->first_name = $data['first_name']?? '';
    //     $client->last_name = $data['last_name']?? '';
    //     $client->gender = $data['gender']?? '';
    //     $client->marital_status = $data['marital_status']?? '';
    //     $client->date_of_birth = $data['date_of_birth']?? '';
    //     $client->phone_number  = $data['phone_number']?? '';
    //     $client->email = $data['email']?? '';
    //     $client->zip_code = $data['zip_code']?? '';
    //     $client->address = $data['address']?? '';
    //     $client->street = $data['street']?? '';
    //     $client->city = $data['city']?? '';
    //     $client->country = $data['country']?? '';
    //     $client->permanent_address = $data['permanent_address']?? '';
    //     $client->save();

    //     $clientdetails=new ClientMoreInfo(); 
    //     $clientdetails->clientid=$client->id;
    //     $clientdetails->previous_name=$data['previous_name'] ?? '';
    //     $clientdetails->religion=$data['religion'] ?? '';
    //     $clientdetails->place_of_birth=$data['place_of_birth'] ?? '';
    //     $clientdetails->country_of_birth=$data['country_of_birth'] ?? '';
    //     $clientdetails->citizenship_id=$data['citizenship_id'] ?? '';
    //     $clientdetails->educational_qualification=$data['educational_qualification'] ?? '';
    //     $clientdetails->past_nationality=$data['past_nationality'] ?? '';
    //     $clientdetails->passport_country=$data['passport_country'] ?? '';
    //     $clientdetails->passport_issue_place=$data['passport_issue_place'] ?? '';
    //     $clientdetails->passport_ic_number=$data['passport_ic_number'] ?? '';
    //     $clientdetails->passport_issue_date=$data['passport_issue_date'] ?? '';
    //     $clientdetails->father_details=$data['father_name'] ?? '';
    //     $clientdetails->mother_details=$data['mother_name'] ?? '';
    //     $clientdetails->spouse_details=$data['spouse_name'] ?? '';
    //     $clientdetails->previous_visa_number=$data['previous_visa_number'] ?? '';
    //     $clientdetails->previous_visa_place=$data['previous_visa_place'] ?? '';
    //     $clientdetails->previous_visa_issue_date=$data['previous_visa_issue_date'] ?? '';
    //     $clientdetails->countries_visited_last_10_years=$data['countries_visited_last_10_years'] ?? '';
    //     $clientdetails->present_occupation=$data['present_occupation'] ?? '';
    //     $clientdetails->designation=$data['designation'] ?? '';
    //     $clientdetails->employer_name=$data['employer_name'] ?? '';
    //     $clientdetails->employer_address=$data['employer_address'] ?? '';
    //     $clientdetails->employer_phone=$data['employer_phone'] ?? '';
    //     $clientdetails->past_occupation=$data['past_occupation'] ?? '';
    //     $clientdetails->reference_name=$data['reference_name'] ?? '';
    //     $clientdetails->reference_address=$data['reference_address'] ?? '';
    //     $clientdetails->save();





    //     // $clientdetails->children_count = isset($data['children_count']) && is_numeric($data['children_count']) ? (int)$data['children_count'] : null;
    //     // $clientdetails->save(); 
        
    //     // Send welcome email to client
    //         try {
    //             Mail::to($client->email)->queue(new ClientWelcomeEmail($client, $agency));
    //         } catch (\Exception $e) {
    //             dd($e); 
    //             // Log the error if email fails, but don't stop the process
    //             \Log::error('Failed to send welcome email: ' . $e->getMessage());
    //         }

    //     return $client;
    // }
    
    public function getStoreclint(array $data)
{
    return DB::transaction(function () use ($data) {

        if (!empty($data['agency_id'])) {
            $agencyid = $data['agency_id'];
        } else {
            $agency = $this->agencyService->getAgencyData();
            $agencyid = $agency->id;
        }

        $agency = $this->agencyService->getAgencyData();

        // Generate Unique Client ID
        do {
            $clientID = strtoupper(Str::random(4));
        } while (ClientDetails::where('clientuid', $clientID)->exists());

        // Create New Client
        $client = new ClientDetails();
        $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
        $client->clientuid = $clientID;
        $client->agency_id = $agencyid;
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

        // Create More Info
        $clientdetails = new ClientMoreInfo();
        $clientdetails->clientid = $client->id;
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

        // Send welcome email (outside transaction to avoid rollback on email failure)
        try {
            Mail::to($client->email)->queue(new ClientWelcomeEmail($client, $agency));
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
            // Do not throw — email failure should not rollback DB
        }

        return $client;
    });
}


    /****View Clint detials**** */

    public function getClientById($id){

        
        $data=ClientDetails::with('clientinfo')->where('id',$id)->first();
        return $data;
        // dd($data); 
    }

    public function updateStoreclint($id, $data){
      
        $client = ClientDetails::where('id',$id)->first();
        $client->client_name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
        $client->clientuid = $clientID;
        $client->agency_id = $agencyid;
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
