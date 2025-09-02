<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\Deduction;
use App\Models\CLientDetails;
use App\Models\ClientMoreInfo;
use App\Models\AuthervisaApplication;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\AgencyService;
use App\Models\SupplierPaymentDetail;
use App\Models\CancelInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use   App\Models\Invoice;


use Illuminate\Http\Request;

use function React\Promise\all;

class InvoiceController extends Controller
{

    protected $agencyService;

    public function __construct(AgencyService $agencyService) {
        $this->agencyService = $agencyService;
    }
    
    /**
     * *Super admin Function 
     * */

   
    public function hs_SAcancelInvoice(Request $request)
    {
       // Step 1: Validate and get filters
        $perPage = $request->filled('per_page') && is_numeric($request->per_page)
            ? (int) $request->per_page
            : null;
    
        // Step 2: Build query with eager loading
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
            'cancelinvoice'
        ])->where('invoicestatus', 'canceled')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('agency', function ($q2) use ($request) {
                      $q2->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        })->when($request->filled('date_from'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->date_from);
        })->when($request->filled('date_to'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->date_to);
        })->when($request->filled('min_price'), function ($query) use ($request) {
            $query->where('amount', '>=', $request->min_price);
        })->when($request->filled('max_price'), function ($query) use ($request) {
            $query->where('amount', '<=', $request->max_price);
        })->when($request->filled('serviceid'), function ($query) use ($request) {
            $query->where('service', $request->serviceid);
        });
    
        // Step 3: Fetch records with or without pagination
        $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();
 
        // Step 4: Load dynamic data from user databases
        foreach ($invoices as $invoice) {
           
            if ($invoice->agency && $invoice->visaBooking) {
            
                // Set dynamic DB connection
                $this->agencyService->setConnectionByDatabase($invoice->agency->database_name);
    
                $clientId = $invoice->visaBooking->client_id;
                $bookingId = $invoice->visaBooking->id;
    
                // Fetch related data from the user's database
                $clientFromUserDB = ClientDetails::on('user_database')
                    ->with('clientinfo')
                    ->find($clientId);
    
                $otherMembers = AuthervisaApplication::on('user_database')
                    ->where('clint_id', $clientId)
                    ->where('booking_id', $bookingId)
                    ->get();
    
                // Attach dynamically loaded relations
                $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
                $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
            }
        }

            $countries = Country::all();
            $services = Service::whereIn('id', [1, 2, 3])->get();  
    

           
        // Step 5: Render view if type matches
            return view('superadmin.pages.invoicehandling.cancelindex', [
                'countries' => $countries ?? [],
                'invoices' => $invoices,
                'services' => $services ?? [],
            ]);
        
    
        // Step 6: Fallback 404
        abort(404);
    }

    public function hs_SAcanceleditInvoice(){
        $invoices = Deduction::with([
            'service_name', 
            'agency',
            'visaBooking', 
            'visaBooking.visa',
            'visaBooking.origin',
            'visaBooking.destination',
            'visaBooking.visasubtype',
            'visaBooking.clint',
            'visaApplicant',
            'flightBooking',
            'hotelBooking',
            'hotelDetails',
            'cancelinvoice'
        ])->where('invoicestatus','canceled')->get();
       
            return view('superadmin.pages.invoicehandling.cancelindex', compact('invoices'));
 
    }
    


    public function hs_editInvoice($id){
        
    $invoice = Deduction::with('service_name')->findOrFail($id);
    
     
    if ($invoice->invoicestatus === 'edited') {
        return redirect()->route('invoice.all')->with('error', 'This invoice can only be edited once.');
    }

    return view('superadmin.pages.invoicehandling.editinvoice', compact('invoice'));
    } 
    

