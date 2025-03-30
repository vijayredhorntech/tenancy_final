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
use App\Traits\Leaves\ManageLeaveTrait;


class LeaveManagementController extends Controller
{
    use ManageLeaveTrait;
    
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
     
        $user = User::with([
            'userdetails',
            'passport',
            'attendance',
            'leaves.leave.Leavesbalance',
            'applyLeaves' => function ($query) {
                $query->orderByRaw("CASE 
                    WHEN status_of_leave = 'pending' THEN 1 
                    WHEN status_of_leave = 'cancel' THEN 2 
                    WHEN status_of_leave = 'approve' THEN 3 
                    ELSE 4 END");
            },
            'applyLeaves.leave', // Fetch leave name inside applyLeaves
        ])->where('id', $id)->first();  

// dd($user);
            $date = Carbon::now()->toDateString();
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();


            $login_time = $attendance ? $attendance->login_time : null; 
          
        return view('superadmin.pages.leavemanagment.leavemanagment', compact('user','login_time'));
      
    }


    ////check this code 

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

        $result = $this->checkLeaves();
        if($result==true){
            return back()->with('error', 'You have already applied for a leave that is waiting for confirmation....');
        }
        $leavebalance=$this->checkLeaveBalance($start_date,$end_date,$request->all());
        if($leavebalance==false){
            return back()->with('error', 'You do not have sufficient leave balance..');
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
    return back()->with('success', 'Leave request submitted successfully.');

    }



    public function hs_pendingleave(){
   
        $leaves=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','Pending')->get();
         
    
        return view('superadmin.pages.leavemanagment.pendingleave', compact('leaves'));
    }


    public function hs_editleave($id){
        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','Pending')->where('id',$id)->first();
        $user = User::with([
            'userdetails',
            'passport',
            'attendance',
            'leaves.leave.Leavesbalance', 
            'applyLeaves.leave',
        ])->where('id', $id)->first();

        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','Pending')->where('id',$id)->first();
      
     
        return view('superadmin.pages.leavemanagment.editleavestaff', compact('leave','user'));
    }

    
    /**** Cancel leave by user****/
    public function hs_cancelleave($id)
    {
      
        $leave = ApplyUserLeave::with('leaveName', 'userName')->find($id);
           // dd($leave);
        if (!$leave) {
            return back()->with('error', 'Leave request not found.');
        }
      
      
        // Update leave status to 'canceled'
        $leave->status_of_leave = 'cancel'; 
        $leave->save();
    
        return back()->with('success', 'Your leave has been canceled.');
    }



    public function hs_LeaveUpdateStore(Request $request){
       
        $request->validate([
            'leaveid' => 'required|integer',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'reason' => 'nullable|string|max:255',
        ]);
   
        if (isset($request->usertype) && $request->usertype == "superadmin") {
              
            
            $result = $this->superadminedit($request->all());
            return redirect()->route('pending.leave')->with('message', 'Leave updated successfully.');
        } else {
            $result = $this->useredit($request->all());
            return redirect()->route('leaves')->with('message', 'Your leave has been updated.');
        }
        }
    



      

    public function hs_actionUpdateLeave($id){
    
        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','Pending')->where('id',$id)->first();
        
          return view('superadmin.pages.leavemanagment.editleavesuperadmin',compact('leave'));
    }
    



}
