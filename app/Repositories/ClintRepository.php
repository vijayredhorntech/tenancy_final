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
use App\Repositories\Interfaces\VisaRepositoryInterface;

use App\Services\FileUploadService;
use Auth; 
use Illuminate\Support\Str;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Models\ClientMoreInfo;
use App\Models\FamilyMember;
use App\Services\AgencyService;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeEmail; 
use App\Models\ClientApplicationDocument;
use App\Traits\ClientTrait;
use App\Models\DocSignDocument;
use App\Models\OtherClientInfo;
use App\Models\AuthervisaApplication;





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
    

public function getStoreclint(array $data)
{
    $dataset = $this->agencyService->getAgencyData();
    if (!$dataset) {
        $databasename = Agency::where('id', $data['agency_id'])->first();
        $dataset = $this->agencyService->setConnectionByDatabase($databasename->database_name);
    }

    $userDb = DB::connection('user_database');
    $defaultDb = DB::connection();

    $userDb->beginTransaction();
    $defaultDb->beginTransaction();

    try {
        $agencyid = $data['agency_id'] ?? $this->agencyService->getAgencyData()->id;
        $agency = $this->agencyService->getAgencyData();

        // Prepare prefixes for clientuid
        $agencyName = $agency->name ?? 'AGY';
        $agencyPrefix = strtoupper(substr(preg_replace('/\s+/', '', $agencyName), 0, 3));

        $clientName = ($data['first_name'] ?? '') . ($data['last_name'] ?? '');
        $clientPrefix = strtoupper(substr(preg_replace('/\s+/', '', $clientName), 0, 2));


        // Generate Unique Client ID
        do {
            $randomNumber = rand(1000, 9999);
            $clientID = "{$agencyPrefix}{$clientPrefix}{$randomNumber}";
        } while (ClientDetails::where('clientuid', $clientID)->exists());

        // Save in user database
        $client = new ClientDetails();
        $this->saveClientData($data, $client, $clientID, $agencyid, 'user_database');

        $moreInfo = new ClientMoreInfo();
        $this->saveMoreClientInfo($client->id, $moreInfo, $data, 'user_database');
        $this->processFamilyMembersData($data, $client->id, 'user_database');

        // Save in default database
        $clientDefault = new ClientDetails();
        $this->saveClientData($data, $clientDefault, $clientID, $agencyid, 'mysql');

        $moreInfoDefault = new ClientMoreInfo();
        $this->saveMoreClientInfo($clientDefault->id, $moreInfoDefault, $data, 'mysql');
        $this->processFamilyMembersData($data, $clientDefault->id, 'mysql');

        // Commit both transactions
        $userDb->commit();
        $defaultDb->commit();

        // Send welcome email
        // try {       
        //     Mail::to($data['email'])->send(new ClientWelcomeEmail($client, $agency));
        // } catch (\Exception $e) {   
        //     \Log::error('Failed to send welcome email: ' . $e->getMessage());
        // }           

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

    $client->passport_ic_number = $data['passport_ic_number'] ?? ($data['passport_no'] ?? null);
    $client->passport_issue_date = $data['passport_issue_date'] ?? ($data['date_of_issue'] ?? null);
    $client->passport_expiry_date = $data['passport_expiry_date'] ?? ($data['date_of_expire'] ?? null);
    $client->passport_issue_place = $data['passport_issue_place'] ?? ($data['place_of_issue'] ?? null);

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
    $info->relative_information = $data['relative_information'] ?? null;
    $info->mother_details = $data['mother_name'] ?? null;
    $info->spouse_details = $data['spouse_name'] ?? null;
    $info->children = $data['children'] ?? null;
    $info->arms_details = $data['arms_details'] ?? null;
    $info->reference_address = $data['reference_address'] ?? null;

    $info->present_occupation = $data['present_occupation'] ?? null;
    $info->designation = $data['designation'] ?? null;
    $info->employer_name = $data['employer_name'] ?? null;
    $info->employer_address = $data['employer_address'] ?? null;
    $info->employer_phone = $data['employer_phone'] ?? null;
    $info->past_occupation = $data['past_occupation'] ?? null;
    $info->reference_name = $data['reference_name'] ?? null;
    $info->reference_address = $data['reference_address'] ?? null;
    $info->duty = $data['duty'] ?? null;
    $info->date_from = $data['date_from'] ?? null;
    $info->date_to = $data['date_to'] ?? null;

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
            if ($data) {
                 
                $docusing = DocSignDocument::with('docsign','visaBookingApplication')->where('client_id', $id)
                ->where('agency_id', $data->agency_id)
                ->get();
                //   dd($docusing);
                $data->setRelation('docsign',$docusing);
            }   
            if ($data) {
                $invoices = Deduction::with('service_name')->where('client_id', $id)
                ->where('agency_id', $data->agency_id)
                ->get();
                $data->setRelation('invoice',$invoices);
            }   
            
            // Load family members from user_database
            if ($data) {
                $familyMembers = FamilyMember::on('user_database')
                    ->where('client_id', $id)
                    ->orderBy('created_at')
                    ->get();
                $data->setRelation('familyMembers', $familyMembers);
            }
            
                // $data=ClientDetails::on('user_database')->with('clientinfo','clientchats')->where('id',$id)->first();
                return $data;
                // dd($data); 
    }

    public function updateStoreclint($id, $data){
      
        $user = $this->agencyService->getCurrentLoginUser();  
    
        $client = ClientDetails::on('user_database')->where('id',$id)->first();
        
        if (!$client) {
            throw new \Exception("Client not found with ID: {$id}");
        }

        // Update only fields that are provided in the form
        $client->client_name = ($data['first_name'] ?? $client->first_name) . ' ' . ($data['last_name'] ?? $client->last_name);
        
        if (isset($data['agency_id'])) $client->agency_id = $data['agency_id'];
        if (isset($data['first_name'])) $client->first_name = $data['first_name'];
        if (isset($data['last_name'])) $client->last_name = $data['last_name'];
        if (isset($data['gender'])) $client->gender = $data['gender'];
        if (isset($data['marital_status'])) $client->marital_status = $data['marital_status'];
        if (isset($data['date_of_birth'])) $client->date_of_birth = $data['date_of_birth'];
        if (isset($data['phone_number'])) $client->phone_number = $data['phone_number'];
        if (isset($data['email'])) $client->email = $data['email'];
        if (isset($data['zip_code'])) $client->zip_code = $data['zip_code'];
        if (isset($data['address'])) $client->address = $data['address'];
        if (isset($data['street'])) $client->street = $data['street'];
        if (isset($data['city'])) $client->city = $data['city'];
        if (isset($data['country'])) $client->country = $data['country'];
        if (isset($data['permanent_address'])) $client->permanent_address = $data['permanent_address'];
        
        // Update passport fields if provided
        if (isset($data['passport_ic_number']) || isset($data['passport_no'])) {
            $client->passport_ic_number = $data['passport_ic_number'] ?? $data['passport_no'] ?? $client->passport_ic_number;
        }
        if (isset($data['passport_issue_date']) || isset($data['date_of_issue'])) {
            $client->passport_issue_date = $data['passport_issue_date'] ?? $data['date_of_issue'] ?? $client->passport_issue_date;
        }
        if (isset($data['passport_expiry_date']) || isset($data['date_of_expire'])) {
            $client->passport_expiry_date = $data['passport_expiry_date'] ?? $data['date_of_expire'] ?? $client->passport_expiry_date;
        }
        if (isset($data['passport_issue_place']) || isset($data['place_of_issue'])) {
            $client->passport_issue_place = $data['passport_issue_place'] ?? $data['place_of_issue'] ?? $client->passport_issue_place;
        }
        
        $client->save();


        $clientdetails = ClientMoreInfo::on('user_database')->where('clientid',$id)->first();
        
        if (!$clientdetails) {
            // Create new ClientMoreInfo if it doesn't exist
            $clientdetails = new ClientMoreInfo();
            $clientdetails->setConnection('user_database');
            $clientdetails->clientid = $id;
        }

        // Only update fields that exist in client_more_infos table
        $clientdetails->nationality = $data['nationality'] ?? $clientdetails->nationality ?? '';

        // Sync family members across databases
        $this->processFamilyMembersData($data, $client->id, 'user_database');

        $defaultClient = ClientDetails::on('mysql')
            ->where('clientuid', $client->clientuid)
            ->first();

        if ($defaultClient) {
            $this->processFamilyMembersData($data, $defaultClient->id, 'mysql');
        }

        $clientdetails->save();
        return $client;
    }

    /**
     * Process family members data from the dynamic form and save to database
     */
    private function processFamilyMembersData(array $data, int $clientId, string $connection)
    {
        $familyFirstNames = $data['family_first_name'] ?? [];

        if (!is_array($familyFirstNames)) {
            $familyFirstNames = [];
        }

        $familyIds = $data['family_member_ids'] ?? [];
        $familyLastNames = $data['family_last_name'] ?? [];
        $familyRelationships = $data['family_relationship'] ?? [];
        $familyDateOfBirths = $data['family_date_of_birth'] ?? [];
        $familyNationalities = $data['family_nationality'] ?? [];
        $familyPassportNumbers = $data['family_passport_number'] ?? [];
        $familyEmails = $data['family_email'] ?? [];
        $familyPhones = $data['family_phone'] ?? [];

        $parsedMembers = [];

        foreach ($familyFirstNames as $index => $firstName) {
            $firstName = trim((string)($firstName ?? ''));
            if ($firstName === '') {
                continue;
            }

            $memberIdRaw = $familyIds[$index] ?? null;
            $memberId = is_numeric($memberIdRaw) ? (int) $memberIdRaw : null;

            $parsedMembers[] = [
                'id' => $memberId,
                'client_id' => $clientId,
                'first_name' => $firstName,
                'last_name' => trim((string) ($familyLastNames[$index] ?? '')),
                'relationship' => trim((string) ($familyRelationships[$index] ?? '')),
                'date_of_birth' => $familyDateOfBirths[$index] ?? null,
                'nationality' => trim((string) ($familyNationalities[$index] ?? '')),
                'passport_number' => trim((string) ($familyPassportNumbers[$index] ?? '')),
                'email_address' => trim((string) ($familyEmails[$index] ?? '')),
                'phone_number' => trim((string) ($familyPhones[$index] ?? '')),
            ];
        }

        if ($connection === 'user_database') {
            $existingMembers = FamilyMember::on($connection)
                ->where('client_id', $clientId)
                ->get()
                ->keyBy('id');

            $retainedIds = [];

            foreach ($parsedMembers as $memberInput) {
                $payload = $this->buildFamilyMemberPayload($memberInput);
                $memberId = $memberInput['id'] ?? null;

                if ($memberId && $existingMembers->has($memberId)) {
                    $member = $existingMembers->get($memberId);
                    $member->fill($payload);
                    $member->save();
                    $retainedIds[] = $memberId;
                } else {
                    FamilyMember::on($connection)->create($payload);
                }
            }

            $idsToDelete = $existingMembers->keys()->diff($retainedIds);

            if ($idsToDelete->isNotEmpty()) {
                FamilyMember::on($connection)
                    ->whereIn('id', $idsToDelete->values()->all())
                    ->delete();
            }
        } else {
            FamilyMember::on($connection)->where('client_id', $clientId)->delete();

            foreach ($parsedMembers as $memberInput) {
                $payload = $this->buildFamilyMemberPayload($memberInput);
                FamilyMember::on($connection)->create($payload);
            }
        }
    }

    private function buildFamilyMemberPayload(array $memberInput): array
    {
        $normalize = function ($value) {
            if (is_string($value)) {
                $value = trim($value);
            }

            return $value === '' ? null : $value;
        };

        return [
            'client_id' => $memberInput['client_id'],
            'first_name' => $memberInput['first_name'],
            'last_name' => $normalize($memberInput['last_name'] ?? null),
            'relationship' => $normalize($memberInput['relationship'] ?? null),
            'date_of_birth' => $normalize($memberInput['date_of_birth'] ?? null),
            'nationality' => $normalize($memberInput['nationality'] ?? null),
            'passport_number' => $normalize($memberInput['passport_number'] ?? null),
            'email_address' => $normalize($memberInput['email_address'] ?? null),
            'phone_number' => $normalize($memberInput['phone_number'] ?? null),
        ];
    }

    public function step1createclient($data)
{
    // Get booking from default DB
    $visabooking = $this->visaRepository->bookingDataById($data['bookingid']);

    // Check if booking belongs to main client or other client
    $isMainClient = is_null($visabooking->otherclientid);
    $isClientSubmission = ($data['type'] ?? '') === 'client';
    $userDbConnection = 'user_database'; // Tenant DB connection

    // Handle MAIN CLIENT CASE
    if ($isMainClient) {

        if ($isClientSubmission) {
            // Client submitting their own form
            $client = ClientDetails::on($userDbConnection)
                ->where('id', $visabooking->client_id)
                ->first();

            $this->updateClientData($data, $client, $userDbConnection);

            $moreInfo = ClientMoreInfo::on($userDbConnection)
                ->where('clientid', $visabooking->client_id)
                ->first();

            $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
            $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);

        } else {
            // Agency submitting on behalf of client
            $agency = $this->agencyService->getAgencyData();
            $user = $this->agencyService->getCurrentLoginUser();

            $client = ClientDetails::on($userDbConnection)
                ->where('id', $visabooking->client_id)
                ->first();

            $this->updateClientData($data, $client, $userDbConnection);

            $moreInfo = ClientMoreInfo::on($userDbConnection)
                ->where('clientid', $visabooking->client_id)
                ->first();

            $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
            $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);
        }

    } else {
        // Handle OTHER CLIENT CASE (from AuthervisaApplication)
        if ($isClientSubmission) {
            // Client submission for other member
            $client = AuthervisaApplication::on($userDbConnection)
                ->where('id', $visabooking->otherclientid)
                ->first();

            $this->updateClientData($data, $client, $userDbConnection);

            $moreInfo = OtherClientInfo::on($userDbConnection)
                ->where('authervisa_application_id', $visabooking->otherclientid)
                ->first();

            $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
            $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);

        } else {
            // Agency submission for other member
            $agency = $this->agencyService->getAgencyData();
            $user = $this->agencyService->getCurrentLoginUser();

            $client = AuthervisaApplication::on($userDbConnection)
                ->where('id', $visabooking->otherclientid)
                ->first();

            $this->updateClientData($data, $client, $userDbConnection);

            $moreInfo = OtherClientInfo::on($userDbConnection)
                ->where('authervisa_application_id', $visabooking->otherclientid)
                ->first();

            $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
            $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);
        }
    }

    // Debug only if needed
    // dd($visabooking);
}


