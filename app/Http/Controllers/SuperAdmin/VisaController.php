<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Log;
use App\Models\Document;
use App\Models\VisaServices;
use App\Models\VisaSubtype;
use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\Agency;
use App\Models\VisaServiceTypeDocument;
use App\Services\AgencyService;
use App\Models\Balance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use App\Traits\ChatTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentDownloadedNotificationMail;
// use Illuminate\Support\Facades\Mail;
use App\Mail\VisaBookingInProcessMail;
use App\Models\ClientMoreInfo;
use App\Models\ClientDetails;
use App\Models\VisaServiceType;
use App\Models\VisaBooking;
use App\Models\VisaSection;
use App\Models\TermType;
use App\Models\ClientApplicationDocument;
use App\Models\TermsCondition;

use App\Models\ClientInfoForCountry;
use App\Models\RequestApplication;
use App\Models\FamilyMember;
use App\Models\AmendmentHistory;
use App\Traits\Toastable;




class VisaController extends Controller
{
    use ChatTrait,Toastable;

    protected $visaRepository,$clintRepository;
    protected $agencyService;
    protected $termConditionRepo;

    public function __construct( ClintRepositoryInterface $clintRepository,VisaRepositoryInterface $visaRepository, AgencyService $agencyService,TermConditionRepositoryInterface $termConditionRepo) {
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
        $this->clintRepository = $clintRepository;
         $this->termConditionRepo = $termConditionRepo;


    }


    /***Export Method *****/


    /*** Pdf Generate *****/
    public function hsexportPdf()
    {
        $agency = $this->agencyService->getAgencyData();
        $allbookings = $this->visaRepository->getBookingByid($agency->id,$type);

        $title = "Visa Booking Reports";

        return $this->generateAgenciesPDF($title, $allbookings);
    }





    /******Generate Excel file ******/
    public function exportAgency()
    {
        $agencies = Agency::with('domains', 'userAssignments.service', 'balance')
            ->get()
            ->sortByDesc(fn($agency) => $agency->details->status == '0' ? 0 : 1);
        return $this->generateAgenciesExcel($agencies);
    }




    /**** Get the coutnry record*** */
    public function hsCountry(){

        // get record from the repositories
        $countries = $this->visaRepository->getAllCountry();
        return view('superadmin.pages.visa.counries', compact('countries'));
    }

//    all application
    public function hs_visaAllApplication(Request $request){
        $allbookings = $this->visaRepository->getSuperadminAllApplication($request);
        $countries=Country::get();
        $agencies=Agency::get();  
        return view('superadmin.pages.visa.superadminallapplication', compact('allbookings','countries','agencies'));
    }

    /***View single Application of  ****/
    public function hs_editSAApplication($id){

        $clientData = $this->visaRepository->bookingDataById($id);
        return view('superadmin.pages.visa.superadmineditapplication',compact('clientData'));
    }

    public function hs_viewSAApplication($id){

        // 
        $countries =Country::get(); 
        $clientData = $this->visaRepository->bookingDataById($id);
        // dd($clientData);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();
        return view('superadmin.pages.visa.superadminviewapplication',compact('clientData','forms','countries'));
    }


    /***View All Visa *****/
    public function hsVisa()
    {
        $allvisa = $this->visaRepository->getAllVisas();
    
        
        return view('superadmin.pages.visa.visaindex', compact('allvisa'));
    }

    public function hsVisaView($id){
        $visa = $this->visaRepository->getVisaById($id);
        $clientData=[];
        return view('superadmin.pages.visa.addsection.visaview', compact('visa','clientData'));
    }




    public function hsVisacreate(){
        return view('superadmin.pages.visa.createvisa');
    }


    public function show($id)
    {
        $visa = $this->visaRepository->getVisaById($id);
        return response()->json($visa);
    }

    
    //filed data 
    public function hsrequiredClientFiled($id)
    {
        
        $visadetails = VisaServiceType::with('destinationcountry', 'VisaServices')->where('id', $id)->first();
        $checkbefore = ClientInfoForCountry::where('destination_id', $visadetails->destinationcountry->id)->
        where('visa_id',$visadetails->visa_id)->first();
        if(isset($checkbefore)){
          $assign = $checkbefore;
        }else{
          $assign = ClientInfoForCountry::where('destination_id', $visadetails->destinationcountry->id)->first();

        }
        // Fetch all VisaSection records and decode fields
        $sections = VisaSection::all();
          $groupedFields = [];
        foreach ($sections as $section) {
            $fields = $section->fields;
        
            if (is_array($fields)) {
                $groupedFields[] = [
                    'name' => $section->section_name,
                    'slug' => $section->slug,
                    'filed' => $fields
                ];
            }}
        
        return view('superadmin.pages.visa.assigncountry', compact('groupedFields', 'visadetails', 'assign'));
    }
    
    

