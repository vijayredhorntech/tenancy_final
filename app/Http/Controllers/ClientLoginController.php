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
use App\Models\Deduction;
use App\Models\Invoice; 
use App\Models\Country; 
use App\Models\Service; 

use Carbon\Carbon;








use App\Models\AuthervisaApplication; 



use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;



class ClientLoginController extends Controller
{

    use ChatTrait;

    protected $agencyService,$visaRepository,$clintRepository,$termConditionRepository,$documentSignRepository;
  
 

    public function __construct(ClintRepositoryInterface $clintRepository ,VisaRepositoryInterface $visaRepository,AgencyService $agencyService,DocumentSignRepositoryInterface $documentSignRepository,TermConditionRepositoryInterface $termConditionRepo)
    {
        $this->clintRepository = $clintRepository;
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
        $this->documentSignRepository = $documentSignRepository;
        $this->termConditionRepo = $termConditionRepo;      
       
    }


    //
    /***Client handle*** */
    public function hsClientLogin(){
        return view('clients.login');
    }

    public function hsClientLoginStore(Request $request)
{
    /* ================= VALIDATION ================= */

    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);
      
    /* ================= DOMAIN FROM SESSION ================= */
    $domain = session('agency_domain');
 

    if (!$domain) {
        return back()->withErrors([
            'email' => 'Session expired. Please reload and try again.',
        ]);
    }

    /* ================= GET AGENCY VIA DOMAIN RELATION ================= */
    $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])
        ->whereHas('domains', function ($q) use ($domain) {
            $q->where('domain_name', $domain);
        })
        ->first();

    if (!$agency) {
        return back()->withErrors([
            'email' => 'Invalid domain or agency not found.',
        ]);
    }


    /* ================= FIND CLIENT (MAIN DB) ================= */
    $client = ClientDetails::where('email', $request->email)
        ->where('clientuid', $request->password) // ⚠️ hash later
        ->first();

    if (!$client) {
   
        return back()->withErrors([
            'email' => 'Invalid login details.',
        ]);
    }

    /* ================= SWITCH TO AGENCY DATABASE ================= */
    $this->agencyService->setConnectionByDatabase($agency->database_name);

    /* ================= GET CLIENT FROM AGENCY DB ================= */
    $agencyDatabaseClient = ClientDetails::on('user_database')
        ->where('clientuid', $client->clientuid)
        ->first();

    /* ================= SAVE SESSION ================= */
    session([
        'type' => 'client',
        'user_data' => [
            'domain'               => $agency->domains->first()->domain_name,
            'database'             => $agency->database_name,
            'full_url'             => $agency->domains->first()->full_url ?? null,
            'agencydatabaseclient' => $agencyDatabaseClient,
        ],
    ]);

    /* ================= REDIRECT ================= */
    return redirect()->route('client.profile');
}

public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    /* ================= DOMAIN FROM SESSION ================= */
    $domain = session('agency_domain');

    if (!$domain) {
        return response()->json([
            'success' => false,
            'message' => 'Session expired. Please reload the page.',
        ]);
    }

    /* ================= FIND CLIENT ================= */
    $client = ClientDetails::where('email', $request->email)->first();

    if (!$client) {
        return response()->json([
            'success' => false,
            'message' => 'Email not registered.',
        ]);
    }

    /* ================= GENERATE OTP ================= */
    $otp = rand(100000, 999999);

    /* ================= STORE OTP IN SESSION ================= */
    session([
        'client_forgot_otp' => [
            'otp'        => $otp,
            'email'      => $client->email,
            'domain'     => $domain,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]
    ]);

    /* ================= SEND EMAIL ================= */
    Mail::raw("Your OTP is: {$otp}. It will expire in 5 minutes.", function ($message) use ($client) {
        $message->to($client->email)
                ->subject('Client Login OTP');
    });

    return response()->json([
        'success' => true,
        'message' => 'OTP sent successfully.',
    ]);
}


