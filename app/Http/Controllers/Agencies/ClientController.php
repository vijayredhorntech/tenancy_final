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



class ClientController extends Controller
{
    use ClientTrait, ChatTrait;

    protected $clintRepository,$agencyService;
   
 

    public function __construct(ClintRepositoryInterface $clintRepository,AgencyService $agencyService)
    {
        $this->clintRepository = $clintRepository;
        $this->agencyService = $agencyService;
       
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
        return view('agencies.pages.clients.multistep',compact('agency'));

        
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
   
        // dd($request->all());
        
        $request->validate([
            'agency_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'previous_name' => 'nullable|string|max:255',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'religion' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'place_of_birth' => 'nullable|string|max:255',
            'country_of_birth' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'past_nationality' => 'nullable|string|max:255',
            'educational_qualification' => 'nullable|string|max:255',
            'identification_marks' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'citizenship_id' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'permanent_address' => 'required|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'passport_country' => 'nullable|string|max:255',
            'passport_issue_place' => 'nullable|string|max:255',
            'passport_ic_number' => 'required|numeric',
            'passport_issue_date' => 'required|date|before_or_equal:today',
            'passport_expiry_date' => 'required|date|after:passport_issue_date',
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
        ]);

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
     public function hs_viewAgencyClient($id) {
            $agency = $this->agencyService->getAgencyData();
            $client = $this->clintRepository->getClientById($id);
            // dd($client);

            if (isset($client) && $client->agency_id == $agency->id) {
                return view('agencies.pages.clients.clinthistory', compact('client'));
            }
            return redirect()->route("client.index");
        }

    /********Edit Agency Clint *****/
    public function hs_agencyUpdateClient($id){
     
        $agency = $this->agencyService->getAgencyData();
        $client = $this->clintRepository->getClientById($id);
      

            if (isset($client) && $client->agency_id == $agency->id) {
                return view('agencies.pages.clients.clintupdate', compact('client','agency'));
            }
            return redirect()->route("client.index");
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
                'previous_name' => 'nullable|string|max:255',
                'gender' => 'required|in:MALE,FEMALE,OTHER',
                'marital_status' => 'required|in:single,married,divorced,widowed',
                'religion' => 'nullable|string|max:255',
                'date_of_birth' => 'required|date|before:today',
                'place_of_birth' => 'nullable|string|max:255',
                'country_of_birth' => 'nullable|string|max:255',
                'nationality' => 'required|string|max:255',
                'past_nationality' => 'nullable|string|max:255',
                'educational_qualification' => 'nullable|string|max:255',
                'identification_marks' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'citizenship_id' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:20',
                'permanent_address' => 'required|string|max:255',
                'street' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'country' => 'required|string|max:255',
                'passport_country' => 'nullable|string|max:255',
                'passport_issue_place' => 'nullable|string|max:255',
                'passport_ic_number' => 'required|numeric',
                'passport_issue_date' => 'required|date|before_or_equal:today',
                'passport_expiry_date' => 'required|date|after:passport_issue_date',
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
            ]);
                
                $clients = $this->clintRepository->updateStoreclint($request->clint_id,$request->all());
                return redirect()->route('client.index')->with('success', 'Client added successfully.');
                
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
    
   
   

    
}