   public function hsrequiredClientFiledStore(Request $request){
  
    $validated = $request->validate([
        'section_name' => 'required|array',
        'section_name.*' =>'string', // each element should be string
        'visa_fields' => 'required|array',
        'visa_fields.*' => 'string', // each element should be string
    ]);

    // Convert visa_fields array to JSON before storing
    $section_name = json_encode($validated['section_name']);

    $jsonVisaFields = json_encode($validated['visa_fields']);
    $visadetails=VisaServiceType::with('destinationcountry','VisaServices')->where('id',$request->assigncoutnry)->first();
    $assign = ClientInfoForCountry::where('destination_id', $request->countryid)->first();

        if ($assign) {
            // Update existing record
            $assign->visa_id = $visadetails->visa_id;
            $assign->section_name = $section_name; // Assuming you want to store it as a JSON array
            $assign->name_of_field = $jsonVisaFields;
            $assign->save();
        } else {
            // Create new record
            ClientInfoForCountry::create([
                'visa_id' => $visadetails->visa_id,
                'section_name' => $section_name, // Assuming you want to store it as a JSON array
                'assignid' => $visadetails->id,
                'name_of_field' => $jsonVisaFields,
                'destination_id' => $visadetails->destination,
            ]);
        }
        $this->success('Visa created successfully');
       return redirect()->route('visa.country');
    
   }
      /***Store Visa Data *****/
  
  
      public function hsStore(Request $request)
     {
        $data = $request->validate([
            'name'         => 'required|string|max:255|unique:visa_types,name',
            'description'  => 'nullable|string', 
        ]);
        $visa = $this->visaRepository->createVisa($data); 
        return redirect()->route('allvisa.view')->with('success', 'Visa created successfully');
    }


