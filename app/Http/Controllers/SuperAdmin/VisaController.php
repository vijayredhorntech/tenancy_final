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
use App\Models\Agency;
use App\Models\VisaServiceTypeDocument;
use App\Services\AgencyService;
use App\Models\Balance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Repositories\Interfaces\ClintRepositoryInterface;
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

use App\Models\ClientInfoForCountry;

class VisaController extends Controller
{
    use ChatTrait;

    protected $visaRepository,$clintRepository;
    protected $agencyService;

    public function __construct( ClintRepositoryInterface $clintRepository,VisaRepositoryInterface $visaRepository, AgencyService $agencyService) {
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
        $this->clintRepository = $clintRepository;


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
        
        $clientData = $this->visaRepository->bookingDataById($id);
        // dd($clientData);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();
        return view('superadmin.pages.visa.superadminviewapplication',compact('clientData','forms'));
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


    // public function hsrequiredClientFiled($id)
    // {
    //     // dd($id);
        
    //     $visadetails=VisaServiceType::with('destinationcountry','VisaServices')->where('id',$id)->first();
    //     $client = ClientDetails::first();
    //     $clientMore = ClientMoreInfo::first();
    //     $assign = ClientInfoForCountry::where('assignid', $visadetails->id)->first();

    
    //     // Combine both tables' data
    //     $combined = array_merge(
    //         $client ? $client->toArray() : [],
    //         $clientMore ? $clientMore->toArray() : []
    //     );
    
    
    //     // Keep only these permission fields
    //     $allowed = [
    //         'personal_details_permission',
    //         'other_details_permission',
    //         'address_permission',
    //         'passport_details_permission',
    //         'additional_passport_info_permission',
    //         'family_details_permission',
    //         'wife_details_permission',
    //         'occupation_details_permission',
    //         'armed_force_details_permission',
    //         'citizenship_id',
    //        'children_permission',
    //         'educational_qualification',
    //         'identification_marks',
    //         'nationality',    
    //     ];
  
    //     $combined = collect($combined)
    //         ->filter(function ($value, $key) use ($allowed) {
    //             return in_array($key, $allowed);
    //         })
    //         ->toArray();
    //     //    dd($combined);
    //     return view('superadmin.pages.visa.assigncountry', compact('combined','visadetails','assign'));
    // }
    
    public function hsrequiredClientFiled($id)
    {
        $visadetails = VisaServiceType::with('destinationcountry', 'VisaServices')->where('id', $id)->first();
        // dd($visadetails);
        // $assign = ClientInfoForCountry::where('assignid', $visadetails->id)->first();
        $assign = ClientInfoForCountry::where('destination_id', $visadetails->destinationcountry->id)->first();

    
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
        // dd($groupedFields);
    
       // For debugging
        // dd($groupedFields); // For debugging
    
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
       return redirect()->route('visa.country')->with('success', 'Visa created successfully');
    
   }
      /***Store Visa Data *****/
  
  
      public function hsStore(Request $request)
     {

        $data = $request->validate([
            'name'         => 'required|string|max:255|unique:visa_types,name',
            'description'  => 'nullable|string', // Allows HTML content (Quill Editor)
            // 'subtype'      => 'required|array|min:1',
            // 'subtype.*'    => 'string|max:255', // Each subtype should be a string
            // 'subtypeprice' => 'required|array|min:1',
            // 'subtypeprice.*' => 'numeric|min:0', // Each price must be a number and positive
            // 'commission'   => 'required|array|min:1',
            // 'commission.*' => 'numeric|min:0', // Each commission should be 0-100%
            // 'validity'      => 'required|array|min:1',
            // 'validity.*'    => 'string|max:255',
            // 'processing'      => 'required|array|min:1',
            // 'processing.*'    => 'string|max:255',
            // 'gstin'   => 'required|array|min:1',
            // 'gstin.*' => 'numeric|min:0',
        ]);

        // Store Visa Data Using Repository
        $visa = $this->visaRepository->createVisa($data);
        
        return redirect()->route('visa.view')->with('success', 'Visa created successfully');
    }


    public function hsViewdelete($id){
        $visa = $this->visaRepository->deleteVisa($id);
        return redirect()->route('visa.view')->with('success', 'Visa Deleted successfully');
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

        return redirect()->route('visa.view')->with('success', 'Visa created successfully');

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
        $data = $request->validate([
            'origincountry'     => 'required',
            'destinationcountry'       => 'required',
        ]);

        $orgin=$request->origincountry;
        $destination=$request->destinationcountry;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
        $countries=Country::get();
        
        return view('superadmin.pages.visa.viewsearchvisa',compact('visas','countries','orgin','destination'));
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
    public function hsvisacoutnry(){

        $visas= $this->visaRepository->allVisacoutnry();
        // dd($visas);
        return view('superadmin.pages.visa.visacoutnry',compact('visas'));
    }

    /****Delete Visa**** */
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
    
       return view('superadmin.pages.visa.editassignvisa',compact('sectedvisa','eid','countries','visa'));

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


    /******AGency Route *******/

    /**Featch Service using ajax*****/
    public function him_getService(Request $request)
    {
        // dd($request->all());
        // $visasub = VisaSubtype::where('visa_type_id', $request->visa_type_id)->get();
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
            'phonenumber'   => 'required|numeric', // Ensures phone number is reasonable

            'dateofentry'   => 'required|date|after_or_equal:today', // Ensures it's a valid date and not in the future
        ]);

        $visas = $this->visaRepository->saveBooking($request->all());
        // dd($visas);
        return redirect()->route('verify.application', ['id' => $visas->id])
        ->with('success', 'Booking successful');
    }






