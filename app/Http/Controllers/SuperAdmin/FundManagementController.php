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



class FundManagementController extends Controller
{
    
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

public function him_transaction_approvals(){

    $credits = AddBalance::with('agency')->where('status',1)->get();

    return view('superadmin.pages.agencies.transaction_approvals',[
        'credits'=>$credits
       ]);
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

public function him_transaction_store(Request $request){

     // Fetch the credit record based on the id and status
     $credits = AddBalance::with('agency')->where('id', $request->id)->where('status', 1)->first();

     if ($credits) {

         $credits->amount = $request->ammount;
         $credits->status = $request->status;
         if (isset($request->remark)) {
             $credits->remark = $request->remark;
         }
         $credits->save();
         return redirect()->route('transaction_approvals')->with('message', 'Transaction updated successfully.');

     }
     return redirect()->route('transaction_approvals')->with('error', 'Transaction not found or invalid status.');

}


 
}
