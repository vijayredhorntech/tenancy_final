<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDetails;
use App\Models\ClientApplicationDocument;
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
use App\Mail\DocumentVerificationRequestMail;
use Illuminate\Support\Facades\Mail;
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
               $agency=Agency::with(['domains', 'userAssignments.service', 'balance'])->where('id',$client->agency_id)->first();

                $agencyconnnection = $this->agencyService->setConnectionByDatabase($agency->database_name);

              
                //    dd($client);
                // dd($agency);
                $agencydatabase=ClientDetails::on('user_database')->where('clientuid',$client->clientuid)->first();
             
                // dd($agency);
                $data=[
                'domain' => $agency->domains->domain_name,
                'database' => $agency->database_name,
                'full_url'=>$agency->domains->full_url,
                'agencydatabaseclient'=>$agencydatabase,
                
            ];

               session(['type' => 'client']);
               \session(['user_data' => $data]);
            
               return redirect()->route('client.profile');
    }

    // If client not found, return error
    return back()->withErrors([
        'email' => 'Invalid login details.',
    ]);
    }

    /****Profile **** */
    public function hsClientProfile(){
// dd('heelo');
        // $agency=Agency::with(['domains', 'userAssignments.service', 'balance'])->where('id',$client->agency_id)->first();
        // $agencyconnnection = $this->agencyService->setConnectionByDatabase($agency->database_name);

        // $client_data= Auth::guard('client')->user();
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];
        
        // $userData = session('user_data');

        $client = $this->clintRepository->getClientById($client_data->id,$storedata['database']);
        return view('clients.profile',compact('client'));
    }

    /****Application *** */

    public function hsClientApplication(){
        // $client_data= Auth::guard('client')->user();
        
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];

       $allbookings=$this->visaRepository->getDataByClientId($client_data->id);
   
        return view('clients.allapplicatoin',compact('allbookings'));
























        
    }

    /****Application Details *** */
    public function hsClientSupport(){
      
        $detials=[];
        
        // $client_data= Auth::guard('client')->user();
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];
        // dd($client_data);
        
        $agency=Agency::where('id',$client_data->agency_id)->first();
        $messages = Message::where('client_id', $client_data->id)
        // ->where('sender_user_type', 'client')
        ->get();
        // dd($client_data);
        // $userData = session('user_data');
        // dd($userData);
        // dd($client_data);
        $agency=Agency::where('id',$client_data->agency_id)->first();
        return view('clients.support',compact('messages','client_data','agency'));
    }

    /****Client Application View *** */
    public function hsClientApplicationView($id){
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];
        
        // Get the booking data
        $booking = $this->visaRepository->bookingDataById($id);
        
        // Check if the booking belongs to the logged-in client
        if (!$booking || $booking->client_id != $client_data->id) {
            return redirect()->route('client.application')->with('error', 'You are not authorized to access this application.');
        }
        
        // Get forms data for the visa type
        $origin_id = $booking->origin_id;
        $destination_id = $booking->destination_id;
        $forms = \App\Models\VisaServiceTypeDocument::with('from')
            ->where('origin_id', $origin_id)
            ->where('destination_id', $destination_id)
            ->get();
            
        // Get term conditions for invoice
        $termconditon = \App\Models\TermType::with([
            'terms' => function ($q) {
                $q->where('display_invoice', 1);
            },
        ])->get();
        
        return view('clients.applicationview', compact('booking', 'forms', 'termconditon'));
    }

    /****Client Conversation *** */
    public function hsClientConversation($id){
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];
        
        // Get the booking data
        $booking = $this->visaRepository->bookingDataById($id);
        
        // Check if the booking belongs to the logged-in client
        if (!$booking || $booking->client_id != $client_data->id) {
            return redirect()->route('client.application')->with('error', 'You are not authorized to access this conversation.');
        }
        
        // Get agency data
        $agency = Agency::where('id', $client_data->agency_id)->first();
        
        // Get messages for this client
        $messages = Message::where('client_id', $client_data->id)->get();
        
        return view('clients.conversation', compact('client_data', 'agency', 'messages', 'booking'));
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
    //    $client_data= Auth::guard('client')->user();
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];
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
        // $id = Auth::guard('client')->id(); 
        $storedata= $this->agencyService->getLoginClient(); 
        $id= $storedata['agencydatabaseclient']->id;

       $allbookings  = $this->visaRepository->getPendingDocumentByCID($id); // Ensure method name is correct
        return view('clients.pendingapplication',compact('allbookings'));
      
    }

    /****Upload document *** */
    public function hsClientUploadDocument($id, $type)
    {
        // dd($id);
        $booking = $this->visaRepository->bookingDataById($id);
        // dd($booking);
        // check agency data 
    
        if ($type == 'agency') {
        $agency = $this->agencyService->getAgencyData();

            // Corrected the syntax issue here by removing the extra parenthesis
            if (isset($booking->agency_id) && $booking->agency_id == $agency->id) {
                return view('agencies.pages.clients.uploaddocument', compact('booking'));    
            } else {
                return redirect()->route('agency.application')->with('error', 'You are not authorized to access this application.');
            }
        }

        $storedata= $this->agencyService->getLoginClient(); 
        
        $client_data= $storedata['agencydatabaseclient'];
    
        // Check for client authorization
        if (isset($booking->client_id) && $booking->client_id == $client_data->id) {
            
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
    // dd(request()->all());
    $application=ClientApplicationDocument::where('application_id',$request->booking_id)->first();
    
    $bookingApplication= $this->visaRepository->bookingDataById($request->booking_id);
  

    // For client uploads, we don't need user data from agency service
    if($request->type=='agency') {
        $user=$this->agencyService->getCurrentLoginUser(); 
        if(!$user) {
            return redirect()->route('agency.application',['type' => 'all'])->with('error', 'Agency session not found. Please login again.');
        }
        
        if($user) {
            $save=$this->agencyService->saveLog($bookingApplication,'agency','Uploaded Document', $user->id);
        }
        return redirect()->route('agency.application',['type' => 'all'])->with('success', 'Documents uploaded successfully.');
    }
    
    // For client uploads, use a default user ID or handle differently
    $save=$this->agencyService->saveLog($bookingApplication,'Client','Uploaded Document', '1');
    return redirect()->route('client.notification')->with('success', 'Documents uploaded successfully.');
    }


    /******Client ***** */
    public function hsDownloadDocumentCenter(){
        // $client_data= Auth::guard('client')->user();
        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];


        $allbookings=$this->visaRepository->getDataByClientId($client_data->id);
        return view('clients.downloadcenter',compact('allbookings'));
    }

    public function hsdownloadDocument($type,$id){
        $booking = $this->visaRepository->bookingDataById($id);


        if($type=='agency') {
            // check agency data
            $agency = $this->agencyService->getAgencyData();
            if (!$agency) {
                return redirect()->route('agency.application')->with('error', 'Agency session not found. Please login again.');
            }
            
            if (isset($booking->agency_id) && $booking->agency_id == $agency->id) {
                return view('agencies.pages.clients.download',compact('booking'));
            }
            return redirect()->route('agency.application')->with('error', 'You are not authorized to access this application.');
        }


        $storedata= $this->agencyService->getLoginClient(); 
        $client_data= $storedata['agencydatabaseclient'];

        if (isset($booking->client_id) && $booking->client_id == $client_data->id) {
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
