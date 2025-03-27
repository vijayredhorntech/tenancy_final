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




class ClintRepository implements ClintRepositoryInterface
{
    

    protected $fileUploadService,$agencyService;

    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->agencyService = $agencyService;
    }



    public function getAllClint(){
 
   
        /**Get Agency record *****/
        $agency = $this->agencyService->getAgencyData();
        return ClientDetails::where('agency_id',$agency->id)->paginate(10);
    }


    public function getStoreclint(array $data)
    {
   
   
        $agency = $this->agencyService->getAgencyData();
    
      
    
        // Generate Unique Client ID
        $randomStr = strtoupper(Str::random(4)); // Generate 4-character random string
        $clientID = $data['phone'] . "_" . ucfirst(explode(' ', $data['name'])[0]) . "_" . $randomStr;
    
        // Check if the generated client ID already exists (regenerate if necessary)
        while (ClientDetails::where('clientid', $clientID)->exists()) {
            $randomStr = strtoupper(Str::random(4));
            $clientID = $data['phone'] . "_" . ucfirst(explode(' ', $data['name'])[0]) . "_" . $randomStr;
        }
    
        // Create New Client
        $client = new ClientDetails();
        $client->name = $data['name'] ; // Fixed concatenation
        $client->email = $data['email'];
        $client->clientid = $clientID; // Store unique client ID
        $client->phone_number = $data['phone'];
        $client->address = $data['nationality'];
        $client->agency_id = $agency->id;
        $client->passport_number = $data['passport_number'];
        $client->save();

        $clientdetails=new ClientMoreInfo(); 
        $clientdetails->clientid=$client->id;
        $clientdetails->last_name=$data['last'] ?? '';
        $clientdetails->dob=$data['dob'] ?? '';
        $clientdetails->gender=$data['gender'] ?? '';
        $clientdetails->marital_status=$data['marital_status'] ?? '';
        $clientdetails->nationality=$data['nationality'] ?? '';
        $clientdetails->passport_issue_date=$data['passport_issue_date'] ?? '';
        $clientdetails->passport_expiry_date=$data['passport_expiry_date'] ?? '';
        $clientdetails->residential_address=$data['residential_address'] ?? '';
        $clientdetails->father_name=$data['father_name'] ?? '';
        $clientdetails->mother_name=$data['mother_name'] ?? '';
        $clientdetails->spouse_name=$data['spouse_name'] ?? '';
        $clientdetails->children_count = isset($data['children_count']) && is_numeric($data['children_count']) ? (int)$data['children_count'] : null;
        $clientdetails->save(); 


        return $client;
    }
    

    /****View Clint detials**** */

    public function getClientById($id){

        
        $data=ClientDetails::with('clientinfo')->where('id',$id)->first();
        return $data;
        // dd($data); 
    }

    public function updateStoreclint($id, $data){
      
        $client = ClientDetails::where('id',$id)->first();
        $client->name = $data['name'] ; // Fixed concatenation
        $client->email = $data['email'];
        $client->phone_number = $data['phone'];
        $client->address = $data['nationality'];
        $client->passport_number = $data['passport_number'];
        $client->save();

        $clientdetails = ClientMoreInfo::where('clientid',$id)->first();
        $clientdetails->last_name=$data['last'] ?? '';
        $clientdetails->dob=$data['dob'] ?? '';
        $clientdetails->gender=$data['gender'] ?? '';
        $clientdetails->marital_status=$data['marital_status'] ?? '';
        $clientdetails->nationality=$data['nationality'] ?? '';
        $clientdetails->passport_issue_date=$data['passport_issue_date'] ?? '';
        $clientdetails->passport_expiry_date=$data['passport_expiry_date'] ?? '';
        $clientdetails->residential_address=$data['residential_address'] ?? '';
        $clientdetails->father_name=$data['father_name'] ?? '';
        $clientdetails->mother_name=$data['mother_name'] ?? '';
        $clientdetails->spouse_name=$data['spouse_name'] ?? '';
        $clientdetails->children_count = isset($data['children_count']) && is_numeric($data['children_count']) ? (int)$data['children_count'] : null;
        $clientdetails->save(); 
        return $client;
    }


}
