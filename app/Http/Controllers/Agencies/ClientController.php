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


class ClientController extends Controller
{

    protected $clintRepository,$agencyService;
    use ClientTrait;
 

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
       
        return redirect()->route('client.index')->with('success', 'Client added successfully.');
    }


    public function hs_getExistingUsers(){
   
          $agency = $this->agencyService->getAgencyData();
          $clients = ClientDetails::with('clientinfo')->where('agency_id',$agency->id)->get();

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
                    'clint_id'=>'required',
                    'name' => 'required|string|max:255',
                    'last' => 'required|string|max:255',
                    'dob' => 'required|date|before:today', // Ensures DOB is a valid date and before today
                    'gender' => 'required|in:Male,Female,Other', // Allows only specific values
                    'marital_status' => 'required|in:single,married,divorced,widowed',
                    'nationality' => 'required|string|max:100',
                    'passport_number' => 'nullable', // 9 alphanumeric characters
                    'passport_issue_date' => 'nullable|date|before_or_equal:today', // Must be today or later
                    'passport_expiry_date' => 'nullable|date|after:passport_issue_date', // Must be after issue date
                    'email' => 'required|email|max:255',
                    'phone' => 'required', // Exactly 10 digits
                    'residential_address' => 'required|string|max:255',
                    'father_name' => 'required|string|max:255',
                    'mother_name' => 'required|string|max:255',
                    'spouse_name' => 'nullable|string|max:255|required_if:marital_status,Married', // Required only if Married
                    'children_count' => 'nullable|integer|min:0', // Must be a number if provided
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
    


   

    
}