    public function hs_verifyapplication($id){
        $agency = $this->agencyService->getAgencyData();
        $checkuser = $this->visaRepository->bookingDataById($id);

        if (isset($checkuser) && $checkuser->agency_id == $agency->id) {
            $clientData = $this->visaRepository->bookingDataById($id);
           
            // $checkBalance = $this->visaRepository->checkBalance($agency->id,$clientData->id);
            $checkBalance=$this->visaRepository->checkBalance($agency->id,$clientData->total_amount);
            // dd($checkBalance);
            return view('superadmin.pages.visa.verifyapplication',compact('clientData','checkBalance'));
        }
        return redirect()->route('agency.application', ['type' => 'all']);
    }


    // pay

    public function him_visaApplicationPay(Request $request, $id){
        $request->validate([
            'bookingid'    => 'required',
            'selfapply'    => 'required_without:othermember',
            'othermember'  => 'required_without:selfapply|array',
        ]);
   
        $agency = $this->agencyService->getAgencyData();
         if(isset($request->selfapply)){
            $this->visaRepository->updateClientBooking($id,$request->all());
         }else{
              $this->visaRepository->createClientBooking($id,$request->all());
           
         }

        $clientData = $this->visaRepository->bookingDataById($id);
        if (isset($clientData) && $clientData->agency_id == $agency->id) {
            // $pay=$this->visaRepository->payment($clientData);
            // dd($clientData);
            Mail::to($clientData->clint->email)->send(new VisaBookingInProcessMail($clientData, $agency));

            return view('agencies.pages.invoices.visainvoice',compact('clientData'));
        }
        return view('agency.pages.visa.payment',compact('clientData'));
       }



       /*******Visa Application form *******/
    public function hs_visaApplication($type,Request $request){


        /***Ger Agency Rerod in the Visa Application ****/
        $agency = $this->agencyService->getAgencyData();
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
        $checkuser = $this->visaRepository->bookingDataById($id);

        if (isset($checkuser) && $checkuser->agency_id == $agency->id) {
        $clientData = $this->visaRepository->bookingDataById($id);
        // dd($clientData);
        $origin_id=$clientData->origin_id;
        $destination_id=$clientData->destination_id;
        $forms=VisaServiceTypeDocument::with('from')->
        where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();

        return view('superadmin.pages.visa.viewvisaapplication',compact('clientData','forms'));
        }
        return redirect()->route('agency.application', ['type' => 'all']);

    }