    public function hsViewdelete($id){
        $visa = $this->visaRepository->deleteVisa($id);
        $this->success('Visa Deleted successfully');
        return redirect()->route('visa.view');
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
            'visa_name'     => 'string|max:255',
            'visa_id'       => 'required|integer|max:255',
            'origincoutnry' => 'required|integer|exists:countries,id',
            'destination'   => 'required|integer|exists:countries,id',
            'required'        => 'required|in:0,1',
            'description'   => 'nullable|string',
            'title_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'subtype'      => 'required|array|min:1',
            'subtype.*'    => 'string|max:255', // Each subtype should be a string
            'subtypeprice' => 'required|array|min:1',
            'subtypeprice.*' => 'numeric|min:0', // Each price must be a number and positive
            'commission'   => 'required|array|min:1',
            'commission.*' => 'numeric|min:0', // Each commission should be 0-100%
            'validity'      => 'required|array|min:1',
            'validity.*'    => 'string|max:255',
            'processing'      => 'required|array|min:1',
            'processing.*'    => 'string|max:255',
            'gstin'   => 'required|array|min:1',
            'gstin.*' => 'numeric|min:0',
            

        ]);
       
        $visa = $this->visaRepository->assignVisaToCountry($data);
        // dd($visa);
        // {{ route('visa.view', ['id' => $visa->id]) }}
        return redirect()->route('visa.view', ['id' => $visa->visa_id])->with('success', 'Visa created successfully');

    }


    
    public function hsassignupdateStore(Request $request){
      
        $data = $request->validate([
            'visa_name'      => 'string|max:255',
            'visa_id'        => 'required|integer|max:255',
            'origincoutnry'  => 'required|integer|exists:countries,id',
            'destination'    => 'required|integer|exists:countries,id',
            'required'       => 'required|in:0,1',
            'description'    => 'nullable|string',
        
            // Optional file
            'title_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
            // Nullable arrays with validation if present
            'subtype'        => 'nullable|array',
            'subtype.*'      => 'nullable|string|max:255',
        
            'subtypeprice'   => 'nullable|array',
            'subtypeprice.*' => 'nullable|numeric|min:0',
        
            'commission'     => 'nullable|array',
            'commission.*'   => 'nullable|numeric|min:0',
        
            'validity'       => 'nullable|array',
            'validity.*'     => 'nullable|string|max:255',
        
            'processing'     => 'nullable|array',
            'processing.*'   => 'nullable|string|max:255',
        
            'gstin'          => 'nullable|array',
            'gstin.*'        => 'nullable|numeric|min:0',
        ]);

        $visa = $this->visaRepository->updateVisaAssignment($data,$request->selectcoutnry);

        return redirect()
        ->route('visa.editcountry', ['id' => $request->selectcoutnry])
        ->with('success', 'Visa updated successfully.');
    }



    public function hseditvisa($id){
        $eid=$id;
        $visa = $this->visaRepository->getVisaById($id);
        return view('superadmin.pages.visa.createvisa',compact('visa','eid'));


    }

    public function hsviewSearchvisa(Request $request){

        // dd("Heelo");

        $data = $request->validate([
            'origincountry'     => 'required',
            'destinationcountry'       => 'required',
        ]);

        $orgin=$request->origincountry;
        $destination=$request->destinationcountry;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
        $countries=Country::get();
        
        $agency = $this->agencyService->getAgencyData();
        if($agency==null){
             return view('agencies.pages.visa.viewsearchvisa',compact('visas','countries','orgin','destination'));
        }
        return view('superadmin.pages.visa.viewsearchvisa',compact('visas','countries','orgin','destination'));
    }



    // public function hsestorevisa(Request $request)
    // {
    //     $data = $request->validate([
    //         'vid'            => 'required',
    //         'name'         => 'required|string|max:255',
    //         'description'  => 'nullable|string', // Allows HTML content (Quill Editor)
         
    //     ]);

    //     $visa = $this->visaRepository->updateVisa($request->vid,$data);

    //     // $visa = $this->visaRepository->updateVisa($id, $data);
    //     return redirect()->route('visa.view',['id' => $request->vid])->with('success', 'Visa updated successfully!');
    // }
    public function hsestorevisa(Request $request)
{
    try {
        $data = $request->validate([
            'vid'         => 'required',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $visa = $this->visaRepository->updateVisa($request->vid, $data);

        return redirect()
            ->route('visa.view', ['id' => $request->vid])
            ->with('success', 'Visa updated successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        //  dd($e);
        return redirect()
            ->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('active_tab', 'editDiv'); // Ensure the Edit tab opens on error
    }
}



    /****Visa Sub Type *****/
    public function hsViewSubtype($id)
    {
        $single_visa = VisaServices::find($id);
        $visasubTypes = VisaSubtype::where('visa_type_id', $id)->get();

        return view('superadmin.pages.visa.viewsubtype', compact('visasubTypes', 'single_visa'));
    }


    /*******-Visa Sub type Delete******/
    public function hsVisasutypdelete($id)
    {

        $visasubType = VisaSubtype::find($id); // Using find() for simplicity
 
         $visacoutnryid=$visasubType->country_type_id;
        if (!$visasubType) {
            return redirect()->back()->with('error', 'Visa Subtype not found!');
        }

        $visa_id = $visasubType->visa_type_id;
        $single_visa=VisaServices::find($visa_id);
        $visasubType->delete();

        return redirect()->route('visa.editcountry', ['id' => $visacoutnryid])
            ->with('success', 'Visa subtype deleted successfully!');
    }

    public function hseditSubtype($id){

        $visasubType = VisaSubtype::find($id); // Using find() for simplicity
 
        if (!$visasubType) {
            return redirect()->back()->with('error', 'Visa Subtype not found!');
        }
  
        return view('superadmin.pages.visa.editvisasubtype',compact('visasubType'));
    }

    /****Update sub type *** */
    public function hsupdateSubTypeStore(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'visasubtypeid' => 'required|integer|exists:visa_subtypes,id',
            'subtypename'   => 'required|string|max:255',
            'validity'      => 'required|string|max:100',
            'processing'    => 'required|string|max:100',
            'subtypeprice'  => 'required|numeric|min:0',
            'commission'    => 'required|numeric|min:0|max:100',
            'gstin'         => 'required|numeric|min:0|max:100',
        ]);
    
        // Find the VisaSubtype record
        $visasubtype = VisaSubtype::find($request->visasubtypeid);
    
        // Update if found
        if ($visasubtype) {
            $visasubtype->update([
                'name'        => $request->subtypename,
                'price'       => $request->subtypeprice,
                'commission'  => $request->commission,
                'validity'    => $request->validity,
                'processing'  => $request->processing,
                'gstin'       => $request->gstin,
            ]);
    
            return redirect()
                ->route('visa.editcountry', ['id' => $visasubtype->country_type_id])
                ->with('success', 'Visa subtype updated successfully!');
        }
    
        // If not found, redirect with error
        return redirect()
            ->back()
            ->with('error', 'Visa subtype not found.');
    }
    

    /******VIsa country get *****/
    public function hsvisacoutnry(Request $request){
 
        //   dd($request->all());
       
        $countries=Country::get();
        $applyCountires= $this->visaRepository->allVisacoutnry($request);
        $visas=VisaServices::get();
        
        return view('superadmin.pages.visa.visacoutnry',compact('applyCountires','countries','visas'));
    }

    /****Delete Visa**** */
    public function destroy($id)
    {
        $this->visaRepository->deleteVisa($id);
        return response()->json(['message' => 'Visa deleted successfully']);
    }

/****View Visa Coutnry *****/
public function hsViewEditSection($id){
    $sectedcountry=$this->visaRepository->getVisabySearchcoutnry($id);
  
   return view('superadmin.pages.visa.addsection.viewassignvisa',compact('sectedcountry'));
}
    


    public function hseditvisacoutnry($id){
       
        $eid=$id;
        $sectedvisa=$this->visaRepository->getVisabySearchcoutnry($id);

  
        $countries=Country::get();
        $visa=VisaServices::get();
    
       return view('superadmin.pages.visa.editassignvisa',compact('sectedvisa','eid','countries','visa'));

    }

    public function him_payment($id){

        $sectedvisa=$this->visaRepository->getVisabySearchcoutnry($id);
        $orgin=$sectedvisa->origin;
        $destination=$sectedvisa->destination;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);

        $status="true";
        // dd($visas);
          $agency = $this->agencyService->getAgencyData();
        //   dd($agency);
        if($agency==null){
            //  dd("heelo");
             return view('agencies.pages.visa.visapricesession',compact('visas','status'));
        }
        return view('superadmin.pages.visa.payment',compact('visas','status'));
    }


    /******AGency Route *******/

    /**Featch Service using ajax*****/
    public function him_getService(Request $request)
    {
        // dd($request->all());
        // $visasub = VisaSubtype::where('visa_type_id', $request->visa_type_id)->get();
        $visasub = VisaSubtype::where([
                ['visa_type_id', $request->visa_type_id],
                ['country_type_id', $request->combination],
            ])->get();
   
        $agency = $this->agencyService->getAgencyData();
      
        // $agencypart=session('agency_domain');

        // if (!$agency  &&  $agencypart) {
        //     return response()->json(['error' => 'Agency not found'], 404);
        // }
        // $balance = Balance::where('agency_id', $agency->id)->first();


        return response()->json([
            'visa_subtypes' => $visasub,
            'balance' => $balance ?? '0'
        ]);
    }

