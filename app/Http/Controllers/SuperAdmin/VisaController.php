<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Document;
use App\Models\VisaServices;
use App\Models\VisaSubtype;
use Auth; 
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Agency;
use App\Models\VisaServiceTypeDocument;
use App\Services\AgencyService;
use App\Models\Balance;


class VisaController extends Controller
{
    protected $visaRepository,$agencyService;
 

    public function __construct(VisaRepositoryInterface $visaRepository,AgencyService $agencyService)
    {
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
       
    }


    /**** Get the coutnry record*** */
    public function hsCountry(){
        
        // get record from the repositories 
        $countries = $this->visaRepository->getAllCountry();
        return view('superadmin.pages.visa.counries', compact('countries'));
    }


    /***View All Visa *****/
    public function hsVisa()
    {
        $allvisa = $this->visaRepository->getAllVisas();
        return view('superadmin.pages.visa.visaindex', compact('allvisa'));
    }



    public function hsVisacreate(){
        return view('superadmin.pages.visa.createvisa');
    }

    public function show($id)
    {
        $visa = $this->visaRepository->getVisaById($id);
        return response()->json($visa);
    }


      /***Store Visa Data *****/
    public function hsStore(Request $request)
    {
   
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string', // Allows HTML content (Quill Editor)
            'subtype'      => 'required|array|min:1',
            'subtype.*'    => 'string|max:255', // Each subtype should be a string
            'subtypeprice' => 'required|array|min:1',
            'subtypeprice.*' => 'numeric|min:0', // Each price must be a number and positive
            'commission'   => 'required|array|min:1',
            'commission.*' => 'numeric|min:0', // Each commission should be 0-100%
        ]);
   
        // Store Visa Data Using Repository
        $visa = $this->visaRepository->createVisa($data);
    
        return redirect()->route('visa.view')->with('success', 'Visa created successfully');
    }


    /****Assign To Country ******/
    public function hsassignVisa($id="null"){

        $countries=Country::get();
        $single_visa=VisaServices::find($id);
        $visa=VisaServices::get(); 

       return view('superadmin.pages.visa.visaassign',compact('countries','single_visa','visa'));
    }



    /****Visa Assign Store *****/
    public function hsassignStore(Request $request){
        $data = $request->validate([
            'visa_name'     => 'required|string|max:255',
            'visa_id'       => 'required|string|max:255',
            'origincoutnry' => 'required|integer|exists:countries,id',
            'destination'   => 'required|integer|exists:countries,id', 
            'required'        => 'required|in:0,1', 
            'description'   => 'nullable|string', 
            'title_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 

        ]);

        $visa = $this->visaRepository->assignVisaToCountry($data);

        return redirect()->route('visa.view')->with('success', 'Visa created successfully');
    
    }


    public function hseditvisa($id){
        $eid=$id; 
        $visa = $this->visaRepository->getVisaById($id);
        return view('superadmin.pages.visa.createvisa',compact('visa','eid'));
        

    }

    public function hsviewSearchvisa(Request $request){
        $data = $request->validate([
            'origincountry'     => 'required',
            'destinationcountry'       => 'required', 
        ]);

        $orgin=$request->origincountry;
        $destination=$request->destinationcountry; 
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
        return view('superadmin.pages.visa.viewsearchvisa',compact('visas'));
    }

    public function hsestorevisa(Request $request)
    {
        $data = $request->validate([
            'vid'            => 'required',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string', // Allows HTML content (Quill Editor)
            'subtype'      => 'nullable',
            'subtype.*'    => 'nullable|string|', // Each subtype should be a string
            'subtypeprice' => 'nullable|array',
            'subtypeprice.*' => 'nullable', // Each price must be a number and positive
            'commission'   => 'nullable',
            'commission.*' => 'nullable|numeric', // Each commission should be 0-100%
        ]);

        $visa = $this->visaRepository->updateVisa($request->vid,$data);

        // $visa = $this->visaRepository->updateVisa($id, $data);
        return redirect()->route('visa.view')->with('success', 'Visa updated successfully!');
    }

    public function hsvisacoutnry(){

        $visas= $this->visaRepository->allVisacoutnry();
        // dd($visas);
        return view('superadmin.pages.visa.visacoutnry',compact('visas'));
    }

    public function destroy($id)
    {
        $this->visaRepository->deleteVisa($id);
        return response()->json(['message' => 'Visa deleted successfully']);
    }


    public function hseditvisacoutnry($id){
        $eid=$id; 
        $sectedvisa=$this->visaRepository->getVisabySearchcoutnry($id);
        $countries=Country::get();
        $visa=VisaServices::get(); 
        
       return view('superadmin.pages.visa.visaassign',compact('sectedvisa','eid','countries','visa'));
       
        

    }

    public function him_payment($id){

        $sectedvisa=$this->visaRepository->getVisabySearchcoutnry($id);
        $orgin=$sectedvisa->origin;
        $destination=$sectedvisa->destination;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
    
        $status="true";
        // dd($visas);
        return view('superadmin.pages.visa.payment',compact('visas','status'));
    }


    public function him_getService(Request $request)
    {
        $visasub = VisaSubtype::where('visa_type_id', $request->visa_type_id)->get();
    
        $agency = $this->agencyService->getAgencyData();
    
        if (!$agency) {
            return response()->json(['error' => 'Agency not found'], 404);
        }
        $balance = Balance::where('agency_id', $agency->id)->first();
       
    
        return response()->json([
            'visa_subtypes' => $visasub,
            'balance' => $balance ?? '0'
        ]);
    }
    

    /*******Visa BOoking *******/

    public function hsVisaBook(Request $request){
      
      
        $data = $request->validate([
            'origin'        => 'required|integer|exists:countries,id',  // Ensure it exists in the countries table
            'destination'   => 'required|integer|exists:countries,id',  
            'typeof'        => 'required|integer|exists:visa_types,id',  
            'category'      => 'required|integer|exists:visa_subtypes,id',  
        
            'lastname'      => 'required|string|max:255',  
            'firstname'     => 'required|string|max:255',  
        
            'citizenship'   => 'nullable|string|max:255',  // Fix: "null" should be "nullable|string"  
            'email'         => 'required|email|max:255',  
            'phonenumber'   => 'required|numeric|digits_between:8,15', // Ensures phone number is reasonable  
        
            'dateofentry'   => 'required|date|after_or_equal:today', // Ensures it's a valid date and not in the future  
        ]);
        
        $visas = $this->visaRepository->saveBooking($request->all());
    
        return redirect()->route('agency_dashboard')->with('success', 'Booking successful');
    }

    
       /*******Visa Application form *******/
    public function hs_visaApplication($type){


        /***Ger Agency Rerod in the Visa Application ****/
        $agency = $this->agencyService->getAgencyData();  
        $allbookings = $this->visaRepository->getBookingByid($agency->id,$type);
        return view('superadmin.pages.visa.visaApplication', compact('allbookings'));
       
           
    }

    public function hsVisaDocumentpending(){
        return view('superadmin.pages.visa.payment',compact('visas'));
    }

    /******Form Function *******/

    public function hsFromindex(){
        $countries=Country::get();
        $forms = $this->visaRepository->allForms();
        // $forms=Document::allForms(); 
        return view('superadmin.pages.visa.form',compact('countries','forms'));
    }

    /*****Form Store ******/

    public function hsFromStore(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'origincoutnry' => 'required|integer',
            'destination' => 'required|integer',
            'description' => 'nullable', // Fixed spelling & added comma
            'form_uploade' => 'required|file|mimes:pdf|max:2048' // Allow only PDFs, max 2MB
        ]);

        $forms = $this->visaRepository->storeForms($request->all());
        return redirect()->route('visa.forms')->with('success', 'Booking successful');
    }


    /*****Visa View *****/
    public function hsVisaVisa($id){

        $clientData = $this->visaRepository->bookingDataById($id);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();

        return view('superadmin.pages.visa.viewvisaapplication',compact('clientData','forms'));
           
    }

    /****Edit Visa application *****/
    public function hsEditVisaApplication($id){
        
        $clientData = $this->visaRepository->bookingDataById($id);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();

        return view('superadmin.pages.visa.editvisaapplication',compact('clientData','forms'));
    }

    /*****Update Application ******/
    public function hsupdateapplication(Request $request){
        dd($request->all());
    }
}