      /*****View Client Form  View *****/
    public function viewForm($formname,$id)
    {
        $agency = $this->agencyService->getAgencyData();
        $checkuser = $this->visaRepository->bookingDataById($id);

            $clientData = $this->visaRepository->bookingDataById($id);
            // dd($clientData);
            // dd($clientData);
            $origin_id=$clientData->origin_id;
            $destination_id=$clientData->destination_id;
            $forms=VisaServiceTypeDocument::with('from')->
            where('origin_id',$origin_id)->where('destination_id',$destination_id)->get();


            return view("forms.$formname",compact('clientData','forms')); // Use double quotes or concatenation


    }




    /****Edit Visa application *****/
    public function hsEditVisaApplication($id){

        $agency = $this->agencyService->getAgencyData();
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
    public function hsupdateapplication(Request $request){


        if (isset($request->type) && $request->type === 'superadmin') {
            $data = $request->validate([
                'applciationid' => 'required', // Consider adding: |exists:applications,id
                'paymentstatus' => 'in:Paid,Pending',
                'document_status' => 'in:Pending,Done',
                'application_status' => 'required|in:Under Process,Pending,Complete,Rejected',
                'description' => 'nullable|string',
            ]);

            $booking = $this->visaRepository->assignUpdateBooking($request->applciationid, $request->all());
          $save=$this->agencyService->saveLog($booking,'Super Admin','Finish Application', Auth::id(), $request->application_status);

            // dd($booking->agency->name);
            Mail::to($booking->agency->email)->send(new DocumentDownloadedNotificationMail($booking));
            // dd($booking);
            return redirect()->route('superadminview.allapplication');
        }

        $agency = $this->agencyService->getAgencyData();
        $clientData = $this->visaRepository->bookingDataById($request->applciationid);

        if (isset($clientData) && $clientData->agency_id == $agency->id) {
            $data = $request->validate([
                'applciationid' => 'required', // Ensure ID exists in the applications table
                'paymentstatus' => 'required|in:Paid,Pending',
                'document_status' => 'required|in:Pending,Handed Over',
                'description' => 'nullable|string',
            ]);
            $forms = $this->visaRepository->assignUpdateBooking($request->applciationid,$request->all());
            // Route::get('/viewapplication/{type}', 'hs_visaApplication')->name('agency.application');
            return redirect()->route('agency.application', ['type' => 'all']);
        }
        return redirect()->route('agency.application', ['type' => 'all']);
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



   public function hsfillApplication(Request $request, $id, $token)
   {
    //    dd($id);
       $agency = $this->agencyService->getAgencyData();
       $bookingData = $this->visaRepository->bookingDataById($id);
    //    dd($bookingData);
       if($bookingData->viewed_once==1){
           return redirect()->route('verifyvisa.application', [
            'id' => $id,
            'type' => 'agency' // or use 'admin' if needed
        ]);
       }
       $sections = VisaSection::all();
   
       return view('agencies.pages.clients.clientapplication', compact('agency', 'bookingData','sections'));
   
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


 public function hsconfirmApplication(Request $request){
    //  dd($request->all());
    $this->clintRepository->step1createclient($request->all());
    $this->visaRepository->visadocumentstore($request->all());
    // $bookingData = $this->visaRepository->sendToAdmin($request->booking_id);
    if($request->type=='superadmin'){
        return redirect()->route('superadminvisa.applicationview', ['id' => $request->bookingid]);
    }else{
        $booking = VisaBooking::where('id', $request->bookingid)->first();
        $booking->sendtoadmin=3;
        $booking->save();
        // dd($bookingData);
        return redirect()->route('visa.applicationview', ['id' => $request->bookingid]);
    }


 }

 public function hs_veriryvisaapplication($id, $type)
{
    $bookingData = $this->visaRepository->bookingDataById($id);

    // ✅ First-time view: set flag and redirect to self
    if (!$bookingData->viewed_once) {
        $bookingData->update(['viewed_once' => true]);
        return redirect()->route('verifyvisa.application', ['id' => $id, 'type' => $type]);
    }

    // ✅ Load correct view based on type
    $view = $type === 'agency'
        ? 'superadmin.pages.visa.veriryvisaapplication'
        : 'superadmin.pages.visa.superadminveriryvisaapplication';

    return view($view, compact('bookingData', 'type'));
}





}