public function hs_EditedInvoices(Request $request)
{
    // Get the current agency (returns null if superadmin)
    $agency = $this->agencyService->getAgencyData();

    $invoices = Deduction::where('invoicestatus', 'edited')
        ->when($agency, function ($query) use ($agency) {
            $query->whereHas('visaBooking', function($q) use ($agency) {
                $q->where('agency_id', $agency->id);
            });
        })
        ->with(['service_name', 'agency', 'visaBooking'])
        ->orderByDesc('updated_at')
        ->get();

    return view('superadmin.pages.invoicehandling.editindex', compact('invoices'));
}





 public function hs_updateInvoice(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:0',
    ]);

    $invoice = Deduction::with('service_name')->findOrFail($id);
    
    $originalInvoiceNumber = $invoice->invoice_number;

    
    $serviceName = $invoice->service_name->name;
    $prefix = strtoupper(substr($serviceName, 0, 3)); // e.g., "TOU"

    
    $newInvoiceNumber =  'EID'.'-'.$prefix . '-' . $originalInvoiceNumber;

    if ($invoice->invoice_number !== $newInvoiceNumber) {
        $invoice->oldinvoiceno = $originalInvoiceNumber;
        $invoice->invoice_number = $newInvoiceNumber;
        $invoice->invoicestatus = 'edited';
    }

    
    $invoice->amount = $request->amount;

    $invoice->save();

    return redirect()->route('superadmin.allinvoices')->with('success', 'Invoice updated successfully.');
}
     
  



   public function hsSAupdateinvoice(Request $request,$id,$type){
    // Validate inputs first
    $request->validate([
        'id' => 'required|exists:deductions,id',
        'reason' => 'required|string',
        'refundamount' => 'required|numeric|min:0',
    ]);
    
       dd("hello");
    // Step 1: Update main invoice
    $invoice = Deduction::findOrFail($id);
    $invoice->invoicestatus = 'canceled'; // Assuming 1 = canceled
    $invoice->save();

    // Step 2: Update or create CancelInvoice record
    $cancelInvoice = CancelInvoice::firstOrNew([
        'invoice_id' => $request->id
    ]);

    $cancelInvoice->status = 'canceled';
    $cancelInvoice->reason = $request->reason;
    $cancelInvoice->cancelled_by = Auth::id();
    $cancelInvoice->amount = $request->refundamount;
    $cancelInvoice->save();

    if($type=="superadmin"){
    return redirect()->route('superadmin.allinvoices')->with('success', 'Invoice cancelled successfully.');
    }

    return redirect()->back()->with('success', 'Invoice cancelled.');

  }


  public function hs_CancelInvoice(Request $request, $id)
{
    // Get the invoice with its related service name
    $invoice = Deduction::findOrFail($id);

    // Just return the view with the invoice details
    return view('superadmin.pages.invoicehandling.cancelinvoice', compact('invoice'));
}


