<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\User;
use App\Models\Country;
use App\Models\Deduction;
use App\Models\CLientDetails;
use App\Models\ClientMoreInfo;
use App\Models\AuthervisaApplication;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\AgencyService;
use App\Models\SupplierPaymentDetail;
use App\Models\CancelInvoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

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
        ])->where('invoicestatus', '1')
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

    public function hs_SAcanceleditInvoice($id){
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
            'cancelinvoice'
        ])->where('id',$id)->first();
     

        if (!$invoice) {
            abort(404); // Handle the case when the invoice is not found
        }
        $this->agencyService->setConnectionByDatabase($invoice->agency->database_name);

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

     

            return view('superadmin.pages.invoicehandling.cancelinvoice', compact('countries', 'invoice','services'));
       
 
         abort(404);
    }


   public function hsSAupdateinvoice(Request $request){
    // dd($request->all());
    $invoice=Deduction::where('id',$request->id)->first();
    $invoice->invoicestatus='1';
    $invoice->save();
 

    $cancelInvoice =CancelInvoice::where('invoice_id',$request->id)->first();
    $cancelInvoice->status = 1;
    $cancelInvoice->reason = $request->reason;
    $cancelInvoice->cancelled_by = Auth::id();
    $cancelInvoice->amount = $request->refundamount;
    $cancelInvoice->save();
    return redirect()->back()->with('success', 'Invoice cancelled successfully.');  
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
            'cancelinvoice'
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

    public function hs_cancelInvoice(Request $request)
   {
    // dd($request->all());
    // Validate the request
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:deductions,id',
        'remark' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('show_cancel_tab', true); // 👈 Add flag to show cancel tab
    }

    $invoice=Deduction::where('id',$request->id)->first();
    $invoice->invoicestatus='1';
    $invoice->save();
 

    $cancelInvoice = new CancelInvoice();
    $cancelInvoice->invoice_id = $invoice->id;
    $cancelInvoice->application_number = $invoice->invoice_number;
    $cancelInvoice->type = "agency";
    $cancelInvoice->status = 0;

    $cancelInvoice->remark = $request->remark;
    $cancelInvoice->save();
    return redirect()->back()->with('success', 'Invoice cancelled successfully.');  
   } 

}
