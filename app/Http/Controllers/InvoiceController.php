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
use App\Models\VisaBooking;
use App\Models\InvoiceAdjustment;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\AgencyService;
use App\Models\SupplierPaymentDetail;
use App\Models\CancelInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use   App\Models\Invoice;
use App\Repositories\Interfaces\VisaRepositoryInterface;


use Illuminate\Http\Request;

use function React\Promise\all;

class InvoiceController extends Controller
{

    protected $visaRepository;

    protected $agencyService;

    public function __construct(VisaRepositoryInterface $visaRepository,AgencyService $agencyService) {
        $this->agencyService = $agencyService;
            $this->visaRepository = $visaRepository;

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
        'receiver_name' => 'nullable|string|max:255',
        'receiver_address' => 'nullable|string|max:500',
        'visa_applicant_name' => 'nullable|string|max:255',
        'payment_mode' => 'required|string|in:CREDIT CARD,DEBIT CARD,CASH,BANK TRANSFER',
        'discount' => 'nullable|numeric|min:0',
        'total' => 'required|numeric|min:0',
        'visa_fee' => 'nullable|numeric|min:0',
        'service_charge' => 'nullable|numeric|min:0',
    ]);

    $invoice = Deduction::with(['service_name', 'visaBooking.clint', 'invoice'])->findOrFail($id);

    
    // Update deduction amount
    // $invoice->amount = $request->total;
    // $invoice->save();

    // Update or create invoice record

     $number = $invoice->invoice_number;
      if (preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)) {
         $formattedInvoice = $matches[1] . 'E' . $matches[2];
    } else {
        $formattedInvoice = $number; // fallback if pattern doesn't match
    }
    $invoiceData = [
        'receiver_name' => $request->receiver_name ?: $invoice->visaBooking->clint->client_name ?? 'N/A',
        'address' => $request->receiver_address ?: $invoice->visaBooking->clint->permanent_address ?? 'N/A',
        'visa_applicant' => $request->visa_applicant_name,
        'amount' =>$invoice->amount,
        'discount' => $request->discount ?? 0,
        'payment_type' => $request->payment_mode,
        'invoice_date' => now()->toDateString(),
        'visa_fee' => $request->visa_fee ?? 0,
        'service_charge' => $request->service_charge ?? 0,
        'new_price' => $request->total,
        'type' => 'agency',
        'new_invoice_number' => $formattedInvoice,
        'status' => 'edited',
        'invoicestatus' => 'edited',
    ];

    if ($invoice->invoice) {
        $invoice->invoice->update($invoiceData);
    } else {
        $invoiceData['bookingid'] = $invoice->id;
        $invoice->invoice()->create($invoiceData);
    }

    // Update client details if visa_applicant_name is provided
    if ($request->visa_applicant_name && $invoice->visaBooking && $invoice->visaBooking->clint) {
        try {
            // Set database connection for client details
            $this->agencyService->setDatabaseConnection($invoice->agency->database_name);
            
            $clientDetails = \App\Models\ClientDetails::on('user_database')
                ->where('id', $invoice->visaBooking->client_id)
                ->first();
                
            if ($clientDetails) {
                $clientDetails->client_name = $request->visa_applicant_name;
                $clientDetails->save();
            }
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to update client details: ' . $e->getMessage());
        }
    }

    return redirect()->route('invoice.all', ['type' => 'agencies'])->with('success', 'Invoice edited successfully.');
}
     
  



   public function hsSAupdateinvoice(Request $request,$id,$type){
    // Validate inputs first
    $request->validate([
        'id' => 'required|exists:deductions,id',
        'reason' => 'required|string',
        'refundamount' => 'required|numeric|min:0',
    ]);
    
    
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


  public function hs_cancelInvoice($id)
{
    $agency = $this->agencyService->getAgencyData();
    
    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Find the deduction/invoice
    $deduction = Deduction::with(['invoice', 'visabooking'])
        ->where('id', $id)
        ->where('agency_id', $agency->id)
        ->first();

    if (!$deduction) {
        return back()->with('error', 'Invoice not found.');
    }

    // Cancel visa booking if exists
    if ($deduction->visabooking) {
        $deduction->visabooking->update([
            'document_status'        => 'Canceled',
            'applicationworkin_status'=> 'Canceled',
        ]);
    }

    // Update deduction status to Canceled
    $deduction->invoicestatus = 'Canceled';
    $deduction->save();

    return redirect()
        ->route('invoice.all', ['type' => 'agencies'])
        ->with('success', 'Invoice canceled successfully.');
}

public function hs_retrieveInvoice($id)
{
    $agency = $this->agencyService->getAgencyData();
    
    
    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Find the deduction/invoice
    $deduction = Deduction::with(['invoice', 'visabooking'])
        ->where('id', $id)
        ->where('agency_id', $agency->id)
        ->first();

    if (!$deduction) {
        return back()->with('error', 'Invoice not found.');
    }

    // Update deduction status to Retrieved
    $deduction->invoicestatus = 'Retrieved';
    $deduction->save();

    return redirect()
        ->route('invoice.all', ['type' => 'agencies'])
        ->with('success', 'Invoice retrieved successfully.');
}



// public function hsupdateRefundInvoice(Request $request)
// {

//     $request->validate([
//         'application_id'   => 'required|exists:deductions,id',
//         'reason'       => 'nullable|string',
//         'refundamount' => 'nullable|numeric|min:0',
//         'payment_mode' => 'required|string',
//         'total'        => 'required|numeric|min:0',
//     ]);

//     $agency   = $this->agencyService->getAgencyData();
//     $agencyId = $agency->id;

//     // Find deduction with invoice relation
//     $deduction = Deduction::with('invoice','visabooking')
//         ->where('id', $request->application_id) // fixed: use invoice_id
//         ->where('agency_id', $agencyId)
//         ->first();

//     if (!$deduction) {
//         return back()->with('error', 'Invoice not found.');
//     }

//     // Update deduction status
//     $deduction->invoicestatus = 'Canceled';
//     $deduction->save();

//     // Format invoice number with "R"
//     $number = $deduction->invoice_number;
//     if ($number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)) {
//         $formattedInvoice = $matches[1] . 'R' . $matches[2];
//     } else {
//         $formattedInvoice = $number ?? 'INV' . uniqid();
//     }

//     // Prepare invoice update data
//         $invoiceData = [
//             'receiver_name'      => $request->receiver_name ?? 'Dummy Client',
//             'invoice_date'       => $request->invoice_date ?? Carbon::now()->format('Y-m-d'),
//             'due_date'           => $request->invoice_date ?? Carbon::now()->addDays(14)->format('Y-m-d'), // optional
//             'different_name'     => $request->different_name ?? null,
//             'address'            => $request->address ?? 'Dummy Address',
//             'bookingid'          => $request->bookingid ?? null,
//             'visa_applicant'     => $request->visa_applicant_name ?? 'Self',
//             'service_id'         => $request->service_id ?? null,
//             'billing_id'         => $request->billing_id ?? null,
//             'applicant_id'       => $request->applicant_id ?? null,
//             'amount'             => $request->total ?? '0',
//             'discount'           => $request->discount ?? 0,
//             'payment_type'       => $request->payment_mode ?? 'CASH',
//             'visa_fee'           => $request->visa_fee ?? 0,
//             'service_charge'     => $request->service_charge ?? 0,
//             'new_invoice_number' => $formattedInvoice,
//             'status'             => 'Canceled',
//             'new_price'          => $request->total ?? '0',
//             'type'               => 'agency',
//         ];

//     // Update or create invoice
//     if ($deduction->invoice) {
//         $deduction->invoice->update($invoiceData);
//     } else {
//         $invoiceData['bookingid'] = $deduction->id;
//         $deduction->invoice()->create($invoiceData);
//     }

//     // Save cancel invoice record
//     $cancelInvoice = CancelInvoice::firstOrNew([
//         'invoice_id' => $deduction->invoice->id, // make sure $deduction->invoice exists
//     ]);

//     $cancelInvoice->application_number = $formattedInvoice;
//     $cancelInvoice->type               = 'manual';
//     $cancelInvoice->remark             = $request->remark;
//     $cancelInvoice->reason             = $request->reason;
//     $cancelInvoice->cancelled_by       = Auth::id();
//     $cancelInvoice->status             = 1;
//     $cancelInvoice->amount             = $request->total;
//     $cancelInvoice->safi               = $request->safi ?? 0;
//     $cancelInvoice->atol               = $request->atol ?? 0;
//     $cancelInvoice->credit_charge      = $request->credit_charge ?? 0;
//     $cancelInvoice->penalty            = $request->penalty ?? 0;
//     $cancelInvoice->admin              = $request->admin ?? 0;
//     $cancelInvoice->misc               = $request->misc ?? 0;
//     $cancelInvoice->cancelled_date     = now();

//     $cancelInvoice->save();

//     return redirect()
//         ->route('invoice.all', ['type' => 'agencies'])
//         ->with('success', 'Invoice canceled successfully.');
// }

// public function hsupdateRefundInvoice(Request $request)
// {
//     $request->validate([
//         'application_id'   => 'required|exists:deductions,id',
//         'reason'           => 'nullable|string',
//         'remark'           => 'nullable|string',
//         'refundamount'     => 'nullable|numeric|min:0',
//         'payment_mode'     => 'required|string',
//         'total'            => 'required|numeric|min:0',
//         'discount'         => 'nullable|numeric|min:0',
//         'visa_fee'         => 'nullable|numeric|min:0',
//         'service_charge'   => 'nullable|numeric|min:0',
//         'safi'             => 'nullable|numeric|min:0',
//         'atol'             => 'nullable|numeric|min:0',
//         'credit_charge'    => 'nullable|numeric|min:0',
//         'penalty'          => 'nullable|numeric|min:0',
//         'admin'            => 'nullable|numeric|min:0',
//         'misc'             => 'nullable|numeric|min:0',
//     ]);

//     $agency   = $this->agencyService->getAgencyData();
//     $agencyId = $agency->id ?? null;

//     // Find deduction with invoice relation
//     $deduction = Deduction::with('invoice', 'visabooking')
//         ->where('id', $request->application_id)
//         ->where('agency_id', $agencyId)
//         ->first();

//            ->where('applicationworkin_status', 'Cancell ')
//                     ->first();
//     if (!$deduction) {
//         return back()->with('error', 'Invoice not found.');
//     }

//     // Update deduction status
//     $deduction->invoicestatus = 'Canceled';
//     $deduction->save();

//     // Format invoice number with "R" if original exists
//     $number = $deduction->invoice_number ?? null;
//     if ($number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)) {
//         $formattedInvoice = $matches[1] . 'R' . $matches[2];
//     } else {
//         $formattedInvoice = 'INV' . uniqid();
//     }

//     // Prepare invoice update data
//     $invoiceData = [
//         'receiver_name'      => $request->receiver_name ?? 'Dummy Client',
//         'invoice_date'       => $request->invoice_date ?? now()->format('Y-m-d'),
//         'due_date'           => $request->invoice_date ?? now()->addDays(14)->format('Y-m-d'),
//         'different_name'     => $request->different_name ?? null,
//         'address'            => $request->address ?? 'Dummy Address',
//         'bookingid'          => $deduction->id,
//         'visa_applicant'     => $request->visa_applicant_name ?? 'Self',
//         'service_id'         => $request->service_id ?? null,
//         'billing_id'         => $request->billing_id ?? null,
//         'applicant_id'       => $request->applicant_id ?? null,
//         'amount'             => $request->total ?? '0',
//         'discount'           => $request->discount ?? 0,
//         'payment_type'       => $request->payment_mode ?? 'CASH',
//         'visa_fee'           => $request->visa_fee ?? 0,
//         'service_charge'     => $request->service_charge ?? 0,
//         'new_invoice_number' => $formattedInvoice,
//         'status'             => 'Canceled',
//         'new_price'          => $request->total ?? '0',
//         'type'               => 'agency',
//     ];

//     // Update existing invoice or create new one
//     if ($deduction->invoice) {
//         $deduction->invoice->update($invoiceData);
//         $invoice = $deduction->invoice;
//     } else {
//         $invoice = $deduction->invoice()->create($invoiceData);
//     }

//     // Save or update cancel invoice record
//     $cancelInvoice = CancelInvoice::firstOrNew([
//         'invoice_id' => $invoice->id,
//     ]);

//     $cancelInvoice->application_number = $formattedInvoice;
//     $cancelInvoice->type               = 'manual';
//     $cancelInvoice->remark             = $request->remark ?? null;
//     $cancelInvoice->reason             = $request->reason ?? null;
//     $cancelInvoice->cancelled_by       = Auth::id();
//     $cancelInvoice->status             = 1;
//     $cancelInvoice->amount             = $request->total ?? 0;
//     $cancelInvoice->safi               = $request->safi ?? 0;
//     $cancelInvoice->atol               = $request->atol ?? 0;
//     $cancelInvoice->credit_charge      = $request->credit_charge ?? 0;
//     $cancelInvoice->penalty            = $request->penalty ?? 0;
//     $cancelInvoice->admin              = $request->admin ?? 0;
//     $cancelInvoice->misc               = $request->misc ?? 0;
//     $cancelInvoice->cancelled_date     = now();

//     $cancelInvoice->save();

//     return redirect()
//         ->route('invoice.all', ['type' => 'agencies'])
//         ->with('success', 'Invoice canceled successfully.');
// }
public function hsupdateRefundInvoice(Request $request)
{
    $request->validate([
        'application_id'   => 'required|exists:deductions,id',
        'reason'           => 'nullable|string',
        'remark'           => 'nullable|string',
        'refundamount'     => 'nullable|numeric|min:0',
        'payment_mode'     => 'required|string',
        'total'            => 'required|numeric|min:0',
        'discount'         => 'nullable|numeric|min:0',
        'visa_fee'         => 'nullable|numeric|min:0',
        'service_charge'   => 'nullable|numeric|min:0',
        'safi'             => 'nullable|numeric|min:0',
        'atol'             => 'nullable|numeric|min:0',
        'credit_charge'    => 'nullable|numeric|min:0',
        'penalty'          => 'nullable|numeric|min:0',
        'admin'            => 'nullable|numeric|min:0',
        'misc'             => 'nullable|numeric|min:0',
    ]);

    $agency   = $this->agencyService->getAgencyData();
    $agencyId = $agency->id ?? null;

    // Load deduction with invoice and visa booking
    $deduction = Deduction::with(['invoice', 'visabooking'])
        ->where('id', $request->application_id)
        ->where('agency_id', $agencyId)
        ->first();

    if (!$deduction) {
        return back()->with('error', 'Invoice not found.');
    }

    // Cancel visa booking if exists
    if ($deduction->visabooking) {
        $deduction->visabooking->update([
            'document_status'        => 'Canceled',
            'applicationworkin_status'=> 'Canceled',
        ]);
    }

    // Update deduction status
    $deduction->invoicestatus = 'Refunded';
    $deduction->save();

    // Format invoice number with "R" if original exists
    $number = $deduction->invoice_number ?? null;
    if ($number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)) {
        // For patterns like CLDAIR001, insert R after CLDAR to get CLDARRIR001
        if (strpos($matches[1], 'CLDAR') === 0) {
            $prefix = 'CLDAR';
            $suffix = substr($matches[1], 5); // Get everything after CLDAR
            $formattedInvoice = $prefix . 'R' . $suffix . $matches[2];
        } else {
            // For other patterns, add R at the end of letters
            $formattedInvoice = $matches[1] . 'R' . $matches[2];
        }
    } else {
        $formattedInvoice = 'INV' . uniqid();
    }

    // Prepare invoice data
    $invoiceData = [
        'receiver_name'      => $request->receiver_name ?? 'Dummy Client',
        'invoice_date'       => $request->invoice_date ?? now()->format('Y-m-d'),
        'due_date'           => $request->invoice_date ?? now()->addDays(14)->format('Y-m-d'),
        'different_name'     => $request->different_name ?? null,
        'address'            => $request->address ?? 'Dummy Address',
        'bookingid'          => $deduction->id,
        'visa_applicant'     => $request->visa_applicant_name ?? 'Self',
        'service_id'         => $request->service_id ?? null,
        'billing_id'         => $request->billing_id ?? null,
        'applicant_id'       => $request->applicant_id ?? null,
        'amount'             => $request->total ?? 0,
        'discount'           => $request->discount ?? 0,
        'payment_type'       => $request->payment_mode ?? 'CASH',
        'visa_fee'           => $request->visa_fee ?? 0,
        'service_charge'     => $request->service_charge ?? 0,
        'new_invoice_number' => $formattedInvoice,
        'status'             => 'Canceled',
        'new_price'          => $request->total ?? 0,
        'type'               => 'agency',
    ];

    // Update or create invoice
    $invoice = $deduction->invoice
        ? tap($deduction->invoice)->update($invoiceData)
        : $deduction->invoice()->create($invoiceData);

    // Save or update cancel invoice record
    CancelInvoice::updateOrCreate(
        ['invoice_id' => $invoice->id],
        [
            'application_number' => $formattedInvoice,
            'type'               => 'manual',
            'remark'             => $request->remark ?? null,
            'reason'             => $request->reason ?? null,
            'cancelled_by'       => Auth::id(),
            'status'             => 1,
            'amount'             => $request->total ?? 0,
            'safi'               => $request->safi ?? 0,
            'atol'               => $request->atol ?? 0,
            'credit_charge'      => $request->credit_charge ?? 0,
            'penalty'            => $request->penalty ?? 0,
            'admin'              => $request->admin ?? 0,
            'misc'               => $request->misc ?? 0,
            'cancelled_date'     => now(),
        ]
    );

    return redirect()
        ->route('invoice.all', ['type' => 'agencies'])
        ->with('success', 'Invoice canceled successfully.');
}