//     public function step1createclient($data)
// {
//     // dd($data);
//     // Assuming this gets visa booking data from default DB
//     $visabooking = $this->visaRepository->bookingDataById($data['bookingid']);
    
//     // Check if this is a client submission or agency submission
//     $isClientSubmission = ($data['type'] ?? '') === 'client';
    
//     if ($isClientSubmission) {
//         // For client submissions, we don't need agency data
//         $userDbConnection = 'user_database'; // Your second DB connection name
//         $client = ClientDetails::on($userDbConnection)->where('id', $visabooking->client_id)->first();
//         $this->updateClientData($data, $client, $userDbConnection);
//         $moreInfo = ClientMoreInfo::on($userDbConnection)->where('clientid', $visabooking->client_id)->first();
//         $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
        
//         // Update other client infos for additional members
//         $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);
//     } else {
//         // For agency submissions, get agency data
//         $agency = $this->agencyService->getAgencyData();
//         $user = $this->agencyService->getCurrentLoginUser();
//         $userDbConnection = 'user_database'; // Your second DB connection name
//         $client = ClientDetails::on($userDbConnection)->where('id', $visabooking->client_id)->first();
//         $this->updateClientData($data, $client, $userDbConnection);
//         $moreInfo = ClientMoreInfo::on($userDbConnection)->where('clientid', $visabooking->client_id)->first();
//         $this->updateMoreClientInfo($moreInfo, $data, $userDbConnection);
        