public function him_storeClientVisaRequest(Request $request)
{
    $request->validate([
        'typeof'        => 'required',
        'category'      => 'required',
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'email'         => 'required|email|max:255',
        'phone_number'  => 'required|string|max:20',
        'address'       => 'required|string|max:500',
        'city'          => 'required|string|max:255',
        'date_of_entry' => 'required|date',
    ]);

    // Fetch session data
    $session = session()->all();

    // Get agency data
    $agencyData = Agency::with('domains')
        ->whereHas('domains', function ($q) use ($session) {
            $q->where('domain_name', $session['agency_domain']);
        })
        ->first();

    // ---------------------------------------------
    // Find client ID
    // ---------------------------------------------
    $clientId = $request->client_id ?? null;

    if (!$clientId) {
        $email  = trim($request->email);
        $client = $this->agencyService->getAgencyClicntBYSearchValue($email);

        if ($client) {
            $clientId = $client->id;  // or clientuid if needed
        }
    }

    // ------------------------------------------------------
    // 🚨 DUPLICATE APPLICATION CHECK (IMPORTANT)
    // ------------------------------------------------------
    
    $alreadyApplied = RequestApplication::where('agency_id', $agencyData->id)
        ->where('client_id', $clientId) // check same client
        ->where('status','pending') // avoid cancelled or rejected
        ->first();

    if ($alreadyApplied) {
        return back()->withErrors([
            'error' => 'You already applied this Visa Application. Kindly Contact You admin.'
        ])->withInput();
    }

    // -------------------------------------------------------

    $data = [
        'service_type'   => 'Visa',
        'agency_id'      => $agencyData->id ?? null,
        'country_id'     => $request->selectionid ?? 0,
        'client_id'      => $clientId,
        'visa_id'        => $request->typeof,
        'visa_subtype'   => $request->category,
        'first_name'     => $request->first_name,
        'last_name'      => $request->last_name,
        'full_name'      => $request->first_name . ' ' . $request->last_name,
        'email'          => $request->email,
        'phone_number'   => $request->phone_number,
        'nationality'    => $request->nationality,
        'zipcode'        => $request->zip_code,
        'address'        => $request->address,
        'city'           => $request->city,
        'date_of_entry'  => $request->date_of_entry,
        'status'         => 'pending',
    ];

    RequestApplication::create($data);

    return redirect()->route('visa.thank-you');
}


    /*******Visa BOoking *******/

