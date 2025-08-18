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
use App\Services\AgencyService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class LeaveManagementController extends Controller
{
    use ManageLeaveTrait;
    protected $agencyService;
    public function __construct(AgencyService $agencyService)
    {
       
        $this->agencyService = $agencyService;
      
    }

    /***Add leave****/

    public function hs_addleave($type = null){
        if (isset($type) && $type == "agency") {
       
           $setConnection= $this->agencyService->setDatabaseConnection();  
           $leaves = Leave::on('user_database')->get();
        return view('agencies.pages.leavemanagment.leave',compact('leaves'));

        //    dd($leaves);
        }
      
        $leaves=Leave::get(); 
        return view('superadmin.pages.leavemanagment.leave',compact('leaves'));
    }


    /**Store the leave*** */
    // public function hs_leavestore(Request $request){
       
    //    if($request->type == "agency") {
    //     $setConnection= $this->agencyService->setDatabaseConnection();
    //     $validatedData = $request->validate([
    //         'leave_type' => 'required|string|max:255',
    //         'total_day' => 'integer',
    //     ]);
    
    //    Leave::on('user_database')->create([
    //         'user_id' => Auth::id(),
    //         'leave_type' => $validatedData['leave_type'],
    //         'total_days' => $validatedData['total_day'],
    //         'status' => true, // Assuming 'true' indicates an active status
    //     ]);
    
    //    }
    //     $validatedData = $request->validate([
    //         'leave_type' => 'required|string|max:255',
    //         'total_day' => 'integer',
    //     ]);

    //   Leave::create([
    //         'user_id' => Auth::id(),
    //         'leave_type' => $validatedData['leave_type'],
    //         'total_days' => $validatedData['total_day'],
    //         'status' => true, // Assuming 'true' indicates an active status
    //     ]);

    //     // Redirect back to the 'add.leave' route with a success message
    //     return redirect()->route('add.leave')->with('message', 'Leave created successfully.');
    // }

    public function hs_leavestore(Request $request)
    {
        // Validate once
        $validatedData = $request->validate([
            'leave_type' => 'required|string|max:255',
            'total_day' => 'nullable|integer',
        ]);
    
        // Determine the connection and redirect route
        $connection = 'mysql';
        $redirectRoute = 'add.leave';
        $routeParams = [];
    
        if ($request->type === 'agency') {
            $this->agencyService->setDatabaseConnection();
            $connection = 'user_database';
            $redirectRoute = 'add.agency.leave';
            $routeParams = ['type' => 'agency'];
        }
    
        // Create the leave record
        Leave::on($connection)->create([
            'user_id' => Auth::id(),
            'leave_type' => $validatedData['leave_type'],
            'total_days' => $validatedData['total_day'],
            'status' => true,
        ]);
        // dd($redirectRoute);
        return redirect()->route($redirectRoute, $routeParams)->with('success', 'Leave created successfully.');
    }
    


    public function hs_update($id,$type = null){
   

         if (isset($type) && $type == "agency") {
       
           $setConnection= $this->agencyService->setDatabaseConnection();  
            $leave = Leave::on('user_database')->where('id',$id)->first();
             return view('agencies.pages.leavemanagment.updateleave',compact('leave'));

        //    dd($leaves);
        }
        $leave=Leave::find($id);
        // dd($leave);
        return view('superadmin.pages.leavemanagment.updateleave',compact('leave'));
      
    }




    // public function hs_updatestore(Request $request){
        
    //     $validatedData = $request->validate([
    //         'leave_type' => 'required|string|max:255',
    //         'total_day' => 'integer',
    //     ]);
    //     //  dd($request->all());
    //     if($)
    //     $leave=Leave::find($request->id);
    //     $leave->leave_type=$request->leave_type; 
    //     $leave->total_days=$request->total_day; 
    //     $leave->status=$request->status; 
    //     $leave->save();
      
    //     return redirect()->route('add.leave')->with('message', 'Leave updated successfully.');
    
    // }

    
    
   public function hs_updatestore(Request $request)
{

    $validatedData = $request->validate([
        'id' => 'required|integer', // Make sure leave ID is passed
        'leave_type' => 'required|string|max:255',
        'total_day' => 'nullable|integer',
    ]);


    $connection = 'mysql';
    $redirectRoute = 'add.leave';
    $routeParams = [];

    if ($request->type === 'agency') {
        $this->agencyService->setDatabaseConnection();
        $connection = 'user_database';
        $redirectRoute = 'add.agency.leave';
        $routeParams = ['type' => 'agency'];
    }

    // Find the existing leave record
    $leave = Leave::on($connection)->find($validatedData['id']);

    if (!$leave) {
        return redirect()->back()->withErrors(['Leave record not found.']);
    }

    // Update the leave record
    $leave->leave_type = $validatedData['leave_type'];
    $leave->total_days = $validatedData['total_day'] ?? $leave->total_days;
    $leave->status = $request->status ?? $leave->status;

    $leave->save();

    return redirect()->route($redirectRoute, $routeParams)->with('success', 'Leave updated successfully.');
}



    /******Apply leave *******/

        public function hs_leaves($type = null)
        {
            $isAgency = isset($type) && $type === 'agency';

            // Get user ID and determine database connection
            $loginUser = $isAgency ? $this->agencyService->getCurrentLoginUser() : Auth::user();
            $userId = $loginUser->id;
            $connection = $isAgency ? 'user_database' : null;

            // Common relationships
            $user = User::on($connection)->with([
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
                'applyLeaves.leave',
            ])->where('id', $userId)->first();

            // Get today's attendance
            $today = Carbon::now()->toDateString();
            $attendance = Attendance::on($connection)->where('user_id', $userId)
                ->where('date', $today)
                ->first();

            $login_time = $attendance?->login_time;

            $view = $isAgency
                ? 'agencies.pages.leavemanagment.leavemanagment'
                : 'superadmin.pages.leavemanagment.leavemanagment';

            return view($view, compact('user', 'login_time'));
        }



    ////check this code 

    public function hs_applyleave(Request $request,$type=null){
     
        // dd($type);
  
        // Validate the request data

        // $request->validate([
        //     'leave_type' => 'required|integer',
        //     'from' => 'required|date',
        //     'to' => 'required|date|after_or_equal:from',
        //     'reason' => 'nullable|string|max:255',
        // ]);

         $validator = Validator::make($request->all(), [
           'leave_type' => 'required|integer',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'reason' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
            
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('show_add_leave_tab', true);
    }
        
    // Calculate the number of leave days
        $start_date = Carbon::parse($request->from);
        $end_date = Carbon::parse($request->to);

        $result = $this->checkLeaves($type = $request->type);


        //dd("hello");
     
        // Check if the user has already applied for a leave (Pending or Approved) within the same date range (from - to)
        if($result==true){
            return back()->with('error', 'You have already applied for a leave that is waiting for confirmation....');
        }
        $leavebalance=$this->checkLeaveBalance($start_date,$end_date,$request->all());
        if($leavebalance==false){
            //dd("hello");
            return back()->with('error', 'You do not have sufficient leave balance..');
        }
    
           // Create a new leave request
            $leave = new ApplyUserLeave();
            $leave->leave_id = $request->leave_type;
            $leave->user_id = auth()->id();
            $leave->start_date = $request->from;
            $leave->end_date = $request->to;
            $leave->type_of_leave = 'Full Day';
            $leave->status_of_leave = 'pending';
            $leave->reason = $request->reason;
            $leave->save();
    return back()->with('success', 'Leave request submitted successfully.');

    }



    public function hs_pendingleave($type = null){
   
        if(isset($type) && $type == "agency") {
            $setConnection= $this->agencyService->setDatabaseConnection();
            $leaves = ApplyUserLeave::on('user_database')
                ->with(['leaveName', 'userName.userdetails'])
                ->where('status_of_leave','pending')
                ->get();
            return view('agencies.pages.leavemanagment.pendingleave', compact('leaves'));
        }
        $leaves = ApplyUserLeave::with(['leaveName', 'userName.userdetails'])
            ->where('status_of_leave','pending')
            ->get();
         
    
        return view('superadmin.pages.leavemanagment.pendingleave', compact('leaves'));
    }


    public function hs_editleave($id){
        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','pending')->where('id',$id)->first();
        $user = User::with([
            'userdetails',
            'passport',
            'attendance',
            'leaves.leave.Leavesbalance', 
            'applyLeaves.leave',
        ])->where('id', $id)->first();

        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','pending')->where('id',$id)->first();
      
     
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



    /** Delete a leave type */
    public function hs_deleteLeave(Request $request, $id, $type = null)
    {
        $isAgency = ($request->type === 'agency') || ($type === 'agency');

        if ($isAgency) {
            $this->agencyService->setDatabaseConnection();
            $leave = Leave::on('user_database')->find($id);
            if (!$leave) {
                return redirect()->route('add.agency.leave', ['type' => 'agency'])->with('error', 'Leave not found.');
            }
            $leave->delete();
            return redirect()->route('add.agency.leave', ['type' => 'agency'])->with('success', 'Leave deleted successfully.');
        }

        $leave = Leave::find($id);
        if (!$leave) {
            return redirect()->route('add.leave')->with('error', 'Leave not found.');
        }
        $leave->delete();
        return redirect()->route('add.leave')->with('success', 'Leave deleted successfully.');
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
       
    
        $leave=ApplyUserLeave::with('leaveName','userName')->where('status_of_leave','pending')->where('id',$id)->first();
        
          return view('superadmin.pages.leavemanagment.editleavesuperadmin',compact('leave'));
    }

    public function hs_approveleave($id)
    {
        $leave = ApplyUserLeave::find($id);
        if (!$leave) {
            return back()->with('error', 'Leave request not found.');
        }
        $leave->status_of_leave = 'approved';
        $leave->save();
        return back()->with('success', 'Leave approved.');
    }
    



}