public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required',
    ]);

    $otpData = session('client_forgot_otp');

    if (!$otpData) {
        return response()->json([
            'success' => false,
            'message' => 'OTP session expired. Please resend OTP.',
        ]);
    }

    /* ================= EXPIRY CHECK ================= */
    if (Carbon::now()->greaterThan($otpData['expires_at'])) {
        session()->forget('client_forgot_otp');

        return response()->json([
            'success' => false,
            'message' => 'OTP expired. Please resend OTP.',
        ]);
    }

    /* ================= OTP MATCH ================= */
    if ($otpData['otp'] != $request->otp) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP.',
        ]);
    }

    /* ================= GET AGENCY ================= */
    $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])
        ->whereHas('domains', function ($q) use ($otpData) {
            $q->where('domain_name', $otpData['domain']);
        })
        ->first();

    if (!$agency) {
        return response()->json([
            'success' => false,
            'message' => 'Agency not found.',
        ]);
    }

    /* ================= GET CLIENT ================= */
    $client = ClientDetails::where('email', $otpData['email'])->first();

    if (!$client) {
        return response()->json([
            'success' => false,
            'message' => 'Client not found.',
        ]);
    }

    /* ================= SWITCH DB ================= */
    $this->agencyService->setConnectionByDatabase($agency->database_name);

    $agencyDatabaseClient = ClientDetails::on('user_database')
        ->where('clientuid', $client->clientuid)
        ->first();

    /* ================= SAVE SESSION (SAME AS LOGIN) ================= */
    session([
        'type' => 'client',
        'user_data' => [
            'domain'               => $agency->domains->first()->domain_name,
            'database'             => $agency->database_name,
            'full_url'             => $agency->domains->first()->full_url ?? null,
            'agencydatabaseclient' => $agencyDatabaseClient,
        ],
    ]);

    session()->forget('client_forgot_otp');

    return response()->json([
        'success'  => true,
        'redirect' => route('client.profile'),
    ]);
}

    /****Profile **** */
    public function hsClientProfile(){

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
        $countries=Country::get(); 
        
        return view('clients.applicationview', compact('booking', 'forms', 'termconditon','countries'));
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
   return redirect()
    ->route('client.application.view', ['id' => $request->booking_id, 'tab' => 'uploadeDocumentDiv'])
    ->with('success', 'Documents uploaded successfully.');
    
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
     // Store domain information before clearing session
        $userData = session('user_data');
        $domain = $userData['domain'] ?? null;
        
        Auth::guard('client')->logout();
        Session::flush();
        
        // Redirect to agency homepage using the domain
        if ($domain) {
            return redirect('/' . $domain);
        } else {
            // Fallback to home page if domain is not available
            return redirect('/');
        }
    }




    /*******Client Invoice Handler /**** */ 

  
    //   public function hsclientInvoice(Request $request)
    // {

    //     $clientInformation= $this->agencyService->getLoginClient();
    //     $clientData=$clientInformation['agencydatabaseclient'];


    //     // ✅ Pagination value
    //     $perPage = $request->filled('per_page') && is_numeric($request->per_page)
    //         ? (int) $request->per_page
    //         : null;

    //     // ✅ Query with relations and filters
    //     $invoicesQuery = Deduction::with([
    //         'service_name',
    //         'agency',
    //         'visaBooking.visa',
    //         'visaBooking.origin',
    //         'visaBooking.destination',
    //         'visaBooking.visasubtype',
    //         'visaBooking.clint',
    //         'visaApplicant',
    //         'flightBooking',
    //         'hotelBooking',
    //         'hotelDetails',
    //         'cancelinvoice',
    //         'invoice',
    //         'docsign'
    //     ])
    //     ->where(function ($q) {
    //         $q->whereNull('invoicestatus')
    //         ->orWhereNotIn('invoicestatus', ['canceled', 'edited']);
    //     })
    //     ->where('client_id', $clientData->id)
    //     ->where('agency_id', $clientData->agency_id);

    //     // ✅ Get paginated or full results
    //     $invoices = $perPage 
    //         ? $invoicesQuery->paginate($perPage) 
    //         : $invoicesQuery->get();


    //     return view('clients.pages.invoice.invoicehandling', compact('invoices'));
    // }

 public function hsclientInvoice(Request $request)
{
            // Step 1: Logged-in client info
            $clientInfo = $this->agencyService->getLoginClient();
            $clientData = $clientInfo['agencydatabaseclient'];

            $agencyId = $clientData->agency_id;

            // Step 2: Pagination
            $perPage = $request->filled('per_page') && is_numeric($request->per_page)
                ? (int) $request->per_page
                : null;

            // Step 3: Base Query (same as hsAllinvoice)
            $invoicesQuery = Deduction::with([
                'service_name',
                'agency',
                'visaBooking.visa',
                'visaBooking.origin',
                'visaBooking.destination',
                'visaBooking.visasubtype',
                'visaBooking.clint',
                'visaApplicant',
                'flightBooking',
                'hotelBooking',
                'hotelDetails',
                'cancelinvoice',
                'invoice',
                'docsign'
            ])
                ->where('agency_id', $agencyId)
                ->where('client_id', $clientData->id)
                ->where(function ($q) {
                    $q->whereNull('invoicestatus')
                    ->orWhereNotIn('invoicestatus', ['canceled', 'edited']);
                });

            // Step 4: EXTRA — Visa booking filter (same as hsAllinvoice)
            $invoicesQuery->whereHas('visaBooking', function ($q) {
                $q->whereNull('otherclientid')
                ->orWhere('otherclientid', '');
            });

            // Step 5: Apply all filters (copied from hsAllinvoice)
    if ($request->filled('status') || $request->filled('date_from') ||
        $request->filled('date_to') || $request->filled('search')) {

        $invoicesQuery->where(function ($q) use ($request) {

            // STATUS FILTER
            if ($request->filled('status')) {

                if ($request->status === 'Adjusted') {

                    // Check status in deductions table
                    $q->where('invoicestatus', 'Adjusted');

                } else {

                    // Check status in invoice table
                    $q->whereHas('invoice', function ($subQ) use ($request) {
                        $subQ->where('status', $request->status);
                    });
                }

            } else {

                // APPLY DATE + SEARCH FILTERS
                $q->whereHas('invoice', function ($subQ) use ($request) {

                    // Date From
                    if ($request->filled('date_from')) {
                        $subQ->whereDate('created_at', '>=', $request->date_from);
                    }

                    // Date To
                    if ($request->filled('date_to')) {
                        $subQ->whereDate('created_at', '<=', $request->date_to);
                    }

                    // Search
                    if ($request->filled('search')) {
                        $search = $request->search;
                        $subQ->where(function ($innerQ) use ($search) {
                            $innerQ->where('invoice_no', 'like', "%{$search}%")
                                   ->orWhere('client_name', 'like', "%{$search}%");
                        });
                    }

                })
                ->orWhereDoesntHave('invoice'); // include deductions without invoices
            }
        });
    }

    // Step 6: Pagination / Get All
    $invoices = $perPage
        ? $invoicesQuery->paginate($PerPage)->appends($request->query())
        : $invoicesQuery->get();

    // Step 7: Load user_database relations
    foreach ($invoices as $invoice) {

        if ($invoice->agency && $invoice->visaBooking) {

            // Switch DB
            $this->agencyService->setDatabaseConnection($invoice->agency->database_name);

            $clientId  = $invoice->visaBooking->client_id;
            $bookingId = $invoice->visaBooking->id;

            // Client details
            $clientFromUserDB = ClientDetails::on('user_database')
                ->with('clientinfo')
                ->find($clientId);

            // Family members
            $otherMembers = AuthervisaApplication::on('user_database')
                ->where('client_id', $clientId)
                ->where('booking_id', $bookingId)
                ->get();

            // Attach to model
            $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
            $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
        }
    }

    // Step 8: Load filters for UI
    $countries = Country::all();
    $services  = Service::whereIn('id', [1, 2, 3])->get();

    // Step 9: Return client invoice view
    return view('clients.pages.invoice.invoicehandling', [
        'invoices'  => $invoices,
        'countries' => $countries,
        'services'  => $services,
    ]);
}




     public function hsviewInvoice(Request $request,$id){

    
        // Treat $id as VisaBooking ID and fetch booking used by the component
        
        $booking=$this->documentSignRepository->checkSignDocument($id); 

    
        $termconditon = $this->termConditionRepo->allTeamTypes();      

        return view('clients.pages.invoice.view-invoice', [
            'booking' => $booking,
            'termconditon' => $termconditon,
        ]);
    
      
    //    return view('clients.pages.invoice.view-invoice', compact('invoice'));
        // Step 3: Fetch records with or without pagination
        // Step 4: Load dynamic data from user databases
        // Step 5: Render view if type matches
    }



}