public function hsVisaBook(Request $request)
{

     $messages = [
        'applicant_type.required' => 'Please select at least one applicant type.',
        'applicant_type.min' => 'At least one applicant type must be selected (Self or Family).',
         'clientId.required'       => 'Kindly select the user.',
    ];
    $data = $request->validate([
        'origin'        => 'required|integer|exists:countries,id',
        'destination'   => 'required|integer|exists:countries,id',
        'typeof'        => 'required|integer|exists:visa_types,id',
        'category'      => 'required|integer|exists:visa_subtypes,id',
        'dateofentry'   => 'required|date|after_or_equal:today',
        'clientId'      => 'required|integer',
        'applicant_type'   => 'required|array|min:1',   // ✅ Must be array & min one selected
        'applicant_type.*' => 'in:self,family',         // ✅ Each checkbox value allowed
    ],$messages);


    // Get the current user (assumes client is authenticated)
        $agency = $this->agencyService->getAgencyData();
    // Check for existing pending application
  

    $existing = VisaBooking::where('client_id', $request->clientId)
        ->where('agency_id', $agency->id)
        ->where('payment_status', 'Pending')
        ->first();
  

    if ($existing) {
        $this->error('You have already applied for a visa. Kindly check your pending application or wait for approval.');
        return redirect()->back();
    }

    // Proceed to book visa
    $booking = $this->visaRepository->saveBooking($request->all());

    if (!$booking) {
        return redirect()->back()->with('error', 'Visa booking failed. Please try again.');
    }

    return redirect()
        ->route('verify.application', ['id' => $booking->id])
        ->with('success', 'Booking successful. Please verify your application.');
}






    public function hs_verifyapplication($id){
        $agency = $this->agencyService->getAgencyData();
        $checkuser = $this->visaRepository->bookingDataById($id);

        if (isset($checkuser) && $checkuser->agency_id == $agency->id) {
            $clientData = $this->visaRepository->bookingDataById($id);
          

            // $checkBalance = $this->visaRepository->checkBalance($agency->id,$clientData->id);
            $checkBalance=$this->visaRepository->checkBalance($agency->id,$clientData->total_amount);
     
            if($clientData->isamendment==1){
                       $amendmentHistory = AmendmentHistory::where('application_id', $clientData->id)
                ->where('agency_id', $agency->id)
                ->latest()  // Orders by created_at (or updated_at if you specify)
                ->first();
              return view('agencies.pages.amendment.visa-fifth-step',compact('clientData','checkBalance','amendmentHistory'));
            }
            return view('superadmin.pages.visa.verifyapplication',compact('clientData','checkBalance'));
        }
        return redirect()->route('agency.application', ['type' => 'all']);
    }


    // pay

    public function him_visaApplicationPay(Request $request, $id){

      
        $request->validate([
            'bookingid'    => 'required',
        ]);
   
        // dd($request->all());
        $agency = $this->agencyService->getAgencyData();
      
        
        // All members are now automatically included, no need for checkbox logic
        $this->visaRepository->updateClientBooking($id,$request->all());
  
        $clientData = $this->visaRepository->bookingDataById($id);
            $termconditon = app(\App\Repositories\TermConditionRepository::class)->allTeamTypes();

        if (isset($clientData) && $clientData->agency_id == $agency->id) {
            // $pay=$this->visaRepository->payment($clientData);
            // dd($clientData);
            // Mail::to($clientData->clint->email)->send(new VisaBookingInProcessMail($clientData, $agency));
            // return redirect()->back()->with('success', 'Visa application confirmed successfully.');

            return view('agencies.pages.invoices.visainvoice',compact('clientData','termconditon'));
        }
        // return redirect()->back()->with('error', 'Unable to confirm application.');
        return view('agency.pages.visa.payment',compact('clientData'));
       }



       /*******Visa Application form *******/
        public function hs_visaApplication($type,Request $request){
 
   
              // dd("here");
        /***Ger Agency Rerod in the Visa Application ****/
        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            return redirect()->route('agency.application', ['type' => 'all'])->with('error', 'Agency session not found. Please login again.');
        }
        
        $allbookings = $this->visaRepository->getBookingByid($agency->id,$type,$request);
        $countries=Country::get();
      
     
        return view('superadmin.pages.visa.visaApplication', compact('allbookings','countries'));
 
 
    }


    public function hsVisaDocumentpending(){
        return view('superadmin.pages.visa.payment',compact('visas'));
    }


      /*****Visa View *****/
      public function hsVisaVisa($id){
        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            return redirect()->route('agency.application', ['type' => 'all'])->with('error', 'Agency session not found. Please login again.');
        }
        
        $checkuser = $this->visaRepository->bookingDataById($id);

        if (isset($checkuser) && $checkuser->agency_id == $agency->id) {
        $clientData = $this->visaRepository->bookingDataById($id);
        // dd($clientData);
        // dd($clientData);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();
        $termconditon = TermType::with([
            'terms' => function ($q) {
                $q->where('display_invoice', 1);
            },
        ])->get();
        // dd($clientData);

        return view('superadmin.pages.visa.viewvisaapplication',compact('clientData','forms','termconditon'));
        }
        return redirect()->route('agency.application', ['type' => 'all']);

    }



      /*****View Client Form  View *****/
    public function viewForm($formname,$id)
    {
        // Try to get agency data, but don't fail if it's not available (for client users)
        $agency = $this->agencyService->getAgencyData();
        
        $checkuser = $this->visaRepository->bookingDataById($id);
        $clientData = $this->visaRepository->bookingDataById($id);
        
        if (!$clientData) {
            return redirect()->back()->with('error', 'Application not found.');
        }
        
        // If agency data is available, check authorization
        if ($agency && isset($checkuser->agency_id) && $checkuser->agency_id != $agency->id) {
            return redirect()->route('agency.application', ['type' => 'all'])->with('error', 'You are not authorized to access this application.');
        }
        
        $origin_id = $clientData->origin_id;
        $destination_id = $clientData->destination_id;
        $forms = VisaServiceTypeDocument::with('from')
            ->where('origin_id', $origin_id)
            ->where('destination_id', $destination_id)
            ->get();

        // Map the slug to the actual form filename
        $formMapping = [
            'visadepartment' => 'VisaDepartment',
            'letterofauthorisation' => 'LetterofAuthorisation',
            'selfdeclarationform-4' => 'SelfDeclarationForm-4',
            'form-no-10-certificate-to-carry-crem' => 'Form No. 10 - Certificate to Carry Crem',
            'affidavit' => 'Affidavit',
            'annexure-c' => 'Annexure-c',
            'annexure-d' => 'annexure-d',
            'annexure-dform' => 'annexure-dform',
            'annexure-e' => 'Annexure-e',
            'annexure-f' => 'Annexure-f',
            'beijing-form' => 'beijing-form',
            'ppform' => 'ppform',
            'additional' => 'additional',
            'specimenaffidavit' => 'specimenaffidavit',
            'tatkalundertaking' => 'tatkalundertaking',
            'srilankannationals-additionalforms' => 'srilankannationals-additionalforms',
            'changeofappearance-minor' => 'changeofappearance-minor',
            'declarartionform' => 'declarartionform',
            'lossofpassport-formno03' => 'lossofpassport-formno03'
        ];
        
        $actualFormName = $formMapping[$formname] ?? $formname;
        
        // Check if the view file exists
        if (!view()->exists("forms.$actualFormName")) {
            return redirect()->back()->with('error', "Form '$actualFormName' not found.");
        }

        return view("forms.$actualFormName", compact('clientData', 'forms'));
    }




    /****Edit Visa application *****/
    public function hsEditVisaApplication($id){

        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            return redirect()->route('agency.application', ['type' => 'all'])->with('error', 'Agency session not found. Please login again.');
        }
        
        $clientData = $this->visaRepository->bookingDataById($id);

        if (isset($clientData) && $clientData->agency_id == $agency->id) {
            $origin_id=$clientData->origin_id;
            $destination_id=$clientData->destination_id;
            $forms=VisaServiceTypeDocument::with('from')->
            where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();
            return view('superadmin.pages.visa.editvisaapplication',compact('clientData','forms'));
        }
        return redirect()->route('agency.application', ['type' => 'all']);


    }




    /******Form Function *******/
