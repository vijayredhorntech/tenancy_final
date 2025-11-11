<?php

namespace App\Http\Controllers\Agencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientDetails;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use Auth; 
use Illuminate\Support\Str;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use App\Services\AgencyService;
use App\Traits\ClientTrait;
use App\Traits\ChatTrait;
use App\Models\Deduction;
use App\Services\ClientHistoryService;
use App\Models\FamilyMember; 
use App\Traits\Toastable;



class ClientController extends Controller
{
    use ClientTrait, ChatTrait, Toastable;
 

    protected $clintRepository,$agencyService,$historyService;
   
 

    public function __construct(ClintRepositoryInterface $clintRepository,AgencyService $agencyService,ClientHistoryService $historyService)
    {
        $this->clintRepository = $clintRepository;
        $this->agencyService = $agencyService;
        $this->historyService = $historyService;

       
    }


    
    /*** Pdf Generate *****/
    public function generatePDF()
    {
        $agency = $this->agencyService->getAgencyData();
        $clients = ClientDetails::where('agency_id',$agency->id)->get();
        $title = "Clint Reports";
        return $this->generateClintPDF($title, $clients);
    }





    /******Generate Excel file ******/
    public function exportAgency()
    {
        // $clients = $this->clintRepository->getAllClint();
        $agency = $this->agencyService->getAgencyData();
        $clients = ClientDetails::where('agency_id',$agency->id);
        return $this->generateClintsExcel($clients);
    }





    public function hs_getClientView(){
        // return view('agencies.pages.clients.clientcreate');
        $agency = $this->agencyService->getAgencyData();
        return view('agencies.pages.clients.clientcreate',compact('agency'));

        
    }
   

    public function hs_index(Request $request)
    {
        

        $clients = $this->clintRepository->getAllClint($request);
        $agency = $this->agencyService->getAgencyData();
        
        return view('agencies.pages.clients.index', compact('clients','agency'));
    }

    public function hsClientCreate($token){
        $agency=$this->agencyService->getAgencyDataWithToken($token);
        return view('agencies.pages.clients.createclientform',compact('agency'));
        
    }


    public function hs_ClientStore(Request $request){
   

        $request->validate([
            'agency_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'nationality' => 'required|string|max:255',
        ]);

        // dd($request->all());
        $clients = $this->clintRepository->getStoreclint($request->all());
        // dd($clients);    
        return redirect()->route('client.index')->with('success', 'Client added successfully.');
    }


    public function hs_getExistingUsers(){
   
          $agency = $this->agencyService->getAgencyData();
          $clients = ClientDetails::on('user_database')->with('clientinfo')->where('agency_id',$agency->id)->get();

        return response()->json($clients);
    }

    public function create()
    {
        return view('agencies.pages.clients.create');
    }


   /**** View Agency Client *****/
public function hs_viewAgencyClient($id)
{
    

    $agency = $this->agencyService->getAgencyData();
    $client = $this->clintRepository->getClientById($id);

    if (isset($client) && $client->agency_id == $agency->id) {
        // ✅ Total Invoices
        $totalInvoicesCount = \App\Models\Deduction::where('client_id', $client->id)
            ->where('agency_id', $agency->id)
            ->count();

        // ✅ Total Signed Documents (DocSign)
        $paidInvoicesCount = Deduction::where('client_id', $client->id)
            ->where('agency_id', $agency->id)
            ->whereHas('docsign', function ($docSignQuery) {
                $docSignQuery->whereHas('docsign', function ($docSignProcessQuery) {
                    $docSignProcessQuery->where('status', 'Signed');
                });
            })->count();

        // ✅ Total Bookings (flight/visa/hotel)
        $bookingDeductions = \App\Models\Deduction::where('client_id', $client->id)
            ->where('agency_id', $agency->id)
            ->get();

        $bookingCount = 0;
        foreach ($bookingDeductions as $deduction) {
            if ($deduction->flightBooking || $deduction->visaBooking || $deduction->hotelBooking) {
                $bookingCount++;
            }
        }

        return view('agencies.pages.clients.clinthistory', compact(
            'client',
            'totalInvoicesCount',
            'paidInvoicesCount',
            'bookingCount'
        ));
    }

    return redirect()->route("client.index");
}



    /********Edit Agency Clint *****/
public function hs_agencyUpdateClient(Request $request, $id)
{
    $agency = $this->agencyService->getAgencyData();
    $client = $this->clintRepository->getClientById($id);

    // Check if client exists and belongs to the agency
    if (!$client || $client->agency_id !== $agency->id) {
        return redirect()->route("client.index")->with('error', 'Unauthorized access.');
    }

    // If it's a POST or PUT request, update the client
    if ($request->isMethod('post') || $request->isMethod('put')) {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'permanent_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            // Add other fields here as needed
        ]);