public function processRefund(Request $request)
{
    $request->validate([
        'invoice_id' => 'required|exists:deductions,id',
        'refund_amount' => 'required|numeric|min:0',
        'safi' => 'nullable|numeric|min:0',
        'atol' => 'nullable|numeric|min:0',
        'credit_charge' => 'nullable|numeric|min:0',
        'service_charges' => 'nullable|numeric|min:0',
        'penalty_charges' => 'nullable|numeric|min:0',
        'admin_charges' => 'nullable|numeric|min:0',
        'misc_charges' => 'nullable|numeric|min:0',
        'remarks' => 'nullable|string|max:1000',
    ]);

    $agency = $this->agencyService->getAgencyData();
    
    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Find the deduction/invoice
    $deduction = Deduction::with(['invoice', 'visabooking'])
        ->where('id', $request->invoice_id)
        ->where('agency_id', $agency->id)
        ->first();

    if (!$deduction) {
        return back()->with('error', 'Invoice not found.');
    }

    // Cancel visa booking if exists
    if ($deduction->visabooking) {
        $deduction->visabooking->update([
            'document_status'        => 'Refunded',
            'applicationworkin_status'=> 'Refunded',
        ]);
    }

    // Update deduction status
    $deduction->invoicestatus = 'Refunded';
    $deduction->save();

    // Format invoice number with "R" if original exists
    $number = $deduction->invoice_number ?? null;
    if ($number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)) {
        // For patterns like CLDAIR001, insert R after CLDAR to get CLDARRIR001
        if (strpos($matches[1], 'CLDAR') === 0) {
            $prefix = 'CLDAR';
            $suffix = substr($matches[1], 5); // Get everything after CLDAR
            $formattedInvoice = $prefix . 'R' . $suffix . $matches[2];
        } else {
            // For other patterns, add R at the end of letters
            $formattedInvoice = $matches[1] . 'R' . $matches[2];
        }
    } else {
        $formattedInvoice = 'INV' . uniqid();
    }

    // Prepare invoice data
    $invoiceData = [
        'receiver_name'      => $deduction->visaBooking->clint->client_name ?? 'N/A',
        'invoice_date'       => now()->format('Y-m-d'),
        'due_date'           => now()->addDays(14)->format('Y-m-d'),
        'address'            => $deduction->visaBooking->clint->permanent_address ?? 'N/A',
        'bookingid'          => $deduction->id,
        'visa_applicant'     => $deduction->visaBooking->clint->client_name ?? 'Self',
        'amount'             => $request->refund_amount,
        'discount'           => 0,
        'payment_type'       => 'REFUND',
        'visa_fee'           => 0,
        'service_charge'     => 0,
        'new_invoice_number' => $formattedInvoice,
        'status'             => 'Refunded',
        'new_price'          => $request->refund_amount,
        'type'               => 'agency',
    ];

    // Update or create invoice
    $invoice = $deduction->invoice
        ? tap($deduction->invoice)->update($invoiceData)
        : $deduction->invoice()->create($invoiceData);

    // Save or update cancel invoice record for refund
    CancelInvoice::updateOrCreate(
        ['invoice_id' => $invoice->id],
        [
            'application_number' => $formattedInvoice,
            'type'               => 'refund',
            'remark'             => $request->remarks ?? null,
            'reason'             => 'Refund Processed',
            'cancelled_by'       => Auth::id(),
            'status'             => 1,
            'amount'             => $request->refund_amount,
            'safi'               => $request->safi ?? 0,
            'atol'               => $request->atol ?? 0,
            'credit_charge'      => $request->credit_charge ?? 0,
            'penalty'            => $request->penalty_charges ?? 0,
            'admin'              => $request->admin_charges ?? 0,
            'misc'               => $request->misc_charges ?? 0,
            'cancelled_date'     => now(),
        ]
    );

    return redirect()
        ->route('invoice.all', ['type' => 'agencies'])
        ->with('success', 'Refund processed successfully.');
}