public function hsFromindex(Request $request)
{
    //  dd($request->all());
    $countries = Country::all();

    $query = Document::with('countries');

    if ($request->filled('search')) {
    $search = $request->search;
    $query->where(function ($q) use ($search) {
        $q->where('form_name', 'like', "%{$search}%")
          ->orWhere('form_description', 'like', "%{$search}%");
    });
    }

    if ($request->filled('origin_id') && $request->filled('destination_id')) {
        $originId = $request->origin_id;
        $destinationId = $request->destination_id;

        $query->whereHas('countries', function ($q) use ($originId, $destinationId) {
            // Adjust this condition based on how origin_id and destination_id relate to your 'countries' relation
            $q->where('origin_id', $originId)
              ->where('destination_id', $destinationId);
        });
    }


    // Per page or default 10
    $perPage = $request->get('per_page', 10);

    // Get paginated result
    $forms = $query->paginate($perPage);

    // Pass to view
    // dd($forms);
    return view('superadmin.pages.visa.form', compact('countries', 'forms'));
}



    /*****Form Store ******/

    public function hsFromStore(Request $request){
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'origincoutnry' => 'required|integer',
            'destination' => 'required|integer',
            'description' => 'nullable', // Fixed spelling & added comma
            'form_upload' => 'file|mimes:pdf|max:2048' // Allow only PDFs, max 2MB
        ]);
        // dd('hello');


        $forms = $this->visaRepository->storeForms($request->all());
        // dd($forms);
        return redirect()->route('visa.forms')->with('success', 'Booking successful');
    }


    /*****Form Delete ******/
    public function hsFormDelete($id){
        $form = $this->visaRepository->deleteForm($id);
        return redirect()->route('visa.forms')->with('success', 'Deleted Successfully');
    }


        /*****Form Assign form to coutnry ******/
    public function hsAssignCountry($id){
        $countries=Country::get();
        $form = $this->visaRepository->findFormById($id);
        return view('superadmin.pages.visa.assignfrom',compact('countries','form'));
    }




   /*****Form Store assign coutnry  ******/
    public function hsAssignCountrystore(Request $request){
        $data = $request->validate([
            'form_id'=>'required|integer',
            'origincoutnry' => 'required|integer',
            'destination' => 'required|integer',
        ]);
        $forms = $this->visaRepository->assignCountrytoForms($request->form_id,$request->all());
        return redirect()->route('visa.forms')->with('success', 'Country Assigned Successfully');


    }


    /*****View Assign country which form*** */
    public function hsViewCountry($id){
        $forms = $this->visaRepository->viewCoutnryFormById($id);
            //  dd($forms);
              return view('superadmin.pages.visa.viewcoutnrynfrom',compact('forms'));

    }

    public function hsFromDisConnectCountry($id){
        $forms = $this->visaRepository->disConnectCoutnryFormById($id);
        if($forms){
            return redirect()->route('visa.forms')->with('success', 'Form is DisConnected Successfully');
        }
    }

    /*****Update Application ******/
    public function hsupdateapplication(Request $request)
{


    if ($request->application_status =='Complete') {




        $application = ClientApplicationDocument::where('application_id',$request->applciationid) 
        ->whereIn('document_status', [0, 2, 3])
        ->first();
  
        if ($application) {
            return redirect()
                ->route('superadminvisa.applicationview', ['id' => $request->applciationid])
                ->with('error', 'Document Status is Pending Yet. Please Change the Document Status');
        }
    }


    if (isset($request->type) && $request->type === 'superadmin') {
        $data = $request->validate([
                        'applciationid' => 'required', // Ensure ID exists in the applications table
                    
                    ]);

        $booking = VisaBooking::find($request->applciationid);
        $original = $booking->only([
            'paymentstatus',
            'document_status',
            'application_status',
            'description',
            'rejection_reason',
        ]);

        // Now update the booking
        $updatedBooking = $this->visaRepository->assignUpdateBooking($request->applciationid, $request->all());


        $changes = [];
        foreach ($original as $key => $value) {
            if ($updatedBooking->$key !== $value) {
                $changes[] = ucfirst(str_replace('_', ' ', $key)) . " changed from '$value' to '" . $updatedBooking->$key . "'";
            }
        }

        $description = count($changes) ? implode('; ', $changes) : 'No changes made';

        // Save log with details of what was changed
        $this->agencyService->saveLog($updatedBooking, 'Super Admin', 'Finish Application', Auth::id(), $description);

        // Mail::to($updatedBooking->agency->email)->send(new DocumentDownloadedNotificationMail($updatedBooking));

     
        return redirect()->route('superadminview.allapplication');
    }

      
   }


   /*****Prepare Email *******/
   public function hsPreparedEmail($id){
    $agency = $this->agencyService->getAgencyData();
    $clientData = $this->visaRepository->bookingDataById($id);

    if (isset($clientData) && $clientData->agency_id == $agency->id) {
        return view('superadmin.pages.visa.sendemailfrom',compact('clientData'));
   }
   return redirect()->route('agency.application', ['type' => 'all']);
   }


   /*******Send Email for Client ******/
   public function hsSendEmail(Request $request){

    $agency = $this->agencyService->getAgencyData();
    $clientData = $this->visaRepository->bookingDataById($request->visa_id);

    if (isset($clientData) && $clientData->agency_id == $agency->id) {
    $request->validate([
        'emailid' => 'required|email',
        'visa_id' => 'required|integer',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'formupload' => 'nullable|mimes:pdf|max:10240',
    ]);

    $clientData = $this->visaRepository->sendEmail($request->all(),$agency);


     }
    return redirect()->route('agency.application', ['type' => 'all']);

   }

   /*******Delete Application ******/
   public function hsDeleteApllication($id){
    $action = $this->visaRepository->deleteBooking($id);
    if(isset($action))
    return redirect()->route('agency.application', ['type' => 'all']);

   }



   /***Send For super admin ****/
   public function hsSendAdmin($id){

   
    $bookingData = $this->visaRepository->sendToAdmin($id);
    // dd($bookingData);
    return redirect()->route('agency.application', ['type' => 'all']);
   }



   public function hsfillApplication(Request $request, $type,$id, $token)
   {

        $agency = $this->agencyService->getAgencyData();
       $bookingData = $this->visaRepository->bookingDataById($id);
    //    dd($bookingData);
   
       $countries = Country::all();
       
   
       if($bookingData->viewed_once==1){

        if($agency==null){
           return redirect()->route('verifyvisa.application', [
            'id' => $id,
            'type' => 'client' // or use 'admin' if needed
        ]);
        }
        else{
            return redirect()->route('verifyvisa.application', [
                'id' => $id,
                'type' => 'agency' // or use 'admin' if needed
            ]);
        }
       }
       $sections = VisaSection::all();

       if($type == 'agencies'){
            return view('agencies.pages.clients.clientapplication', compact('agency', 'bookingData','sections','countries'));
       }
       else {
          
           return view('clients.pages.clients.clientapplication', compact('agency', 'bookingData','sections','countries'));
       }
   
   
       }
   
 public function hs_VisaStoreAjax(Request $request){
    // dd($request->all());s
  
    $this->visaRepository->visadocumentstore($request->all());

    // Return JSON response
    return response()->json([
        'status' => 'success',
        'preview'=>$request->previewstep,
        'step' => $request->step
    ]);
    // $this->visaRepository->storeVisa($request->all(),$request->file
 }






