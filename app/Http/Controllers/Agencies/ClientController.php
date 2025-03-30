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
        return view('agencies.pages.clients.clientcreate');
    }
   

    public function hs_index()
    {
        $clients = $this->clintRepository->getAllClint();
        $searchback=false; 
        return view('agencies.pages.clients.index', compact('clients','searchback'));
    }


    public function hs_ClientStore(Request $request){
   
        $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'dob' => 'required|date|before:today', // Ensures DOB is a valid date and before today
            'gender' => 'required|in:Male,Female,Other', // Allows only specific values
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'nationality' => 'required|string|max:100',
            'passport_number' => 'nullable', // 9 alphanumeric characters
            'passport_issue_date' => 'nullable|date|before_or_equal:today', // Must be today or later
            'passport_expiry_date' => 'nullable|date|after:passport_issue_date', // Must be after issue date
            'email' => 'required|email|max:255|unique:client_details,email',
            'phone' => 'required', // Exactly 10 digits
            'residential_address' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'spouse_name' => 'nullable|string|max:255|required_if:marital_status,Married', // Required only if Married
            'children_count' => 'nullable|integer|min:0', // Must be a number if provided
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
                return view('agencies.pages.clients.clintupdate', compact('client'));
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


   

    public function show(ClientDetails $client)
    {
        return view('agencies.clients.show', compact('client'));
    }

    public function edit(ClientDetails $client)
    {
        return view('agencies.clients.edit', compact('client'));
    }


    public function update(Request $request, ClientDetails $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:client_details,email,' . $client->id,
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string',
            'agency_id' => 'nullable|integer',
            'passport_number' => 'required|string|unique:client_details,passport_number,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }


   

    

    
    public function destroy(ClientDetails $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