        // Update the client (assuming $client is an Eloquent model)
        $client->update($validated);

        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }

    // Otherwise, show the form (GET request)
    return view('agencies.pages.clients.clintupdate', compact('client', 'agency'));
}



    /****Store Update Cint***** */
    public function hs_storeUpdateAgencyClient(Request $request){
      
        $agency = $this->agencyService->getAgencyData();
        $client = $this->clintRepository->getClientById($request->clint_id);

        if (isset($client) && $client->agency_id == $agency->id) {

            $request->validate([
                'agency_id' => 'required|integer',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'permanent_address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                // Optional fields
                'previous_name' => 'nullable|string|max:255',
                'gender' => 'nullable|in:MALE,FEMALE,OTHER',
                'marital_status' => 'nullable|in:single,married,divorced,widowed',
                'religion' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date|before:today',
                'place_of_birth' => 'nullable|string|max:255',
                'country_of_birth' => 'nullable|string|max:255',
                'past_nationality' => 'nullable|string|max:255',
                'educational_qualification' => 'nullable|string|max:255',
                'identification_marks' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'citizenship_id' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:20',
                'street' => 'nullable|string|max:255',
                'passport_no' => 'nullable|string|max:255',
                'passport_country' => 'nullable|string|max:255',
                'passport_issue_place' => 'nullable|string|max:255',
                'passport_ic_number' => 'nullable|numeric',
                'passport_issue_date' => 'nullable|date|before_or_equal:today',
                'passport_expiry_date' => 'nullable|date',
                'date_of_issue' => 'nullable|date',
                'date_of_expire' => 'nullable|date',
                'place_of_issue' => 'nullable|string|max:255',
                'cities_visited' => 'nullable|string|max:500',
                'previous_visa_number' => 'nullable|string|max:50',
                'previous_visa_place' => 'nullable|string|max:255',
                'previous_visa_issue_date' => 'nullable|date',
                'countries_visited_last_10_years' => 'nullable|string|max:500',
                'present_occupation' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
                'employer_name' => 'nullable|string|max:255',
                'employer_address' => 'nullable|string|max:255',
                'employer_phone' => 'nullable|string|max:20',
                'past_occupation' => 'nullable|string|max:255',
                'reference_name' => 'nullable|string|max:255',
                'reference_address' => 'nullable|string|max:255',
                'military_status' => 'nullable|in:yes,no',
                'military_organization' => 'nullable|string|max:255',
                'military_designation' => 'nullable|string|max:255',
                'military_rank' => 'nullable|string|max:255',
                'military_posting_place' => 'nullable|string|max:255',
                // Family member validation
                'family_member_ids.*' => 'nullable|integer',
                'family_first_name.*' => 'nullable|string|max:255',
                'family_last_name.*' => 'nullable|string|max:255',
                'family_relationship.*' => 'nullable|in:spouse,child,parent,sibling,other',
                'family_date_of_birth.*' => 'nullable|date',
                'family_nationality.*' => 'nullable|string|max:255',
                'family_passport_number.*' => 'nullable|string|max:255',
                'family_email.*' => 'nullable|email|max:255',
                'family_phone.*' => 'nullable|string|max:20',
            ]);
                
                $clients = $this->clintRepository->updateStoreclint($request->clint_id,$request->all());
                return redirect()->route('client.index')->with('success', 'Client updated successfully.');
                
            }
            return redirect()->route("client.index");
      

    }


    /****Delete  Client***** */
    public function hs_deleteAgencyClient($id)
    {
        $agency = $this->agencyService->getAgencyData();
        $client = $this->clintRepository->getClientById($id);
    
        if (!$client || $client->agency_id !== $agency->id) {
            return redirect()->route('client.index')->with('error', 'Unauthorized or client not found.');
        }
    
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

    /****Delete Family Member***** */
    public function hs_deleteFamilyMember($id)
    {
        try {
            $agency = $this->agencyService->getAgencyData();
            
            // Find family member in user_database
            $familyMember = FamilyMember::on('user_database')->find($id);
            
            if (!$familyMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'Family member not found'
                ], 404);
            }
            
            // Get the client to verify agency ownership
            $client = ClientDetails::on('user_database')->find($familyMember->client_id);
            
            if (!$client || $client->agency_id !== $agency->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }
            
            // Delete from user_database
            $familyMember->delete();
            
            // Also delete from default database if exists
            $defaultFamilyMember = FamilyMember::on('mysql')
                ->where('client_id', $client->id)
                ->where('first_name', $familyMember->first_name)
                ->where('last_name', $familyMember->last_name)
                ->first();
            
            if ($defaultFamilyMember) {
                $defaultFamilyMember->delete();
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Family member deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error deleting family member: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the family member'
            ], 500);
        }
    }


    public function hs_agencyChatClient($id){
        $agency = $this->agencyService->getAgencyData();
        
        $client = $this->clintRepository->getClientById($id);
     
        if (!$client || $client->agency_id!== $agency->id) {
            return redirect()->route('client.index')->with('error', 'Unauthorized or client not found.');
        }
        return view('agencies.pages.clients.chat',compact('client','agency'));
    }



    public function hs_agencyChatStore(Request $request){
      
            $request->validate([
                'message' => 'required_without:attachment|string|max:1000',
                'type' => 'required|string|max:255',
                'clientid'=>'required|integer',
                'recevier_id' => 'required|integer',
                'sender_id' => 'required|integer',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
            ]);
    
            // Handle file upload
            $filename = null;
    
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = $file->store('messages', 'public'); // stored in storage/app/public/messages
            }
          
            $agency=$this->agencyService->getAgencyData();
    
            $ticket_code = 'TICKET-' . strtoupper(Str::random(6)) . '-' . time();
            $type = 'agency';
            $clientid = $request->clientid;
            $agencyid = $agency->id;
            $loginuserid=Auth()->user()->id;
    
            // Now call the function properly
            $support = $this->getStoreClient($request, $ticket_code, $type, $filename, $agencyid, $clientid,$loginuserid);
           
            
    
            return response()->json([
                'success' => true,
                'message' => $support
            ]);
  
    }


        public function hs_ClientStoreAjax(Request $request)
    {
        // You can log or debug the request if needed
        // dd($request->all());

        // Store client using repository
        $this->clintRepository->step1createclient($request->all());

        // Return JSON response
        return response()->json([
            'status' => 'success',
            'preview'=>$request->previewstep,
            'step' => $request->step
        ]);
    }