//         // Update other client infos for additional members
//         $this->updateOtherClientInfos($data, $visabooking->id, $userDbConnection);
//     }
// }


private function updateClientData(array $data, $client, string $connection = null)
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

    $client->passport_ic_number = $data['passport_ic_number']
        ?? $data['passport_no']
        ?? $client->passport_ic_number;
    $client->passport_issue_date = $data['passport_issue_date']
        ?? $data['date_of_issue']
        ?? $client->passport_issue_date;
    $client->passport_expiry_date = $data['passport_expiry_date']
        ?? $data['date_of_expire']
        ?? $client->passport_expiry_date;
    $client->passport_issue_place = $data['passport_issue_place']
        ?? $data['place_of_issue']
        ?? $client->passport_issue_place;

    $client->save();

    return $client;
}





private function updateMoreClientInfo($info, array $data, string $connection = null)
{
    // dd("heelo");
    // dd($data);
    if ($connection) {
        $info->setConnection($connection);
    }
    // Step 4: Spouse Details
    

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
            'status_in_china' => $data['father_status_in_china'] ?? null,
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
            'status_in_china' => $data['mother_status_in_china'] ?? null,
            'address' => $data['mother_address'] ?? null,
        ]);
    
        $info->spouse_details = json_encode([
            'name' => $data['spouse_name'] ?? null,
            'birth_place' => $data['spouse_birth_place'] ?? null,
            'nationality' => $data['spouse_nationality'] ?? null,
            'previous_nationality' => $data['spouse_previous_nationality'] ?? null,
            'country_of_birth' => $data['spouse_country_of_birth'] ?? null,
            'dob' => $data['spouse_dob'] ?? null,
            'employment' => $data['spouse_employment'] ?? null,
            'address' => $data['spouse_address'] ?? null,
        ]);
    
        if (($data['has_child'] ?? null) == 'yes') {
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

    

if(($data['step']?? null)=="previewname_permission"){
        
    $data['previous_name_status'] = isset($data['has_previous_name']) && $data['has_previous_name'] === 'yes' ? 1 : 0;
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
            'name_of_your_employer' => $data['name_of_your_employer']?? null,
            'date_from' => $data['date_from'] ?? null,
            'date_to' => $data['date_to'] ?? null,
            'duty'=> $data['duty'] ?? null,
            
        ];

        $reference_address = json_encode([
            'reference_address_1' => $data['reference_address_1'] ?? null,
            'reference_address_2' => $data['reference_address_2'] ?? null,
        ]);

       $info->reference_address = $reference_address;
    
        
        $info->employment = json_encode($employmentEducationData);

            if (($data['military_status'] ?? null) === 'yes') {
                $militaryData = [
                    'organization'    => $data['military_organization'] ?? '',
                    'designation'     => $data['military_designation'] ?? '',
                    'rank'            => $data['military_rank'] ?? '',
                    'posting_place'   => $data['military_posting_place'] ?? '',
                ];
                $info->arms_details = json_encode($militaryData);
                   
        }
        

    }

    // Common info (applies to all steps)
    $info->previous_name_status = $data['previous_name_status'] ?? $info->previous_name_status;

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
    $info->passport_type = $data['passport_type'] ?? $info->passport_type;
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
    $info->armed_permission= $data['military_status']?? $info->armed_permission;
    $info->arms_details = $info->arms_details ?? $info->arms_details;
    $info->reference_address = $info->reference_address ?? $info->reference_address;

    // family
    $info->father_details = $info->father_details ?? $info->father_details;
    $info->mother_details = $info->mother_details ?? $info->mother_details;
    $info->spouse_details = $info->spouse_details ?? $info->spouse_details;
    $info->children = $info->children ?? $info->children;
    $info->relative_information = $data['relative_information'] ?? $info->relative_information;
    $info->reference_address = $data['reference_address'] ?? $info->reference_address;
    $info->date_from = $data['date_from'] ?? $info->date_from;
    $info->date_to = $data['date_to'] ?? $info->date_to;
    $info->duty = $data['duty'] ?? $info->duty;





    $info->employment=  $info->employment ?? $info->employment;
    $info->social_media =$info->social_media ?? $info->social_media;


    $info->haspassportidenty = $info->haspassportidenty ??  $info->haspassportidenty;
    $info->other_passport_details = $info->other_passport_details ?? $info->other_passport_details;

    $info->save();

    return $info;
}

