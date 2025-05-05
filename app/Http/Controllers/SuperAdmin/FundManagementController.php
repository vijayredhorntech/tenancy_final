<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;

use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use App\Services\AgencyService;
use App\Exports\FundExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF; 



class FundManagementController extends Controller
{
    
 
    protected $agencyService;
    public function __construct(AgencyService $agencyService)
    {
       
        $this->agencyService = $agencyService;
    }

    /**** Add function for Fund ****/

 public function him_addfund_agency($fid){
    $id = Auth::user()->id;
    $user = User::find($id);
    // $agency=Agency::where('id',$fid)->first();
    $agency=Agency::with('domains','userAssignments.service','balance')->where('id',$fid)->first();
    // dd($agency);
    $service=Service::get();
  
    // dd($agency);
    return view('superadmin.pages.agencies.addfund',[
        'user_data' => $user,
        'services' => $service,
        'agency'=>$agency
       ]);

 }

 /**** Store blanace in the  balance and add table ****/
 public function him_storefund(Request $request)
{

    $uid = Auth::id(); // Get authenticated user ID

    // Validate input data
    $validatedData = $request->validate([
        'id' => 'required|integer',
        'add_ammount' => 'required|numeric|min:1', // Fixed key name for consistency
    ]);


    try {
        DB::beginTransaction();

        // Create a new AddBalance record
        $addbalance = new AddBalance();
        $addbalance->agency_id = $request->id;
        $addbalance->amount = $request->add_ammount;
        $addbalance->added_date = now();

        // Check if it's a credit note or regular transaction
        if ($request->modepayment == 'creditnote') {
         
            $addbalance->status = 1;
        } else {
         
            $addbalance->status = 0;
            $addbalance->payment_number = $request->payment_number;
            $addbalance->remark = $request->remark;
        }
        $invoice_number = 'INV-' . now()->format('Ymd') . '-' . str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $addbalance->invoice_number = $invoice_number;
        $addbalance->payment_type = $request->modepayment;
        $addbalance->save();
        // Save the record to generate an ID
      


         // Save the invoice number update

        // Update or create balance record (only if NOT a credit note)
        if ($request->modepayment != 'creditnote') {
            $balance = Balance::where('agency_id', $request->id)->first();

            if ($balance) {
                $balance->balance += $request->add_ammount;
                $message = 'Balance updated successfully.';
            } else {
                $balance = new Balance();
                $balance->agency_id = $request->id;
                $balance->balance = $request->add_ammount;
                $message = 'Balance created successfully.';
            }

            $balance->created_user_id = $uid;
            $balance->save();
        }
 
        DB::commit();
        return redirect()->back()->with('success', $message);
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to update balance: ' . $e->getMessage());
    }
}



 /****Deduction ***/
 public function him_deduction(Request $request)
{
    $service_id = $request->service_id;
    $agency_id = $request->agency_id;
    $amount = $request->add_ammount;

    // Fetch balance record
    $balance = Balance::where('agency_id', $agency_id)->first();

    // Check if balance record exists
    if (!$balance) {
        return back()->with('error', 'Balance record not found.');
    }

    $fundRemaining = $balance->balance;

    // Ensure agency has enough balance
    if ($amount > $fundRemaining) {
        return back()->with('error', 'Insufficient balance.');
    } else {
        // Deduct amount and save deduction record
        $deduction = new Deduction();
        $deduction->agency_id = $agency_id;
        $deduction->service = $service_id;
        $deduction->amount = $amount;
        $deduction->date = now();
        $deduction->save();

        // Update balance
        $balance->balance -= $amount;
        $balance->save();

        return back()->with('success', 'Amount deducted successfully.');
    }
}


/***Approvel ***/

public function him_transaction_approvals(Request $request){

    // $credits = AddBalance::with('agency')->where('status',1)->get();
    $query = AddBalance::with('agency');

    // Search by keyword (e.g. name, email, or other fields)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('agency', function ($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })
            ->orWhere('invoice_number', 'like', "%{$search}%")
            ->orWhere('payment_number', 'like', "%{$search}%");
        });
    }

    // Filter by date range
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by payment type
    if ($request->filled('paymenttype')) {
        $query->where('payment_type', $request->paymenttype);
    }

    // Pagination (default 10 per page)
    $perPage = $request->get('per_page', 10);
    $credits = $query->paginate($perPage)->appends($request->all());

    // $credits = AddBalance::with('agency')->get();
    return view('superadmin.pages.agencies.transaction_approvals',[
        'credits'=>$credits
       ]);
}
/*****Export Excel **** */
public function hsexportFund(Request $request){
    $query = AddBalance::with('agency');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('agency', function ($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })
            ->orWhere('invoice_number', 'like', "%{$search}%")
            ->orWhere('payment_number', 'like', "%{$search}%");
        });
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('paymenttype')) {
        $query->where('payment_type', $request->paymenttype);
    }

    // Use get() here to pass the collection
    $records = $query->get();

    return Excel::download(new FundExport($records), 'funds_report.xlsx');
    
}
/***pdf export *** */
public function hsGeneratePDF(Request $request)
{
    $query = AddBalance::with('agency');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('agency', function ($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })
            ->orWhere('invoice_number', 'like', "%{$search}%")
            ->orWhere('payment_number', 'like', "%{$search}%");
        });
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('paymenttype')) {
        $query->where('payment_type', $request->paymenttype);
    }

    $records = $query->get();

    $pdf = PDF::loadView('pdf.funds_report', compact('records'));
    return $pdf->download('funds_report.pdf');
}

