<?php

namespace App\Http\Controllers\Agencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Services\AgencyService;
use App\Models\Country;
use App\Models\AuthervisaApplication;
use App\Models\AmendmentHistory;






class AmendmentController extends Controller
{
    //
    protected $visaRepository,$clintRepository;
    protected $agencyService;

    public function __construct( ClintRepositoryInterface $clintRepository,VisaRepositoryInterface $visaRepository, AgencyService $agencyService) {
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
        $this->clintRepository = $clintRepository;


    }

public function checkValidation($applicationNumber){

    $agencyData = $this->agencyService->getAgencyData(); 
    $applicationData = $this->visaRepository->getBookingByApplicationNumber($applicationNumber);
 
    // ✅ If application not found → throw exception
    if (!$applicationData) {
        abort(404, "Application not found for booking number: $applicationNumber");
    }

    // ✅ If agency doesn't match → throw exception
    if ($agencyData->id != $applicationData->agency_id) {
        abort(403, "This application does not belong to your agency.");
    }
    return $applicationData;
}


/****Form Application *** */
public function hsamendmentVisaApplication(Request $request)
{
    $applicationNumber = $request->query('booking'); 
    $countries=Country::get();

     $this->checkValidation($applicationNumber);
     $applicationData=$this->checkValidation($applicationNumber);

    // $formAction  = route('amendment.visa.searchresult');

    $formAction = route('amendment.visa.searchresult', ['type' => 'agencies']);



    // ✅ If everything is correct, return the view
    return view('agencies.pages.amendment.visa-first-step', compact('applicationData','countries','formAction'));
}

/***Store Application *** */
  public function hsviewSearchvisa(Request $request){

 
        // dd("Heelo");
        $data = $request->validate([
            'origincountry'     => 'required',
            'destinationcountry'       => 'required',
            'invoiceNumber' => 'required'
        ]);

         $applicationData=$this->checkValidation($request->invoiceNumber);

         $orgin=$request->origincountry;
        $destination=$request->destinationcountry;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
        $countries=Country::get();
        
        $agency = $this->agencyService->getAgencyData();

              return view('agencies.pages.amendment.visa-second-step',compact('visas','countries','orgin','destination','applicationData'));
    
       
 }


 public function hsviewAmendmentSearchvisa(Request $request){
        $id=$request->id;   
        $applicationData=$this->checkValidation($request->applicationid);

        $clientInformation=$this->agencyService->getClientinfoById($applicationData->deduction) ;
        $sectedvisa=$this->visaRepository->getVisabySearchcoutnry($id);
        $orgin=$sectedvisa->origin;
        $destination=$sectedvisa->destination;
        $visas = $this->visaRepository->getVisabySearch($orgin,$destination);
        $agency = $this->agencyService->getAgencyData();
   

        return view('agencies.pages.amendment.visa-third-step',compact('visas','clientInformation','applicationData'));
    // return view('agencies.pages.amendment.visa-first-step', compact('applicationData','countries','formAction'));
 
 }

 public function hsVisaAmendmentBook(Request $request){
     $data = $request->validate([
        'origin'        => 'required|integer|exists:countries,id',
        'destination'   => 'required|integer|exists:countries,id',
        'typeof'        => 'required|integer|exists:visa_types,id',
        'category'      => 'required|integer|exists:visa_subtypes,id',
        'applicationnumber'=> 'required|string|max:255',
        'lastname'      => 'required|string|max:255',
        'firstname'     => 'required|string|max:255',
        'citizenship'   => 'nullable|string|max:255',
        'email'         => 'required|email|max:255',
        'phonenumber'   => 'required|numeric',
        'dateofentry'   => 'required|date|after_or_equal:today',
    ]);

    // Get the current user (assumes client is authenticated)
        $agency = $this->agencyService->getAgencyData();
    // Check for existing pending application
  

    
    // Proceed to book visa
    $booking = $this->visaRepository->updateBooking($request->all());


    if (!$booking) {
        return redirect()->back()->with('error', 'Visa booking failed. Please try again.');
    }

    return redirect()
    ->route('visa.amendment.verifyapplication', ['type' => 'agencies', 'id' => $booking->id ,'applicationid'=>$booking->application_number])
    ->with('success', 'Booking successful. Please verify your application.');
    // return redirect()
    //     ->route('verify.application', ['id' => $booking->id])
    //     ->with('success', 'Booking successful. Please verify your application.');

 }

 public function hsRemoveOtherApplication(Request $request,$type,$id,$applicationid){

 
        $agency = $this->agencyService->getAgencyData();
        $applicationData=$this->checkValidation($applicationid);
        $otherApplicant=AuthervisaApplication::on('user_database')
        ->where('id', $id)
        ->where('booking_id', $applicationData->id)
        ->first();
    if ($otherApplicant) {
        $otherApplicant->forceDelete();
        return redirect()->back()->with('success', 'Application removed successfully.');
    } else {
        return redirect()->back()->with('error', 'Application not found.');
    }
        
   
 }

 public function hsShowVerifyApplication($type,$id,$applicationid){

    
        $agency = $this->agencyService->getAgencyData();
        $applicationData=$this->checkValidation($applicationid);

        $clientInformation=$this->agencyService->getClientinfoById($applicationData->deduction) ;
          $checkuser = $this->visaRepository->bookingDataById($id);

        if (isset($checkuser) && $checkuser->agency_id == $agency->id) {
            $clientData = $this->visaRepository->bookingDataById($id);
           
            // $checkBalance = $this->visaRepository->checkBalance($agency->id,$clientData->id);
            $checkBalance=$this->visaRepository->checkBalance($agency->id,$clientData->total_amount);
            // dd($clientData);
            // dd($checkBalance);
               $clientData = $this->visaRepository->bookingDataById($applicationData->id);
             $amendmentHistory = AmendmentHistory::where('application_id', $applicationData->id)
                ->where('agency_id', $agency->id)
                ->where('application_id', $clientData->id)
                ->latest()  // Orders by created_at (or updated_at if you specify)
                ->first();


        return view('agencies.pages.amendment.visa-fourth-step',compact('applicationData','clientInformation','clientData','checkBalance','amendmentHistory'));
        }
     

}
}