public function processPayment(Request $request)
{
    $request->validate([
        'invoice_id' => 'required|exists:deductions,id',
        'receiver_name' => 'required|string|max:255',
        'receiver_address' => 'required|string|max:1000',
        'card_last_4_digit' => 'nullable|string|max:4',
        'payment_methods' => 'required|array|min:1',
        'payment_methods.*' => 'in:credit_card,debit_card,cash,bank_transfer',
        'credit_card_amount' => 'nullable|numeric|min:0',
        'debit_card_amount' => 'nullable|numeric|min:0',
        'cash_amount' => 'nullable|numeric|min:0',
        'bank_transfer_amount' => 'nullable|numeric|min:0',
    ]);

    $agency = $this->agencyService->getAgencyData();
    
    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Find the deduction/invoice
    $deduction = Deduction::with(['invoice', 'visabooking'])
        ->where('id', $request->invoice_id)
        ->where('agency_id', $agency->id)
        ->first();

    if (!$deduction) {
        return back()->with('error', 'Invoice not found.');
    }

    // Calculate total payment amount
    $totalPayment = 0;
    $paymentMethods = [];
    
    if (in_array('credit_card', $request->payment_methods) && $request->credit_card_amount) {
        $totalPayment += $request->credit_card_amount;
        $paymentMethods['credit_card'] = $request->credit_card_amount;
    }
    
    if (in_array('debit_card', $request->payment_methods) && $request->debit_card_amount) {
        $totalPayment += $request->debit_card_amount;
        $paymentMethods['debit_card'] = $request->debit_card_amount;
    }
    
    if (in_array('cash', $request->payment_methods) && $request->cash_amount) {
        $totalPayment += $request->cash_amount;
        $paymentMethods['cash'] = $request->cash_amount;
    }
    
    if (in_array('bank_transfer', $request->payment_methods) && $request->bank_transfer_amount) {
        $totalPayment += $request->bank_transfer_amount;
        $paymentMethods['bank_transfer'] = $request->bank_transfer_amount;
    }

    if ($totalPayment <= 0) {
        return back()->with('error', 'Please enter valid payment amounts.');
    }

    // Update deduction status to paid
    $deduction->invoicestatus = 'Paid';
    $deduction->save();

    // Update visa booking status if exists
    if ($deduction->visabooking) {
        $deduction->visabooking->update([
            'document_status' => 'Paid',
            'applicationworkin_status' => 'Paid',
        ]);
    }

    // Format invoice number with "P" for payment
    $number = $deduction->invoice_number ?? null;
    $formattedInvoice = $number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)
        ? $matches[1] . 'P' . $matches[2]
        : 'INV' . uniqid();

    // Prepare invoice data for payment
    $invoiceData = [
        'receiver_name'      => $request->receiver_name,
        'invoice_date'       => now()->format('Y-m-d'),
        'due_date'           => now()->format('Y-m-d'),
        'address'            => $request->receiver_address,
        'bookingid'          => $deduction->id,
        'visa_applicant'     => $request->receiver_name,
        'amount'             => $totalPayment,
        'discount'           => 0,
        'payment_type'       => 'PAYMENT',
        'visa_fee'           => 0,
        'service_charge'     => 0,
        'new_invoice_number' => $formattedInvoice,
        'status'             => 'Paid',
        'new_price'          => $totalPayment,
        'type'               => 'agency',
        'payment_methods'    => json_encode($paymentMethods),
        'card_last_4_digit'  => $request->card_last_4_digit,
    ];

    // Update or create invoice
    $invoice = $deduction->invoice
        ? tap($deduction->invoice)->update($invoiceData)
        : $deduction->invoice()->create($invoiceData);

    // Create payment record
    CancelInvoice::create([
        'invoice_id'         => $invoice->id,
        'application_number' => $formattedInvoice,
        'type'               => 'payment',
        'remark'             => 'Payment processed via: ' . implode(', ', array_keys($paymentMethods)),
        'reason'             => 'Payment Processed',
        'cancelled_by'       => Auth::id(),
        'status'             => 1,
        'amount'             => $totalPayment,
        'cancelled_date'     => now(),
    ]);

    return redirect()
        ->route('invoice.all', ['type' => 'agencies'])
        ->with('success', 'Payment processed successfully.');
}

