<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Add this at the top if not already
use App\Services\AgencyService;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Models\Agency;
use App\Models\Support;
use App\Models\Message;
use Illuminate\Support\Str;
use App\Traits\ChatTrait;
use Illuminate\Support\Facades\Response;



class ClientLoginController extends Controller
{

    use ChatTrait;

    protected $agencyService,$visaRepository,$clintRepository;
  
 

    public function __construct(ClintRepositoryInterface $clintRepository ,VisaRepositoryInterface $visaRepository,AgencyService $agencyService)
    {
        $this->clintRepository = $clintRepository;
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;

       
    }


    //
    /***Client handle*** */
    public function hsClientLogin(){
        return view('clients.login');
    }

    public function hsClientLoginStore(Request $request){

       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

         // Find client using email and clientuid
    $client = ClientDetails::where('email', $request->email)
    ->where('clientuid', $request->password)
    ->first();
    if ($client) {
       
               Auth::guard('client')->login($client);
               session(['type' => 'client']);
             
               return redirect()->route('client.profile');
    }

    // If client not found, return error
    return back()->withErrors([
        'email' => 'Invalid login details.',
    ]);
    }

    /****Profile **** */
    public function hsClientProfile(){

        $client_data= Auth::guard('client')->user();
        $client = $this->clintRepository->getClientById($client_data->id);
        return view('clients.profile',compact('client'));
    }

    /****Application *** */

    public function hsClientApplication(){
        $client_data= Auth::guard('client')->user();
       $allbookings=$this->visaRepository->getDataByClientId($client_data->id);
   
        return view('clients.allapplicatoin',compact('allbookings'));
    }

    /****Application Details *** */
    public function hsClientSupport(){
      
        $detials=[];
        
        $client_data= Auth::guard('client')->user();
        $messages = Message::where('client_id', $client_data->id)
        // ->where('sender_user_type', 'client')
        ->get();
        $agency=Agency::where('id',$client_data->agency_id)->first();
        return view('clients.support',compact('messages','client_data','agency'));
    }
  

    /***** */
    public function hsClientStoreMessage(Request $request){
    
       

        $request->validate([
            'message' => 'required_without:attachment|string|max:1000',
            'type' => 'required|string|max:255',
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
       $client_data= Auth::guard('client')->user();
        $agency=Agency::where('id',$client_data->agency_id)->first();

        $ticket_code = 'TICKET-' . strtoupper(Str::random(6)) . '-' . time();
        $type = 'client';
        $clientid = $client_data->id;
        $agencyid = $agency->id;
        $loginuserid=$client_data->id;

        // Now call the function properly
        $support = $this->getStoreClient($request, $ticket_code, $type, $filename, $agencyid, $clientid,$loginuserid);

        return response()->json([
            'success' => true,
            'message' => $support
        ]);

       
    }

     /****public function *** */
     public function hsClientNotification(){
        $id = Auth::guard('client')->id(); 
       $allbookings  = $this->visaRepository->getPendingDocumentByCID($id); // Ensure method name is correct
        return view('clients.pendingapplication',compact('allbookings'));
      
    }

    /****Upload document *** */
    public function hsClientUploadDocument($id, $type)
    {
        $booking = $this->visaRepository->bookingDataById($id);
        // check agency data 
        $agency = $this->agencyService->getAgencyData();
    
        if ($type == 'agency') {
            // Corrected the syntax issue here by removing the extra parenthesis
            if (isset($booking->agency_id) && $booking->agency_id == $agency->id) {
                return view('agencies.pages.clients.uploaddocument', compact('booking'));    
            } else {
                return redirect()->route('agency.application')->with('error', 'You are not authorized to access this application.');
            }
        }
    
        // Check for client authorization
        if (isset($booking->client_id) && $booking->client_id == Auth::guard('client')->id()) {
            return view('clients.uploaddocument', compact('booking'));
        } else {
            return redirect()->route('client.notification')->with('error', 'You are not authorized to access this application.');
        }
    }
    

    /*** Store Function ****/
    public function hsClientStoreDocument(Request $request){
     
       
        $request->validate([
            'documents' => 'required|max:2048', // 2MB max    
        ]);
    $storebooking = $this->visaRepository->storeClientDocuemtn($request->all());
   
    if($request->type=='agency') {

        return redirect()->route('agency.application')->with('success', 'Documents uploaded successfully.');
    }
    return redirect()->route('client.notification')->with('success', 'Documents uploaded successfully.');
       

    return back()->with('success', 'Documents uploaded successfully.');   
    }


    /******Client ***** */
    public function hsDownloadDocumentCenter(){
        $client_data= Auth::guard('client')->user();

        $allbookings=$this->visaRepository->getDataByClientId($client_data->id);
        return view('clients.downloadcenter',compact('allbookings'));
    }

    public function hsdownloadDocument($type,$id){
        $booking = $this->visaRepository->bookingDataById($id);

        if($type=='agency') {
            // check agency data
            $agency = $this->agencyService->getAgencyData();
            if (isset($booking->agency_id) && $booking->agency_id == $agency->id) {
                return view('agencies.pages.clients.download',compact('booking'));
            }
            return redirect()->route('agency.application')->with('error', 'You are not authorized to access this application.');
        }
        if (isset($booking->client_id) && $booking->client_id == Auth::guard('client')->id()) {
            return view('clients.download',compact('booking'));
        }
    }

    public function downloadJsonDocument(Request $request)
    {
    
        $filePath = urldecode($request->query('file')); // Now it becomes normal like "documents/clientuploadDocument/xxx.png"
        if (!Str::startsWith($filePath, 'documents/clientuploadDocument/')) {
            abort(403, 'Unauthorized file access.');
        }
        $fullPath = storage_path('app/public/' . $filePath);
        // Check if file exists
        if (!file_exists($fullPath)) {
            abort(404, 'File not found.');
        }
    
        // Return download response
        return response()->download($fullPath, basename($filePath));
    }
    

      /****public function *** */
      public function hsClientLogout(){
        Auth::guard('client')->logout();
        Session::flush();
        return redirect()->route('client.login');
    }
}
