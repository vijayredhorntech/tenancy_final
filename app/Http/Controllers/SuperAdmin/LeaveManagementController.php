<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\LeaveAssign;
use App\Models\Attendance;
use App\Models\LoginDetail;
use Illuminate\Support\Carbon;
use Auth; 
use App\Models\User;
use App\Models\ApplyUserLeave;
use App\Models\LeaveBalance;

class LeaveManagementController extends Controller
{
    
    
    /***Add leave****/

    public function hs_addleave(){

        $leaves=Leave::get(); 
   
        
        return view('superadmin.pages.leavemanagment.leave',compact('leaves'));
    }


    /**Store the leave*** */
    public function hs_leavestore(Request $request){
       
  
    $validatedData = $request->validate([
        'leave_type' => 'required|string|max:255',
        'total_day' => 'integer',
    ]);

   Leave::create([
        'user_id' => Auth::id(),
        'leave_type' => $validatedData['leave_type'],
        'total_days' => $validatedData['total_day'],
        'status' => true, // Assuming 'true' indicates an active status
    ]);

    // Redirect back to the 'add.leave' route with a success message
    return redirect()->route('add.leave')->with('message', 'Leave created successfully.');
    }



    public function hs_update($id){
        $leave=Leave::find($id);
        return view('superadmin.pages.leavemanagment.updateleave',compact('leave'));
      
    }



    public function hs_updatestore(Request $request){
       
        $validatedData = $request->validate([
            'leave_type' => 'required|string|max:255',
            'total_day' => 'integer',
        ]);

        $leave=Leave::find($request->id);
        $leave->leave_type=$request->leave_type; 
        $leave->total_days=$request->total_day; 
        $leave->status=$request->status; 
        $leave->save();

        return redirect()->route('add.leave')->with('message', 'Leave updated successfully.');
    
    }


    /******Apply leave *******/
    public function hs_leaves(){

    
        $id=Auth::id();
        // $user=User::with('userdetails','passport','attendance','leaves.leave','applyleave')->where('id',$id)->first(); 
        $user = User::with([
            'userdetails',
            'passport',
            'attendance',
            'leaves.leave.Leavesbalance', // Ensure leaves relationship exists in User model
            'applyLeaves.leave',
            // Fetch leave name inside applyLeaves
        ])->where('id', $id)->first();

// dd($user);
            $date = Carbon::now()->toDateString();
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();


            $login_time = $attendance ? $attendance->login_time : null; 
          
        return view('superadmin.pages.leavemanagment.leavemanagment', compact('user','login_time'));
      
    }



    public function hs_applyleave(Request $request)
    {
        // Validate the request data
  

    $request->validate([
        'leave_type' => 'required|integer',
        'from' => 'required|date',
        'to' => 'required|date|after_or_equal:from',
        'reason' => 'nullable|string|max:255',
    ]);

    // Calculate the number of leave days
    $start_date = Carbon::parse($request->from);
    $end_date = Carbon::parse($request->to);
    // $leave_days = $start_date->diffInDays($end_date) + 1;
    $leave_days = (int) ($start_date->diffInDays($end_date) + 1);
    $leaveType = Leave::find($request->leave_type);
    {
        $total_use=$leaveType->total_days-$leave_days;
  
     
        if($total_use <= 0){
      
            return back()->with('error', 'You have already used all your leave.');
        }
    }
    // Check if the user has enough leave balance
    $check_leave = LeaveBalance::where('leave_id', $request->leave_type)
        ->where('user_id', auth()->id())
        ->first();
 
    if (!empty($check_leave)) {

        $checkTotal=$check_leave->balance-$leave_days; 
        if($checkTotal <= 0){
      
            return back()->with('error', 'You have already used all your leave.');
        }
   
    }


    // Create a new leave request
    $leave = new ApplyUserLeave();
    $leave->leave_id = $request->leave_type;
    $leave->user_id = auth()->id();
    $leave->start_date = $request->from;
    $leave->end_date = $request->to;
    $leave->type_of_leave = 'Full Day';
    $leave->status_of_leave = 'Pending';
    $leave->reason = $request->reason;
    $leave->save();

    // If leave balance exists, deduct used leaves
    if (!empty($check_leave)) {
        $check_leave->balance -= $leave_days;
        $check_leave->used = $leave_days+$check_leave->used;
        $check_leave->save();
    } else {
        // Fetch total allowed leaves from the Leave table
        $leaveType = Leave::find($request->leave_type);
        $total_leaves = $leaveType ? $leaveType->total_days : 0;

        // Ensure balance does not go negative
        $balance = max(0, $total_leaves - $leave_days);

        // Create a new leave balance entry
        $leave_balance = new LeaveBalance();
        $leave_balance->leave_id = $request->leave_type;
        $leave_balance->user_id = auth()->id();
        $leave_balance->balance = $balance;
        $leave_balance->used = $leave_days;
        $leave_balance->status = 'active';
        $leave_balance->save();
    }

    return back()->with('success', 'Leave request submitted successfully.');

    }



    public function hs_pendingleave(){
   
        $leaves=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','Pending')->get();
         
    
        return view('superadmin.pages.leavemanagment.pendingleave', compact('leaves'));
    }
    



}