/** View transaction ***/
public function him_transaction_update($uid)
{
 
    $credits = AddBalance::with('agency')->where('id', $uid)->where('status', 1)->first();

    if ($credits) {

        return view('superadmin.pages.agencies.transaction_approvalsform', [
            'credits' => $credits,
        ]);
    } else {
       
        return back()->with('message', 'Wrong selection');
    }
}

/****Store fund *****/

public function him_transaction_store(Request $request)
{
    // Fetch the credit record based on the ID and status

    $cid = Auth::id();
    $credits = AddBalance::with('agency')->where('id', $request->id)->where('status', 1)->first();

    if (!$credits) {
        return redirect()->route('transaction_approvals')->with('error', 'Transaction not found or invalid status.');
    }

    // Fetch the agency balance
    $balance = Balance::where('agency_id', $credits->agency_id)->first();

    if ($request->status == 0) {
        if ($balance) {
            $balance->balance += $request->ammount;
            $message = 'Balance updated successfully.';
        } else {
            $balance = new Balance();
            $balance->agency_id = $credits->agency_id;
            $balance->balance = $request->ammount;
            $message = 'Balance created successfully.';
        }
        $balance->created_user_id = $cid;
        $balance->save();
    }

    // Update credit details
    $credits->amount = $request->ammount;
    $credits->status = $request->status;

    if (!empty($request->remark)) {
        $credits->remark = $request->remark;
    }

    $credits->save();

    return redirect()->route('transaction_approvals')->with('message', 'Transaction updated successfully.');
}

public function him_transaction_delete($id){
    dd($id);
}

/****fund Managment *** */

    /*****AGency Fund Add *****/
    public function hsrequestFund(){
        $agency=$this->agencyService->getAgencyData(); 
        $requests=AddBalance::where('agency_id',$agency->id)->get(); 
     //    dd($request);
         return view('agencies.pages.fund.fund',compact('requests','agency'));
     }
     
     /****Request Fund Applly  */
     public function hsrequestFundApply(){
         return view('agencies.pages.fund.applyfund');
     }
 
     /*****Fund request store *** */
 
     public function hsFundApplyStore(Request $request){
 
         $rules = [
             'modepayment' => 'required|string',
             'add_ammount' => 'required|numeric',
         ];
     
         if ($request->modepayment !== 'creditnote') {
             $rules = array_merge($rules, [
                 'add_ammount' => 'required|numeric',
                 'payment_number' => 'required|string',
                 'remark' => 'string',
                 'receiptcopy' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
             ]);
         }
         $validatedData = $request->validate($rules);

         /***Store File *** */
         if ($request->hasFile('receiptcopy')) {
            $filePath = $request->file('receiptcopy')->store('receipts', 'public');
            $validatedData['receiptcopy'] = $filePath;
        }

        $agency=$this->agencyService->getAgencyData(); 
        $invoice_number = 'INV-' . now()->format('Ymd') . '-' . str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $addbalance = new AddBalance();
        $addbalance->agency_id = $agency->id;
        $addbalance->amount = $validatedData['add_ammount'];
        $addbalance->added_date = now();
        $addbalance->receiptcopy = $validatedData['receiptcopy'];
        $addbalance->invoice_number = $invoice_number;

        $addbalance->payment_number = $request->payment_number;
        $addbalance->payment_number = $request->payment_number;

        $addbalance->status = '1';
        $addbalance->payment_type = $request->modepayment;
        $addbalance->save();
        return redirect()->route('agency.addfund')->with('success', 'Fund request submitted successfully.');
         // Save the AddBalance record and other details her
         
     }


 
}
