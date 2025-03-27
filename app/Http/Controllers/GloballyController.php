<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Models\Service;
use App\Models\ClientDetails;
use App\Models\Document;
use App\Models\Country;
use App\Models\VisaServices;

use App\Services\AgencyService;


class GloballyController extends Controller
{

    protected $agencyService;
    
    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
       
    }


    public function hs_globalSearch(Request $request)
    {
        $type = $request->type;
        $search = $request->search;
    
        switch ($type) {
         /*****Agency  Serach****/
            case 'agency':
                return $this->agencySearch($search);
         /*****Clint Serach****/
            case 'client':
                return $this->clientSearch($search);
         /*****Form Serach****/   
            case 'form':
            return $this->formSearch($search);   
            
        /*****Visa Serach****/   
            case 'visa':
            return $this->visaSearch($search); 

         /*****Applciation Serach****/   
         case 'application_all':
            return $this->applicationSearch($search); 


            default:
                return response()->json(['error' => 'Invalid search type'], 400);
        }
    }
    
    /**
     * Search for agencies
     */
    private function agencySearch($search)
    {
        $user = Auth::user();
    
        $agencies = Agency::with(['domains', 'userAssignments.service', 'balance', 'details'])
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('contact_person', 'LIKE', "%{$search}%");
            })
            ->get();
    
        $services = Service::all();
    
        return view('superadmin.pages.agencies.agency', [
            'user_data' => $user,
            'agencies' => $agencies,
            'services' => $services,
            'searchback' => true
        ]);
    }
    
    /**
     * Search for clients
     */
    private function clientSearch($search)
    {
        // Get Agency record
        $agency = $this->agencyService->getAgencyData();
        $clients = ClientDetails::where('agency_id', $agency->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get();
        $searchback = true;
        return view('agencies.pages.clients.index', compact('clients', 'searchback'));
    }



    /**
     * Search for Froms
     */
    private function formSearch($search)
    {
        $countries=Country::get();
        $forms = Document::with('countries')
            ->where(function ($query) use ($search) {
                $query->where('form_name', 'LIKE', "%{$search}%");
            })
            ->get();
        $searchback = true;
        return view('superadmin.pages.visa.form',compact('countries','forms','searchback'));
        // return view('agencies.pages.clients.index', compact('clients', 'searchback'));
    }

    /******* Visa Search */
    
    private function visaSearch($search)
    {
        $allvisa = VisaServices::where('name', 'LIKE', "%{$search}%")->paginate(10);
        $searchback = true;
    
        return view('superadmin.pages.visa.visaindex', compact('allvisa', 'searchback'));
    }
    
    
    
    
}