public function hs_CancelInvoiceSubmit(Request $request, $id)
{
    $request->validate([
        'id' => 'required|exists:deductions,id',
        'reason' => 'required|string',
        'refundamount' => 'required|numeric|min:0',
    ]);

    $invoice = Deduction::findOrFail($request->id);
    $invoice->invoicestatus = 'canceled'; // Assuming 1 = canceled
    $invoice->save();

    $cancelInvoice = CancelInvoice::firstOrNew([
        'invoice_id' => $request->id,
    ]);

    $cancelInvoice->application_number = $deduction->application_number ?? 'APP-' . $invoice->id;
    $cancelInvoice->type = 'manual';
    $cancelInvoice->remark = null;
    $cancelInvoice->reason = $request->reason;
    $cancelInvoice->cancelled_by = Auth::id();
    $cancelInvoice->status = 1;
    $cancelInvoice->amount = $request->refundamount;
    $cancelInvoice->cancelled_date = now();

    $cancelInvoice->save();

    return redirect()->route('superadmin.allinvoices')->with('success', 'Invoice cancelled successfully.');
}




 

    /**
     * *Agency  Function 
     * */

     /****Invoice Data ****/
    public function hs_invoice(Request $request, $type)
    {
     
        $agency=$this->agencyService->getAgencyData();
    
        // Step 1: Validate and get filters
        $perPage = $request->filled('per_page') && is_numeric($request->per_page)
            ? (int) $request->per_page
            : null;
    
        // Step 2: Build query with eager loading
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
            'hotelDetails'
        ])->where('agency_id', $agency->id)
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('agency', function ($q2) use ($request) {
                      $q2->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        })->when($request->filled('date_from'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->date_from);
        })->when($request->filled('date_to'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->date_to);
        })->when($request->filled('min_price'), function ($query) use ($request) {
            $query->where('amount', '>=', $request->min_price);
        })->when($request->filled('max_price'), function ($query) use ($request) {
            $query->where('amount', '<=', $request->max_price);
        })->when($request->filled('serviceid'), function ($query) use ($request) {
            $query->where('service', $request->serviceid);
        });
  
        // Step 3: Fetch records with or without pagination
        $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();
    
        $invoices=$this->agencyService->getClientinfo($invoices);
        
        // Step 4: Load dynamic data from user databases
        foreach ($invoices as $invoice) {
            if ($invoice->agency && $invoice->visaBooking) {
                // Set dynamic DB connection
                $this->agencyService->setDatabaseConnection($invoice->agency->database_name);
    
                $clientId = $invoice->visaBooking->client_id;
                $bookingId = $invoice->visaBooking->id;
    
                // Fetch related data from the user's database
                $clientFromUserDB = ClientDetails::on('user_database')
                    ->with('clientinfo')
                    ->find($clientId);
    
                $otherMembers = AuthervisaApplication::on('user_database')
                    ->where('clint_id', $clientId)
                    ->where('booking_id', $bookingId)
                    ->get();
    
                // Attach dynamically loaded relations
                $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
                $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
            }
        }
            $countries = Country::all();
            $services = Service::whereIn('id', [1, 2, 3])->get();  
    

        // Step 5: Render view if type matches
        if ($type === 'agencies') {
            return view('agencies.pages.invoicehandling.invoiceindex', [
                'countries' => $countries ?? [],
                'invoices' => $invoices,
                'services' => $services ?? [],
            ]);
        }
    
        // Step 6: Fallback 404
        abort(404);
    }


  
    /****Invoice Data ****/
    public function hs_viewInvoice(Request $request,$id){

        $invoice = Deduction::with([
            'service_name', 
            'agency',
            'visaBooking', 
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
            'invoiceview'
        ])->where('invoice_number',$id)->first();
     

        if (!$invoice) {
            abort(404); // Handle the case when the invoice is not found
        }
        $this->agencyService->setDatabaseConnection($invoice->agency->database_name);

     if($invoice->service == 3){
        $clientFromUserDB = ClientDetails::on('user_database')
        ->with('clientinfo') // You can add other nested relations if needed
        ->where('id', $invoice->visaBooking->client_id)
        ->first();
    
        $otherMember = AuthervisaApplication::on('user_database')
        ->where('clint_id', $invoice->visaBooking->client_id)
        ->where('booking_id', $invoice->visaBooking->id)
        ->get();

        $paymenthistory = SupplierPaymentDetail::on('user_database')
        ->where('booking_id', $invoice->id)
        ->orderByDesc('id')
        ->get();

        $invoice->setRelation('clint', $clientFromUserDB);
        $invoice->setRelation('otherclients', $otherMember);
        $invoice->setRelation('paymenthistory', $paymenthistory);

     }

        $countries = Country::all();
        $services = Service::whereIn('id', [1, 2, 3])->get();

        $agency=$this->agencyService->getAgencyData();
        if($agency->id == $invoice->agency_id){

            return view('agencies.pages.invoicehandling.invoiceview', compact('countries', 'invoice','services'));
        }
 
         abort(404);
    }