public function hsrefundInvoice(Request $request, $type)
{
    // Step 1: Get logged-in agency
    $agency = $this->agencyService->getAgencyData();
    

    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Step 2: Build query (canceled/refunded invoices for refund processing)
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
        'invoice.cancel_invoice',
        'invoice.cancel_invoices',
        'hotelDetails'

    ])
    ->where('agency_id', $agency->id)
    ->whereIn('invoicestatus', ['canceled', 'Refunded']);

    // Step 3: Get invoices (pagination optional)
    $perPage = $request->filled('per_page') && is_numeric($request->per_page)
        ? (int) $request->per_page
        : null;

    $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();

    // Step 4: Enrich invoices with client info
    $invoices = $this->agencyService->getClientinfo($invoices);
    
    // Step 4.5: Get retail invoices for adjustment modal
    $retailInvoices = Deduction::with([
        'service_name',
        'agency',
        'visaBooking',
        'visaBooking.clint',
        'invoice'
    ])
    ->where('agency_id', $agency->id)
    ->whereNotIn('invoicestatus', ['Refunded', 'Canceled', 'canceled', 'refunded'])
    ->orderByDesc('id')
    ->get();
    
    // Enrich retail invoices with client info
    $retailInvoices = $this->agencyService->getClientinfo($retailInvoices);
 
    // Step 5: Load service list (optional)
    $services = Service::whereIn('id', [1, 2, 3])->get();

    // Step 6: Render view based on type
    if ($type === 'agencies') {
        return view('agencies.pages.invoicehandling.indexcancel-invoice', [
            'countries' => $countries ?? [],
            'invoices'  => $invoices,
            'retailInvoices' => $retailInvoices,
            'services'  => $services ?? [],
        ]);
    }

    // Step 7: Fallback 404
    abort(404);
}