public function hsconfirmApplication(Request $request)

{
  
  
    $booking = $this->visaRepository->bookingDataById($request->bookingid);

    $newData = $request->all();

    $updateBooking = $this->visaRepository->createApplicationLog($booking, $newData);

    
    // Step 3: Save updates
    $this->clintRepository->step1createclient($newData);
    $this->visaRepository->visadocumentstore($newData);
//   dd($request->all());
    // Step 4: Auto insert missing documents
    $checkDocument = VisaServiceType::where('origin', $booking->origin_id)
        ->where('destination', $booking->destination_id)
        ->where('visa_id', $booking->visa_id)
        ->first();

    if ($checkDocument) {
        $documents = json_decode($checkDocument->required_document, true);

        if (is_array($documents)) {
            foreach ($documents as $docName) {
                $exists = \App\Models\ClientApplicationDocument::where('application_id', $booking->id)
                    ->where('document_name', $docName)
                    ->exists();

                if (!$exists) {
                    \App\Models\ClientApplicationDocument::create([
                        'application_id' => $booking->id,
                        'application_number' => $booking->application_number,
                        'agency_id' => $booking->agency_id,
                        'document_name' => $docName,
                        'document_status' => 0,
                    ]);
                }
            }
        }
    }


    // Step 5: Update application flag
    // dd($booking);
    $booking->sendtoadmin = 3;
    $booking->save();

    // Step 6: Redirect
    if ($request->type === 'superadmin') {
        
    $booking->sendtoadmin = 1;
    $booking->save();
        return redirect()->route('superadminvisa.applicationview', ['id' => $request->bookingid]);
    } elseif ($request->type === 'client') {
        return redirect()->route('client.application.view', ['id' => $request->bookingid]);
    }

    return redirect()->route('visa.applicationview', ['id' => $request->bookingid]);
}







 public function hs_veriryvisaapplication($id, $type)
{
   
    $bookingData = $this->visaRepository->bookingDataById($id);
    $countries=Country::get(); 

    // ✅ First-time view: set flag and redirect to self

    if (!$bookingData->viewed_once) {
        $bookingData->update(['viewed_once' => true]);
        return redirect()->route('verifyvisa.application', ['id' => $id, 'type' => $type]);
    }

    // ✅ If type is client, redirect to the client application view instead
    if ($type === 'client') {
        return redirect()->route('client.application.view', ['id' => $id]);
    }

    // ✅ Load correct view based on type
    $view = $type === 'agency'
        ? 'superadmin.pages.visa.veriryvisaapplication'
        : 'superadmin.pages.visa.superadminveriryvisaapplication';

    return view($view, compact('bookingData', 'type','countries'));
}