/*****History For Client ***** */

public function hscallHistoryClient($id){



    $agency = $this->agencyService->getAgencyData();

    $user = $this->agencyService->getCurrentLoginUser();
    $permissions = $user->getAllPermissions()->pluck('name');


    $clientDetails = $this->agencyService->getClientDetails($id,$agency);
    
        if (!$clientDetails) {
            abort(403, 'Unauthorized action.');
        }
 

      $histories = $this->historyService->getHistory([
            'client_id'=> $id, 
            'type'      => 'agency',   // optional filter
        ]);
     


   return view('agencies.pages.clients.clienthistory.call-history', compact('histories','user','clientDetails','permissions'));

}


public function hsstoreCommunication(Request $request)
{
    $request->validate([
        'client_id'   => 'required|integer',
        'description' => 'required|string',
    ]);

    $agency = $this->agencyService->getAgencyData();
    $user = $this->agencyService->getCurrentLoginUser();

    // Save history using your ClientHistoryService
    $this->historyService->save([
        'user_id'     => $user->id,
        'client_id'   => $request->client_id,
        'agency_id'   => $agency->id ?? null, // if needed
        'description' => $request->description,
        'type'        => 'agency',
        'date_time'   => now(),
    ]);

      $this->error('Communication saved successfully.');
    return back();
}



public function hseditHistory($clientId, $historyId){

    
    $history = $this->historyService->getHistoryById([
        'client_id' => $clientId,
        'historyid' => $historyId,
        'type'      => 'agency', // optional filter
    ]);

    $user = $this->agencyService->getCurrentLoginUser();

    if($history->user_id !== $user->id){
        $this->error('You can only edit your own communications.');
       return back();
    }
 

    return view('agencies.pages.clients.clienthistory.edit-history', compact('history','user'));

}


public function hsupdateHistory(Request $request){
    $request->validate([
        'description' => 'required|string',
    ]);
        $user = $this->agencyService->getCurrentLoginUser();
    $history = $this->historyService->updateHisotry([
        'data' => $request->all(),
        'type'      => 'agency', // optional filter
    ]);

    $this->success('Communication updated successfully.');
    return redirect()->route('agency.client.history', [
        'id' => $request->client_id
    ]);

}

/*** Controller method to call deletion ***/
public function hsdeleteHistory($clientId, $historyId)
{
    $this->historyService->deleteClientHistory([
        'client_id' => $clientId,
        'historyid' => $historyId,
        'type'      => 'agency', // optional filter
    ]);

    $this->success('History deleted successfully.');
    return back();
}