/**
 * Update other client infos for additional members (passengers/family members)
 */
private function updateOtherClientInfos(array $data, int $bookingId, string $connection = null)
{
    // Check if there's data for other members
    if (!isset($data['othermember']) || !is_array($data['othermember'])) {
        \Log::info('No othermember data found in request', ['data_keys' => array_keys($data)]);
        return;
    }

    \Log::info('Processing other member data', ['count' => count($data['othermember']), 'booking_id' => $bookingId]);

    foreach ($data['othermember'] as $index => $memberData) {
        // Skip if no ID provided
        if (!isset($memberData['id'])) {
            \Log::warning('Skipping member - no ID provided', ['index' => $index]);
            continue;
        }
        
        \Log::info('Processing member', ['member_id' => $memberData['id'], 'fields' => array_keys($memberData)]);

        // Get the authervisa_application record
        $authervisaApp = AuthervisaApplication::on($connection)
            ->where('id', $memberData['id'])
            ->where('booking_id', $bookingId)
            ->first();

        if (!$authervisaApp) {
            \Log::warning('AuthervisaApplication not found', ['member_id' => $memberData['id'], 'booking_id' => $bookingId]);
            continue;
        }
        
        \Log::info('Found AuthervisaApplication', ['id' => $authervisaApp->id]);

        // Get or create OtherClientInfo record
        $otherClientInfo = OtherClientInfo::on($connection)
            ->where('authervisa_application_id', $authervisaApp->id)
            ->first();

        if (!$otherClientInfo) {
            $otherClientInfo = new OtherClientInfo();
            if ($connection) {
                $otherClientInfo->setConnection($connection);
            }
            $otherClientInfo->authervisa_application_id = $authervisaApp->id;
        } else {
            if ($connection) {
                $otherClientInfo->setConnection($connection);
            }
        }

        // Personal Details
        $otherClientInfo->title = $memberData['title'] ?? $otherClientInfo->title;
        $otherClientInfo->full_name = $memberData['full_name'] ?? $otherClientInfo->full_name;
        $otherClientInfo->gender = $memberData['gender'] ?? $otherClientInfo->gender;
        $otherClientInfo->date_of_birth = $memberData['date_of_birth'] ?? $otherClientInfo->date_of_birth;
        $otherClientInfo->place_of_birth = $memberData['place_of_birth'] ?? $otherClientInfo->place_of_birth;
        $otherClientInfo->preview_name = $memberData['preview_name'] ?? $otherClientInfo->preview_name;
        $otherClientInfo->country_of_citizenship = $memberData['country_of_citizenship'] ?? $otherClientInfo->country_of_citizenship;
        $otherClientInfo->nationality_at_birth = $memberData['nationality_at_birth'] ?? $otherClientInfo->nationality_at_birth;
        $otherClientInfo->marital_status = $memberData['marital_status'] ?? $otherClientInfo->marital_status;
        $otherClientInfo->past_nationality = $memberData['past_nationality'] ?? $otherClientInfo->past_nationality;
        $otherClientInfo->religion = $memberData['religion'] ?? $otherClientInfo->religion;
        $otherClientInfo->visible_identification_marks = $memberData['visible_identification_marks'] ?? $otherClientInfo->visible_identification_marks;
        $otherClientInfo->languages_spoken = $memberData['languages_spoken'] ?? $otherClientInfo->languages_spoken;
        $otherClientInfo->citizenship = $memberData['citizenship'] ?? $otherClientInfo->citizenship;

        // Contact Details
        $otherClientInfo->current_residential_address = $memberData['current_residential_address'] ?? $otherClientInfo->current_residential_address;
        $otherClientInfo->city = $memberData['city'] ?? $otherClientInfo->city;
        $otherClientInfo->state = $memberData['state'] ?? $otherClientInfo->state;
        $otherClientInfo->postal_code = $memberData['postal_code'] ?? $otherClientInfo->postal_code;
        $otherClientInfo->permanent_residential_address = $memberData['permanent_residential_address'] ?? $otherClientInfo->permanent_residential_address;
        $otherClientInfo->country_of_residence = $memberData['country_of_residence'] ?? $otherClientInfo->country_of_residence;
        $otherClientInfo->phone_mobile = $memberData['phone_mobile'] ?? $otherClientInfo->phone_mobile;
        $otherClientInfo->phone_landline = $memberData['phone_landline'] ?? $otherClientInfo->phone_landline;
        $otherClientInfo->email_address = $memberData['email_address'] ?? $otherClientInfo->email_address;

        // Passport Information
        $otherClientInfo->passport_type = $memberData['passport_type'] ?? $otherClientInfo->passport_type;
        $otherClientInfo->passport_number = $memberData['passport_number'] ?? $otherClientInfo->passport_number;
        $otherClientInfo->place_of_issue = $memberData['place_of_issue'] ?? $otherClientInfo->place_of_issue;
        $otherClientInfo->date_of_issue = $memberData['date_of_issue'] ?? $otherClientInfo->date_of_issue;
        $otherClientInfo->date_of_expiry = $memberData['date_of_expiry'] ?? $otherClientInfo->date_of_expiry;
        $otherClientInfo->issuing_authority = $memberData['issuing_authority'] ?? $otherClientInfo->issuing_authority;
        $otherClientInfo->previous_passport_number = $memberData['previous_passport_number'] ?? $otherClientInfo->previous_passport_number;

        // Father Section
        $otherClientInfo->father_full_name = $memberData['father_full_name'] ?? $otherClientInfo->father_full_name;
        $otherClientInfo->father_place_of_birth = $memberData['father_place_of_birth'] ?? $otherClientInfo->father_place_of_birth;
        $otherClientInfo->father_nationality = $memberData['father_nationality'] ?? $otherClientInfo->father_nationality;
        $otherClientInfo->father_previous_nationality = $memberData['father_previous_nationality'] ?? $otherClientInfo->father_previous_nationality;
        $otherClientInfo->father_country_of_birth = $memberData['father_country_of_birth'] ?? $otherClientInfo->father_country_of_birth;
        $otherClientInfo->father_dob = $memberData['father_dob'] ?? $otherClientInfo->father_dob;
        $otherClientInfo->father_employment = $memberData['father_employment'] ?? $otherClientInfo->father_employment;
        $otherClientInfo->father_status_in_china = $memberData['father_status_in_china'] ?? $otherClientInfo->father_status_in_china;

        // Mother Section
        $otherClientInfo->mother_full_name = $memberData['mother_full_name'] ?? $otherClientInfo->mother_full_name;
        $otherClientInfo->mother_place_of_birth = $memberData['mother_place_of_birth'] ?? $otherClientInfo->mother_place_of_birth;
        $otherClientInfo->mother_nationality = $memberData['mother_nationality'] ?? $otherClientInfo->mother_nationality;
        $otherClientInfo->mother_previous_nationality = $memberData['mother_previous_nationality'] ?? $otherClientInfo->mother_previous_nationality;
        $otherClientInfo->mother_country_of_birth = $memberData['mother_country_of_birth'] ?? $otherClientInfo->mother_country_of_birth;
        $otherClientInfo->mother_dob = $memberData['mother_dob'] ?? $otherClientInfo->mother_dob;
        $otherClientInfo->mother_employment = $memberData['mother_employment'] ?? $otherClientInfo->mother_employment;
        $otherClientInfo->mother_status_in_china = $memberData['mother_status_in_china'] ?? $otherClientInfo->mother_status_in_china;

        // Spouse Section
        $otherClientInfo->spouse_full_name = $memberData['spouse_full_name'] ?? $otherClientInfo->spouse_full_name;
        $otherClientInfo->spouse_nationality = $memberData['spouse_nationality'] ?? $otherClientInfo->spouse_nationality;
        $otherClientInfo->spouse_place_of_birth = $memberData['spouse_place_of_birth'] ?? $otherClientInfo->spouse_place_of_birth;
        $otherClientInfo->spouse_previous_nationality = $memberData['spouse_previous_nationality'] ?? $otherClientInfo->spouse_previous_nationality;
        $otherClientInfo->spouse_country_of_birth = $memberData['spouse_country_of_birth'] ?? $otherClientInfo->spouse_country_of_birth;
        $otherClientInfo->spouse_dob = $memberData['spouse_dob'] ?? $otherClientInfo->spouse_dob;
        $otherClientInfo->spouse_employment_status = $memberData['spouse_employment_status'] ?? $otherClientInfo->spouse_employment_status;
        $otherClientInfo->spouse_address = $memberData['spouse_address'] ?? $otherClientInfo->spouse_address;

        // Employment & Education
        $otherClientInfo->occupation = $memberData['occupation'] ?? $otherClientInfo->occupation;
        $otherClientInfo->past_occupation = $memberData['past_occupation'] ?? $otherClientInfo->past_occupation;
        $otherClientInfo->designation = $memberData['designation'] ?? $otherClientInfo->designation;
        $otherClientInfo->employer_name = $memberData['employer_name'] ?? $otherClientInfo->employer_name;
        $otherClientInfo->business_name = $memberData['business_name'] ?? $otherClientInfo->business_name;
        $otherClientInfo->school_name = $memberData['school_name'] ?? $otherClientInfo->school_name;
        $otherClientInfo->employer_address = $memberData['employer_address'] ?? $otherClientInfo->employer_address;
        $otherClientInfo->employer_phone_number = $memberData['employer_phone_number'] ?? $otherClientInfo->employer_phone_number;
        $otherClientInfo->employment_duration = $memberData['employment_duration'] ?? $otherClientInfo->employment_duration;
        $otherClientInfo->duty = $memberData['duty'] ?? $otherClientInfo->duty;
        $otherClientInfo->study_duration = $memberData['study_duration'] ?? $otherClientInfo->study_duration;
        $otherClientInfo->employment_monthly_income = $memberData['employment_monthly_income'] ?? $otherClientInfo->employment_monthly_income;
        $otherClientInfo->educational_qualifications = $memberData['educational_qualifications'] ?? $otherClientInfo->educational_qualifications;

        // Military / Service History
        $otherClientInfo->military_status = $memberData['military_status'] ?? $otherClientInfo->military_status;
        $otherClientInfo->service_date_from = $memberData['service_date_from'] ?? $otherClientInfo->service_date_from;
        $otherClientInfo->service_date_to = $memberData['service_date_to'] ?? $otherClientInfo->service_date_to;

        // Social Media / Online Presence
        $otherClientInfo->facebook = $memberData['facebook'] ?? $otherClientInfo->facebook;
        $otherClientInfo->instagram = $memberData['instagram'] ?? $otherClientInfo->instagram;
        $otherClientInfo->twitter = $memberData['twitter'] ?? $otherClientInfo->twitter;
        $otherClientInfo->linkedin = $memberData['linkedin'] ?? $otherClientInfo->linkedin;
        $otherClientInfo->other_social_media = $memberData['other_social_media'] ?? $otherClientInfo->other_social_media;
        $otherClientInfo->personal_website = $memberData['personal_website'] ?? $otherClientInfo->personal_website;
        $otherClientInfo->blog_urls = $memberData['blog_urls'] ?? $otherClientInfo->blog_urls;

        $otherClientInfo->save();
        
        \Log::info('OtherClientInfo saved successfully', ['authervisa_application_id' => $authervisaApp->id, 'other_client_info_id' => $otherClientInfo->id]);
    }
    
    \Log::info('Finished processing all other members');
}

/**
 * Update client details
 */
public function updateClientDetails($clientId, $clientData)
{
    $client = ClientDetails::find($clientId);
    
    if (!$client) {
        throw new \Exception('Client not found');
    }
    
    $client->update($clientData);
    
    return $client;
}

}