public function hsCanceledInvoice(Request $request, $type)
{
    // Step 1: Get logged-in agency
    $agency = $this->agencyService->getAgencyData();

    if (!$agency) {
        abort(403, 'Unauthorized. Agency not found.');
    }

    // Step 2: Build query (only canceled invoices, no filters)
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
        'invoice.cancel_invoice',
        'hotelDetails'

    ])
    ->where('agency_id', $agency->id)
    ->where('invoicestatus', 'Canceled');

    // Step 3: Get invoices (pagination optional)
    $perPage = $request->filled('per_page') && is_numeric($request->per_page)
        ? (int) $request->per_page
        : null;

    $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();

    // Step 4: Enrich invoices with client info
    $invoices = $this->agencyService->getClientinfo($invoices);
 
    // Step 5: Load service list (optional)
    $services = Service::whereIn('id', [1, 2, 3])->get();

    // Step 6: Render view based on type
    if ($type === 'agencies') {
        return view('agencies.pages.invoicehandling.canceled-invoices', [
            'countries' => $countries ?? [],
            'invoices'  => $invoices,
            'services'  => $services ?? [],
        ]);
    }

    // Step 7: Fallback 404
    abort(404);
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
        ->where(function ($q) {
            $q->whereNull('invoicestatus')
              ->orWhereNotIn('invoicestatus', ['canceled', 'Refunded']);
        })
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
                ->orWhereNotIn('invoicestatus', ['canceled', 'Refunded']);
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