public function showFromInvoice($id)
{
    $booking = VisaBooking::with(['agency', 'clint', 'visa', 'visaInvoiceStatus', 'visaInvoiceStatus.docsign.sign'])->findOrFail($id);
    $termconditon = $this->termConditionRepo->allTeamTypes();

    return view('components.common.invoice.Superadminvisa-invoice', compact('booking', 'termconditon'));
}

// VisaController.php

public function showVisaApplicationLogs()
{
    // Fetch VisaApplicationLog data (can be paginated if needed)
    $logs = \App\Models\VisaApplicationLog::paginate(10); // Paginate 10 logs per page (adjust if necessary)



    // Return the view with logs
    return view('components.common.visalog', compact('logs'));
}

/**
 * Handle client application submission
 * Client can fill application but cannot send to admin
 * Only agency can send to admin
 */
public function hsClientSubmitApplication(Request $request)
{
    try {
        $request->validate([
            'booking_id' => 'required|exists:visabookings,id',
            'application_data' => 'required|array'
        ]);

        $booking = $this->visaRepository->bookingDataById($request->booking_id);
        
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        // Check if client is authorized to submit for this booking
        $agency = $this->agencyService->getAgencyData();
        if (!$agency || $booking->agency_id != $agency->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Store the application data
        $applicationData = $request->application_data;
        
        // Update client details if provided
        if (isset($applicationData['client_details'])) {
            $this->clintRepository->updateClientDetails($booking->client_id, $applicationData['client_details']);
        }

        // Store visa application data
        $this->visaRepository->storeClientApplicationData($request->booking_id, $applicationData);

        // Update booking status to indicate client has filled application
        $booking->update([
            'sendtoadmin' => 2, // 2 = Client filled, waiting for agency review
            'client_filled_at' => now(),
            'client_filled_by' => 'client'
        ]);

        // Log the action
        $this->agencyService->saveLog(
            $booking, 
            'client', 
            'Client filled application', 
            $booking->client_id
        );

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully. Agency will review and send to admin.',
            'redirect' => route('client.application.view', ['id' => $request->booking_id])
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to submit application: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Get family members for a specific client
 */
public function hsGetClientFamilyMembers($clientId)
{
    try {
        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            return response()->json(['error' => 'Agency not found'], 404);
        }

        // Get client details to verify ownership
        $client = ClientDetails::on('user_database')
            ->where('id', $clientId)
            ->where('agency_id', $agency->id)
            ->first();

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        // Get family members
        $familyMembers = FamilyMember::on('user_database')
            ->where('client_id', $clientId)
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'first_name' => $member->first_name,
                    'last_name' => $member->last_name,
                    'relationship' => $member->relationship,
                    'date_of_birth' => $member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : null,
                    'nationality' => $member->nationality,
                    'passport_number' => $member->passport_number,
                    'passport_issue_date' => $member->passport_issue_date ? $member->passport_issue_date->format('Y-m-d') : null,
                    'passport_expiry_date' => $member->passport_expiry_date ? $member->passport_expiry_date->format('Y-m-d') : null,
                    'email_address' => $member->email_address,
                    'phone_number' => $member->phone_number,
                ];
            });

        return response()->json([
            'success' => true,
            'family_members' => $familyMembers
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to fetch family members: ' . $e->getMessage()
        ], 500);
    }
}






public function saveRemark(Request $request)
{

   
   $request->validate([
        'id'     => 'required|integer',   // or 'required|integer' if editing always
        'remark' => 'required|string|max:500',
        'type'   => 'required|in:client,agency'
    ]);

    if($request->type=='client'){
                 
           VisaBooking::updateOrCreate(
                ['id' => $request->id],
                ['client_remark' => $request->remark]
            );
    }
 

    return response()->json([
        'message' => 'Remark saved successfully!'
    ]);
}




}
