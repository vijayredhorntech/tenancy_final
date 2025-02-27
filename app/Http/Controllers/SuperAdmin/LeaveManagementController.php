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
            'leaves.leave', // Ensure leaves relationship exists in User model
            'applyLeaves.leave' // Fetch leave name inside applyLeaves
        ])->where('id', $id)->first();


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
     
        // Create a new leave instance
        $leave = new ApplyUserLeave();
        $leave->leave_id = $request->leave_type;
        $leave->user_id = auth()->id(); // Assuming the logged-in user is applying
        $leave->start_date = $request->from;
        $leave->end_date = $request->to;
        $leave->type_of_leave = 'Full Day'; // You can make this dynamic if needed
        $leave->status_of_leave = 'Pending'; // Assuming a default status
        $leave->reason = $request->reason;
        $leave->save();
        return back()->with('success', 'Leave request submitted successfully.');
    }
    



}