//     public function hsAllinvoice(Request $request)
// {
//     $perPage = $request->filled('per_page') && is_numeric($request->per_page)
//         ? (int) $request->per_page
//         : null;

//     $agency = $this->agencyService->getAgencyData(); // returns null for superadmin, and agency model for agency users

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
//         $q->whereNull('status')
//           ->orWhereNotIn('status', ['canceled']);
//     });

//     // ✅ Filter by agency if agency is logged in
//     if ($agency) {
//         $invoicesQuery->where('agency_id', $agency->id);
//     }

//     $invoices = $perPage ? $invoicesQuery->paginate($perPage) : $invoicesQuery->get();

//     return view('superadmin.pages.invoicehandling.allinvoices', compact('invoices'));
// }
public function hsAllinvoice(Request $request)
{
    $perPage = $request->filled('per_page') && is_numeric($request->per_page)
        ? (int) $request->per_page
        : null;

    $agency = $this->agencyService->getAgencyData(); // null for superadmin, agency model for agency users

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
        $q->whereNull('invoicestatus')   // Deduction table column
          ->orWhereNotIn('invoicestatus', ['canceled', 'Refunded']); // Deduction table column
    });
   

    // ✅ Filter by agency if agency is logged in
    if ($agency) {
        $invoicesQuery->where('agency_id', $agency->id);
    }

    // ✅ Apply filters
    // 🔎 Filter by invoice relation

  
 if ($request->filled('status') || $request->filled('date_from') || $request->filled('date_to') || $request->filled('search')) {
    $invoicesQuery->where(function ($q) use ($request) {
        // Handle status filtering
        if ($request->filled('status')) {
            if ($request->status === 'Adjusted') {
                // Filter by invoicestatus in deductions table for Adjusted
                $q->where('invoicestatus', 'Adjusted');
            } else {
                // Filter by status in invoice table for other statuses
                $q->whereHas('invoice', function ($subQ) use ($request) {
                    $subQ->where('status', $request->status);
                });
            }
        } else {
            // Apply other filters
            $q->whereHas('invoice', function ($subQ) use ($request) {
                if ($request->filled('date_from')) {
                    $subQ->whereDate('created_at', '>=', $request->date_from);
                }
                if ($request->filled('date_to')) {
                    $subQ->whereDate('created_at', '<=', $request->date_to);
                }
                if ($request->filled('search')) {
                    $search = $request->search;
                    $subQ->where(function ($innerQ) use ($search) {
                        $innerQ->where('invoice_no', 'like', "%{$search}%")
                               ->orWhere('client_name', 'like', "%{$search}%");
                    });
                }
            })
            ->orWhereDoesntHave('invoice'); // ✅ include rows without invoice
        }
    });
}
    $invoices = $perPage
        ? $invoicesQuery->paginate($perPage)->appends($request->query())
        : $invoicesQuery->get();
     

    return view('superadmin.pages.invoicehandling.allinvoices', compact('invoices'));
}

 

    public function hseditInvoice($id){
        
    $invoice = Deduction::with(['service_name', 'visaBooking.clint', 'visaBooking.origin', 'visaBooking.destination', 'visaBooking.visasubtype', 'visaBooking.visa', 'invoice'])->findOrFail($id);
  
    $clientData=$this->visaRepository->bookingDataById($invoice->flight_booking_id);
    // Check if user is agency or superadmin
    $agency = $this->agencyService->getAgencyData();
    
    if ($agency) {
        // Agency user - return agency view
        return view('agencies.pages.invoicehandling.editinvoice', compact('invoice'));
    } else {
        // Superadmin user - return superadmin view
        return view('superadmin.pages.invoicehandling.editinvoice', compact('invoice'));
    }
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

        // Load additional relationships for invoice display
        $booking->load('deduction.invoice', 'origin', 'destination', 'visasubtype', 'visa', 'clint.clientinfo');
       
        return view('superadmin.pages.invoicehandling.invoiceview', [
            'booking' => $booking,
            'termconditon' => $termconditon,
        ]);
    }

    public function hsRetailInvoices(Request $request)
    {
        // Load recent retail invoices from deductions with related booking
        $invoices = Deduction::with(['visaBooking'])
            ->orderByDesc('id')
            ->limit(100)
            ->get();
            

        return view('agencies.pages.invoicehandling.retail-invoices', compact('invoices'));
    }

    public function hsSuperadminRetailInvoiceView($id)
    {
        $booking = app(\App\Repositories\DocumentSignRepository::class)->checkSignDocument($id);
        $termconditon = app(\App\Repositories\TermConditionRepository::class)->allTeamTypes();

        return view('superadmin.pages.invoicehandling.retailinvoices', [
            'booking' => $booking,
            'termconditon' => $termconditon,
        ]);
    }

    public function processRefundPayment(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:deductions,id',
            'card_last_4_digit' => 'nullable|string|max:4',
            'credit_card_amount' => 'nullable|numeric|min:0',
            'debit_card_amount' => 'nullable|numeric|min:0',
            'cash_amount' => 'nullable|numeric|min:0',
            'bank_transfer_amount' => 'nullable|numeric|min:0',
            'remarks' => 'required|string|max:1000',
        ]);

        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            abort(403, 'Unauthorized. Agency not found.');
        }

        // Find the deduction/invoice
        $deduction = Deduction::with(['invoice', 'invoice.cancel_invoice', 'visabooking'])
            ->where('id', $request->invoice_id)
            ->where('agency_id', $agency->id)
            ->first();

        if (!$deduction) {
            return back()->with('error', 'Invoice not found.');
        }

        // Check if payment has already been processed
        if ($deduction->invoice->cancel_invoice && $deduction->invoice->cancel_invoice->type === 'payment') {
            return back()->with('error', 'Payment has already been processed for this refund.');
        }

        // Calculate refund amount
        $paidAmount = $deduction->amount ?? 0;
        $cancelInvoice = $deduction->invoice->cancel_invoice;
        $totalCharges = 0;
        
        if ($cancelInvoice) {
            $totalCharges = ($cancelInvoice->safi ?? 0) + 
                           ($cancelInvoice->atol ?? 0) + 
                           ($cancelInvoice->credit_charge ?? 0) + 
                           ($cancelInvoice->penalty ?? 0) + 
                           ($cancelInvoice->admin ?? 0) + 
                           ($cancelInvoice->misc ?? 0);
        }
        
        $refundAmount = $paidAmount - $totalCharges;

        if ($refundAmount <= 0) {
            return back()->with('error', 'Invalid refund amount calculated.');
        }

        // Calculate total payment amount from all methods
        $totalPayment = 0;
        $paymentMethods = [];
        
        if ($request->credit_card_amount && $request->credit_card_amount > 0) {
            $totalPayment += $request->credit_card_amount;
            $paymentMethods['credit_card'] = $request->credit_card_amount;
        }
        
        if ($request->debit_card_amount && $request->debit_card_amount > 0) {
            $totalPayment += $request->debit_card_amount;
            $paymentMethods['debit_card'] = $request->debit_card_amount;
        }
        
        if ($request->cash_amount && $request->cash_amount > 0) {
            $totalPayment += $request->cash_amount;
            $paymentMethods['cash'] = $request->cash_amount;
        }
        
        if ($request->bank_transfer_amount && $request->bank_transfer_amount > 0) {
            $totalPayment += $request->bank_transfer_amount;
            $paymentMethods['bank_transfer'] = $request->bank_transfer_amount;
        }

        if ($totalPayment <= 0) {
            return back()->with('error', 'Please enter at least one payment amount.');
        }

        // Format invoice number with "P" for payment
        $number = $deduction->invoice_number ?? null;
        $formattedInvoice = $number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)
            ? $matches[1] . 'P' . $matches[2]
            : 'PAY' . uniqid();

        // Create payment record in cancel_invoices table
        CancelInvoice::create([
            'invoice_id'         => $deduction->invoice->id,
            'application_number' => $formattedInvoice,
            'type'               => 'payment',
            'remark'             => $request->remarks,
            'reason'             => 'Direct Refund - ' . implode(', ', array_keys($paymentMethods)),
            'cancelled_by'       => Auth::id(),
            'status'             => 1,
            'amount'             => $totalPayment,
            'cancelled_date'     => now(),
        ]);

        // Update visa booking status if exists
        if ($deduction->visabooking) {
            $deduction->visabooking->update([
                'document_status' => 'Refund Paid',
                'applicationworkin_status' => 'Refund Paid',
            ]);
        }

        return redirect()
            ->route('invoice.refund', ['type' => 'agencies'])
            ->with('success', 'Direct refund processed successfully. Reference: ' . $formattedInvoice . ' | Amount: £' . number_format($totalPayment, 2));
    }

    public function processAdjustment(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:deductions,id',
            'selected_application_id' => 'nullable|integer',
            'processed_by' => 'nullable|string|max:255',
            'internal_notes' => 'nullable|string|max:1000',
        ]);

        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            abort(403, 'Unauthorized. Agency not found.');
        }

        // Find the main deduction/invoice
        $deduction = Deduction::with(['invoice', 'visabooking'])
            ->where('id', $request->invoice_id)
            ->where('agency_id', $agency->id)
            ->first();

        if (!$deduction) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Invoice not found.'], 404);
            }
            return back()->with('error', 'Invoice not found.');
        }

        // Get selected application details if provided
        $selectedApplication = null;
        $selectedApplicationData = [];
        
        if ($request->selected_application_id) {
            $selectedApplication = VisaBooking::with(['clint'])
                ->where('id', $request->selected_application_id)
                ->where('agency_id', $agency->id)
                ->first();
                
            if (!$selectedApplication) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Selected application not found or does not belong to your agency.'], 404);
                }
                return back()->with('error', 'Selected application not found or does not belong to your agency.');
            }
            
            // Set database connection for client details
            $this->agencyService->setDatabaseConnection($agency->database_name);
            
            $clientDetails = \App\Models\ClientDetails::on('user_database')
                ->where('id', $selectedApplication->client_id)
                ->first();
            
            $selectedApplicationData = [
                'id' => $selectedApplication->id,
                'application_number' => $selectedApplication->application_number,
                'client_name' => $clientDetails->client_name ?? 'N/A',
                'amount' => $selectedApplication->total_amount ?? 0,
            ];
            
            // Update selected application status to paid
            $selectedApplication->update([
                'payment_status' => 'paid',
                'document_status' => 'Paid',
                'applicationworkin_status' => 'Paid',
            ]);
        }

        // Update deduction status to adjusted
        $deduction->invoicestatus = 'Adjusted';
        $deduction->save();

        // Format invoice number with "A" for adjustment
        $number = $deduction->invoice_number ?? null;
        $formattedInvoice = $number && preg_match('/^([A-Za-z]+)(\d+)$/', $number, $matches)
            ? $matches[1] . 'A' . $matches[2]
            : 'ADJ' . uniqid();

        // Prepare invoice data for adjustment
        $invoiceData = [
            'receiver_name'      => $deduction->visaBooking->clint->client_name ?? 'N/A',
            'invoice_date'       => now()->format('Y-m-d'),
            'due_date'           => now()->addDays(14)->format('Y-m-d'),
            'address'            => $deduction->visaBooking->clint->permanent_address ?? 'N/A',
            'bookingid'          => $deduction->id,
            'visa_applicant'     => $deduction->visaBooking->clint->client_name ?? 'Self',
            'amount'             => $deduction->amount ?? 0,
            'discount'           => 0,
            'payment_type'       => 'ADJUSTMENT',
            'visa_fee'           => 0,
            'service_charge'     => 0,
            'new_invoice_number' => $formattedInvoice,
            'status'             => 'Adjusted',
            'new_price'          => $deduction->amount ?? 0,
            'type'               => 'agency',
        ];

        // Update or create invoice
        $invoice = $deduction->invoice
            ? tap($deduction->invoice)->update($invoiceData)
            : $deduction->invoice()->create($invoiceData);

        // Create adjustment record in cancel_invoices table
        CancelInvoice::create([
            'invoice_id'         => $invoice->id,
            'application_number' => $formattedInvoice,
            'type'               => 'adjustment',
            'remark'             => $request->internal_notes,
            'reason'             => 'Invoice Adjustment Process',
            'cancelled_by'       => Auth::id(),
            'status'             => 1,
            'amount'             => $deduction->amount ?? 0,
            'cancelled_date'     => now(),
        ]);

        // Get the main database user ID if available
        $mainDbUserId = null;
        try {
            // Check if current user exists in main database
            $mainUser = \App\Models\User::where('email', Auth::user()->email)->first();
            $mainDbUserId = $mainUser ? $mainUser->id : null;
        } catch (\Exception $e) {
            // If there's any issue getting the main user, just set to null
            $mainDbUserId = null;
        }

        // Create detailed adjustment record in invoice_adjustments table
        InvoiceAdjustment::create([
            'original_invoice_id' => $deduction->id,
            'selected_application_id' => $selectedApplication ? $selectedApplication->id : null,
            'agency_id' => $agency->id,
            'adjustment_number' => $formattedInvoice,
            'original_invoice_number' => $deduction->invoice_number,
            'original_amount' => $deduction->amount ?? 0,
            'adjusted_amount' => $deduction->amount ?? 0,
            'selected_application_number' => $selectedApplicationData['application_number'] ?? null,
            'selected_client_name' => $selectedApplicationData['client_name'] ?? null,
            'selected_application_amount' => $selectedApplicationData['amount'] ?? null,
            'processed_by' => $request->processed_by,
            'internal_notes' => $request->internal_notes,
            'status' => 'completed',
            'adjustment_type' => $selectedApplication ? 'application_adjustment' : 'manual_adjustment',
            'processed_by_user_id' => $mainDbUserId,
            'adjustment_date' => now(),
        ]);

        // Update visa booking status if exists
        if ($deduction->visabooking) {
            $deduction->visabooking->update([
                'document_status' => 'Adjusted',
                'applicationworkin_status' => 'Adjusted',
            ]);
        }

        // Create additional record linking adjustment to selected application
        if ($selectedApplication) {
            CancelInvoice::create([
                'invoice_id'         => $invoice->id,
                'application_number' => $formattedInvoice,
                'type'               => 'adjustment_application',
                'remark'             => "Adjustment applied to application: {$selectedApplicationData['application_number']}",
                'reason'             => 'Application payment via adjustment',
                'cancelled_by'       => Auth::id(),
                'status'             => 1,
                'amount'             => $selectedApplicationData['amount'] ?? 0,
                'cancelled_date'     => now(),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Invoice adjustment processed successfully.',
                'adjustment_number' => $formattedInvoice,
                'amount' => number_format($deduction->amount ?? 0, 2),
                'selected_application' => $selectedApplicationData
            ]);
        }

        return redirect()
            ->route('invoice.refund', ['type' => 'agencies'])
            ->with('success', 'Invoice adjustment processed successfully. Reference: ' . $formattedInvoice . ' | Amount: £' . number_format($deduction->amount ?? 0, 2));
    }

    /**
     * Get adjustment data for a specific invoice
     */
    public function getAdjustmentData($invoiceId)
    {
        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            return response()->json(['error' => 'Unauthorized. Agency not found.'], 403);
        }

        $adjustment = InvoiceAdjustment::with(['originalInvoice', 'selectedApplication', 'processedByUser'])
            ->where('original_invoice_id', $invoiceId)
            ->where('agency_id', $agency->id)
            ->first();

        if (!$adjustment) {
            return response()->json(['error' => 'No adjustment data found.'], 404);
        }

        return response()->json([
            'success' => true,
            'adjustment' => [
                'id' => $adjustment->id,
                'adjustment_number' => $adjustment->adjustment_number,
                'original_invoice_number' => $adjustment->original_invoice_number,
                'original_amount' => $adjustment->formatted_original_amount,
                'adjusted_amount' => $adjustment->formatted_adjusted_amount,
                'selected_application_number' => $adjustment->selected_application_number,
                'selected_client_name' => $adjustment->selected_client_name,
                'selected_application_amount' => $adjustment->formatted_selected_application_amount,
                'processed_by' => $adjustment->processed_by,
                'internal_notes' => $adjustment->internal_notes,
                'status' => $adjustment->status,
                'adjustment_type' => $adjustment->adjustment_type,
                'adjustment_date' => $adjustment->adjustment_date->format('Y-m-d H:i:s'),
                'processed_by_user' => $adjustment->processedByUser ? $adjustment->processedByUser->name : null,
            ]
        ]);
    }

    /**
     * Display all adjustments for the agency
     */
    public function adjustmentHistory(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        
        if (!$agency) {
            abort(403, 'Unauthorized. Agency not found.');
        }

        $adjustments = InvoiceAdjustment::with(['originalInvoice', 'selectedApplication', 'processedByUser'])
            ->forAgency($agency->id)
            ->orderBy('adjustment_date', 'desc')
            ->paginate(20);

        return view('agencies.pages.invoicehandling.adjustment-history', compact('adjustments'));
    }

}