public function hs_allInvoices(Request $request)
{
    $perPage = $request->input('per_page', 10); // Default to 10 items per page


        $invoices = Deduction::with([
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
            ])->where(function ($query) {
            $query->whereNull('invoicestatus')
                ->orWhereNotIn('invoicestatus', ['canceled', 'edited']);
            })->paginate($perPage);


    //  get data client information with the client database
        $this->agencyService->getClientData($invoices);

    

        // Fetch filters or supporting data
    $countries = Country::all();
    $services = Service::whereIn('id', [1, 2, 3])->get();

    
    

    return view('superadmin.pages.invoicehandling.allinvoices', compact('invoices', 'countries', 'services'));
}





    public function hs_payamountstore(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:deductions,id',
            'add_ammount' => 'required|numeric|min:0',
            'modepayment' => 'required|string',
            'payment_number' => 'required|string',
            'remark' => 'nullable|string',
            'receiptcopy' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        // Get agency and booking info
        $agency = $this->agencyService->getAgencyData();
        $booking = Deduction::findOrFail($request->id);
    
        // Handle file upload
        $receiptPath = null;
        if ($request->hasFile('receiptcopy')) {
            $file = $request->file('receiptcopy');
            $receiptPath = $file->store('agency/receipts', 'public');
        }
    
        // Calculate total paid and remaining amount
        $totalPaid = SupplierPaymentDetail::on('user_database')
            ->where('booking_id', $request->id)
            ->sum('paying_amount');
    
        $remaining = $booking->amount - $totalPaid;
    
        // Prevent overpayment
        if ($request->add_ammount > $remaining) {
            return back()->with('error', 'Paying amount cannot exceed the remaining balance (' . number_format($remaining, 2) . ').')->withInput();
        }
    
        // Calculate new balance and payment status
        $newBalance = $remaining - $request->add_ammount;
        $status = bccomp($remaining, $request->add_ammount, 2) === 0 ? 1 : 2;
        if($status == 1){
            $invoice = Deduction::findOrFail($request->id);
            $invoice->invoicestatus = 2;
            $invoice->save();
        }
    
        // Determine supplier name
        if ($booking->service == 2) {
            $supplierName = 'flight';
        } elseif ($booking->service == 3) {
            $supplierName = 'visa';
        } else {
            $supplierName = 'hotel';
        }
    
        // Save supplier payment
        $supplier = new SupplierPaymentDetail();
        $supplier->setConnection('user_database'); // Correct method to set connection
        $supplier->booking_id = $request->id;
        $supplier->supplier_type = 'agency';
        $supplier->invoice_number = $booking->invoice_number;
        $supplier->service_id = $booking->service;
        $supplier->supplier_name = $supplierName;
        $supplier->payment_type = $request->modepayment;
        $supplier->payment_date = now();
        $supplier->payment_status = $status;
        $supplier->paying_amount = $request->add_ammount;
        $supplier->balance = $newBalance;
        $supplier->receipt = $receiptPath;
        $supplier->transaction_number = $request->payment_number;
        $supplier->remark = $request->remark;
        $supplier->save();
    
        // Redirect to appropriate route
        $route = ($booking->service == 2) ? 'superadmin.flight' : 'superadmin.hotel';
        return redirect()->route($route)->with('success', 'Supplier payment added successfully.');
    }


        public function hsGenerateInvoice(Request $request)
{
    // dd($request->all());
    /* ---------- 1. Validate incoming data ---------- */
    $validated = $request->validate([
        'clientname'     => ['required', 'string', 'max:255'],
        'invoicenumber'  => ['required', 'string', 'max:255'],
        'bookingid'      => ['required', 'integer'],
        'clientid'       => ['required', 'integer'],
        'invoicedate'    => ['required', 'date', 'before_or_equal:today'],
        'alternate_name' => ['nullable', 'string', 'max:255'],
        'address'        => ['required', 'string', 'max:500'],
        'paymentMethod'  => ['required'],
        'totalInput'  => ['required'],
    


        
    ]);

    /* ---------- 2. Look up deduction (if any) ---------- */
    $deduction = Deduction::where('invoice_number', $validated['invoicenumber'])->first();
  
    if (! $deduction) {
        return back()->withErrors([
            'invoicenumber' => 'No deduction found for that invoice number.',
        ])->withInput();
    }

    /* ---------- 3. Assemble payload for Invoice ---------- */
    $invoiceData = [
        'receiver_name'  => $validated['clientname'],
        'invoice_date'   => $validated['invoicedate'],
        'due_date'       => $validated['invoicedate'],          // customise if needed (e.g. +14 days)
        'different_name' => $validated['alternate_name'],       // nullable
        'address'        => $validated['address'],
        'bookingid'      => $deduction->id,
        'visa_applicant' => 'self',
        'service_id'     => $deduction->service,                                  // hard‑coded; change if dynamic
        'billing_id'     => $validated['clientid'],
        'applicant_id'   => $validated['clientid'],
        'amount'         => $validated['totalInput'],
        'discount'       =>  $request->discountInput,                                  // or calculate something
        'payment_type'   => $validated['paymentMethod'],                             // or pull from request
    ];

    /* ---------- 4. Persist and respond ---------- */
    Invoice::create($invoiceData);

    return redirect()
        ->back()
        ->with('success', 'Invoice generated successfully.');

}

    public function hsAllinvoice(Request $request)
{
    $perPage = $request->filled('per_page') && is_numeric($request->per_page)
        ? (int) $request->per_page
        : null;

    $agency = $this->agencyService->getAgencyData(); // returns null for superadmin, and agency model for agency users

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
    ->where(function ($q) {
        $q->whereNull('invoicestatus')
          ->orWhereNotIn('invoicestatus', ['canceled', 'edited']);
    });

    // ✅ Filter by agency if agency is logged in
    if ($agency) {
        $invoicesQuery->where('agency_id', $agency->id);
    }

    $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();

    return view('superadmin.pages.invoicehandling.allinvoices', compact('invoices'));
}
 

    public function hseditInvoice($id){
        
    $invoice = Deduction::with('service_name')->findOrFail($id);
    
     
    if ($invoice->invoicestatus === 'edited') {
        return redirect()->route('invoice.all')->with('error', 'This invoice can only be edited once.');
    }

    return view('superadmin.pages.invoicehandling.editinvoice', compact('invoice'));
    } 



    public function hsEditedInvoices(Request $request)
{
    // Get the current agency (returns null if superadmin)
    $agency = $this->agencyService->getAgencyData();

    $invoices = Deduction::where('invoicestatus', 'edited')
        ->when($agency, function ($query) use ($agency) {
            $query->whereHas('visaBooking', function($q) use ($agency) {
                $q->where('agency_id', $agency->id);
            });
        })
        ->with(['service_name', 'agency', 'visaBooking'])
        ->orderByDesc('updated_at')
        ->get();

    return view('superadmin.pages.invoicehandling.editindex', compact('invoices'));
}



    public function hsviewInvoice(Request $request,$id){
        // Treat $id as VisaBooking ID and fetch booking used by the component
        $booking = app(\App\Repositories\DocumentSignRepository::class)->checkSignDocument($id);
        $termconditon = app(\App\Repositories\TermConditionRepository::class)->allTeamTypes();

        return view('superadmin.pages.invoicehandling.invoiceview', [
            'booking' => $booking,
            'termconditon' => $termconditon,
        ]);
    }

    public function hsRetailInvoices(Request $request)
    {
        // Load recent Visa bookings with related deduction (superadmin invoice number)
        $bookings = \App\Models\VisaBooking::with(['deduction'])
            ->orderByDesc('id')
            ->limit(100)
            ->get();

        return view('agencies.pages.invoicehandling.retail-invoices', [
            'bookings' => $bookings,
        ]);
    }

    public function hsSuperadminRetailInvoiceView($id)
    {
        // $id is VisaBooking ID
        $booking = app(\App\Repositories\DocumentSignRepository::class)->checkSignDocument($id);
        $termconditon = app(\App\Repositories\TermConditionRepository::class)->allTeamTypes();

        return view('components.common.invoice.Superadminvisa-invoice', [
            'booking' => $booking,
            'termconditon' => $termconditon,
        ]);
    }

    



}