/***** Family Members Methods *****/

    /**
     * Get family members for a client
     */
    public function hsGetFamilyMembers($clientId)
    {
        $agency = $this->agencyService->getAgencyData();
        $client = $this->clintRepository->getClientById($clientId);

        if (!$client || $client->agency_id !== $agency->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get family members from the family_members table
        $familyMembers = FamilyMember::where('client_id', $clientId)
            ->orderBy('created_at')
            ->get();

        \Log::info('Family members query result:', ['client_id' => $clientId, 'count' => $familyMembers->count(), 'members' => $familyMembers->toArray()]);

        $mappedMembers = $familyMembers->map(function ($member) {
                return [
                    'id' => 'family_' . $member->id,
                    'name' => trim(($member->first_name ?? '') . ' ' . ($member->last_name ?? '')),
                    'first_name' => $member->first_name,
                    'last_name' => $member->last_name,
                    'relationship' => $member->relationship,
                    'date_of_birth' => $member->date_of_birth,
                    'phone_number' => $member->phone_number,
                    'passport_number' => $member->passport_number,
                    'email_address' => $member->email_address,
                    'nationality' => $member->nationality,
                    'passport_issue_date' => $member->passport_issue_date,
                    'passport_expiry_date' => $member->passport_expiry_date,
                ];
            });

        return response()->json($mappedMembers);
    }

/**
 * View family member details
 */
public function hsViewFamilyMember($familyMemberId)
{
    $agency = $this->agencyService->getAgencyData();

    // Extract the actual family member ID from the format 'family_{id}'
    if (strpos($familyMemberId, 'family_') === 0) {
        $memberId = str_replace('family_', '', $familyMemberId);
    } else {
        return redirect()->route('client.index')->with('error', 'Invalid family member ID format');
    }

    $familyMember = FamilyMember::on('user_database')->find($memberId);

    if (!$familyMember) {
        return redirect()->route('client.index')->with('error', 'Family member not found');
    }

    $client = $this->clintRepository->getClientById($familyMember->client_id);

    if (!$client || $client->agency_id !== $agency->id) {
        return redirect()->route('client.index')->with('error', 'Unauthorized');
    }

    return view('agencies.pages.clients.family-member-view', compact('familyMember', 'client'));
}

/**
 * Edit family member
 */
public function hsEditFamilyMember($familyMemberId)
{
    $agency = $this->agencyService->getAgencyData();

    // Extract the actual family member ID from the format 'family_{id}'
    if (strpos($familyMemberId, 'family_') === 0) {
        $memberId = str_replace('family_', '', $familyMemberId);
    } else {
        return redirect()->route('client.index')->with('error', 'Invalid family member ID format');
    }

    $familyMember = FamilyMember::on('user_database')->find($memberId);

    if (!$familyMember) {
        return redirect()->route('client.index')->with('error', 'Family member not found');
    }

    $client = $this->clintRepository->getClientById($familyMember->client_id);

    if (!$client || $client->agency_id !== $agency->id) {
        return redirect()->route('client.index')->with('error', 'Unauthorized');
    }

    return view('agencies.pages.clients.family-member-edit', compact('familyMember', 'client', 'familyMemberId'));
}

/**
 * Update family member
 */
public function hsUpdateFamilyMember(Request $request, $familyMemberId)
{
    $agency = $this->agencyService->getAgencyData();

    // Extract the actual family member ID from the format 'family_{id}'
    if (strpos($familyMemberId, 'family_') === 0) {
        $memberId = str_replace('family_', '', $familyMemberId);
    } else {
        return redirect()->route('client.index')->with('error', 'Invalid family member ID format');
    }

    $familyMember = FamilyMember::on('user_database')->find($memberId);

    if (!$familyMember) {
        return redirect()->route('client.index')->with('error', 'Family member not found');
    }

    $client = $this->clintRepository->getClientById($familyMember->client_id);

    if (!$client || $client->agency_id !== $agency->id) {
        return redirect()->route('client.index')->with('error', 'Unauthorized');
    }

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'relationship' => 'required|in:spouse,child,parent,sibling,other',
        'date_of_birth' => 'nullable|date',
        'nationality' => 'nullable|string|max:255',
        'email_address' => 'nullable|email|max:255',
        'phone_number' => 'nullable|string|max:20',
        'passport_number' => 'nullable|string|max:50',
        'passport_issue_date' => 'nullable|date',
        'passport_expiry_date' => 'nullable|date',
    ]);

    $familyMember->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'relationship' => $request->relationship,
        'date_of_birth' => $request->date_of_birth,
        'nationality' => $request->nationality,
        'email_address' => $request->email_address,
        'phone_number' => $request->phone_number,
        'passport_number' => $request->passport_number,
        'passport_issue_date' => $request->passport_issue_date,
        'passport_expiry_date' => $request->passport_expiry_date,
        'passport_ic_number' => $request->passport_ic_number,
        'passport_issue_date' => $request->passport_issue_date,
        'passport_expiry_date' => $request->passport_expiry_date,
    ]);

    return redirect()->route('agencyview.client', $client->id)->with('success', 'Family member updated successfully');
}




  
   
   

    
}
