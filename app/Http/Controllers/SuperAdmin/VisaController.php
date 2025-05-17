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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Traits\ChatTrait;



class VisaController extends Controller
{
    use ChatTrait;

    protected $visaRepository;
    protected $agencyService;

    public function __construct( VisaRepositoryInterface $visaRepository, AgencyService $agencyService) {
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;

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
    public function hs_visaAllApplication(){
        $allbookings = $this->visaRepository->getSuperadminAllApplication();

        return view('superadmin.pages.visa.superadminallapplication', compact('allbookings'));
    }

    /***View single Application of  ****/
    public function hs_editSAApplication($id){

        $clientData = $this->visaRepository->bookingDataById($id);
        return view('superadmin.pages.visa.superadmineditapplication',compact('clientData'));
    }

    public function hs_viewSAApplication($id){


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


      /***Store Visa Data *****/
    public function hsStore(Request $request)
    {

        $data = $request->validate([
            'name'         => 'required|string|max:255|unique:visa_types,name',
            'description'  => 'nullable|string', // Allows HTML content (Quill Editor)
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

        if (!$visasubType) {
            return redirect()->back()->with('error', 'Visa Subtype not found!');
        }

        $visa_id = $visasubType->visa_type_id;
        $single_visa=VisaServices::find($visa_id);
        $visasubType->delete();

        return redirect()->route('visa.viewsubtype', ['id' => $visa_id])
            ->with('success', 'Visa subtype deleted successfully!');
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


    /******AGency Route *******/

    /**Featch Service using ajax*****/
    public function him_getService(Request $request)
    {

        $visasub = VisaSubtype::where('visa_type_id', $request->visa_type_id)->get();

        // $visasub = VisaSubtype::where('visa_type_id', $request->visa_type_id)->get();
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

    public function him_visaApplicationPay($id){
        $agency = $this->agencyService->getAgencyData();
        $clientData = $this->visaRepository->bookingDataById($id);
        if (isset($clientData) && $clientData->agency_id == $agency->id) {
            $pay=$this->visaRepository->payment($clientData);
            return view('agencies.pages.invoices.visainvoice',compact('clientData'));
        }
        return view('agency.pages.visa.payment',compact('clientData'));
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


    /*****Form Delete ******/
    public function hsFormDelete($id){
        $form = $this->visaRepository->deleteForm($id);
        return redirect()->route('visa.forms')->with('success', 'Booking successful');
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
        return redirect()->route('visa.forms')->with('success', 'Booking successful');


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
            return redirect()->route('visa.forms')->with('success', 'Booking successful');
        }
    }

    /*****Update Application ******/
    public function hsupdateapplication(Request $request){


        if (isset($request->type) && $request->type === 'superadmin') {
            $data = $request->validate([
                'applciationid' => 'required', // Consider adding: |exists:applications,id
                'paymentstatus' => 'in:Paid,Pending',
                'document_status' => 'in:Pending,Handed Over',
                'application_status' => 'required|in:Under Process,Pending,Complete,Rejected',
                'description' => 'nullable|string',
            ]);

            $forms = $this->visaRepository->assignUpdateBooking($request->applciationid, $request->all());

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
    return redirect()->route('agency.application', ['type' => 'all']);
   }






}
