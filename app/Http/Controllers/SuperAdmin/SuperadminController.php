<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\UserMetaPassportDetails;
use App\Models\UserMetaDeduction;
use App\Models\UserActivityLog;
use App\Models\Leave;
use App\Models\LeaveAssign;
use App\Models\Attendance;
use App\Models\LoginDetail;
use Illuminate\Support\Carbon;

        

class SuperadminController extends Controller
{
    /*** Staff List ***/
    public function hs_staffindex()
    {
        return view('superadmin.pages.staff.staff', [
            'user_data' => Auth::user(),
            'services'  => Service::all(),
            'users'     => User::with('roles', 'userdetails')->get(),
        ]);
    }

    /*** Staff Create Form ***/
    public function hs_staffcreate()
    {
        return view('superadmin.pages.staff.createstaff_form', [
            'user_data' => Auth::user(),
            'services'  => Service::all(),
            'users'     => User::all(),
        ]);
    }

    /*** Store Staff ***/
    public function hs_staffstore(Request $request)
    {
         
        //    dd($request->all());
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $profile = $this->uploadProfile($request, null);
   
            // Create User
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->email); // Use password instead of email
                    $user->profile = $profile;
                    $user->save(); // Save user data

                    // Assign Role
                    $user->assignRole('simple user');

                    // Create User Meta Data
                    $userMeta = new UserMeta();
                    $userMeta->user_id = $user->id;
                    $userMeta->phone_number = $request->staff_phone;
                    $userMeta->phone_code = $request->phone_code; // Change this if needed
                    $userMeta->address = $request->address;
                    $userMeta->state = $request->state;
                    $userMeta->country = $request->country;
                    $userMeta->emergency_person_name = $request->emergencyperson_name;
                    $userMeta->emergency_contact_number	 = $request->emergencyperson_contact;
                    $userMeta->emergency_email_id = $request->emergencyperson_email;
                    $userMeta->account_number = $request->bankdetails;
                    $userMeta->short_code = $request->short_code;
                    $userMeta->bank_name = $request->bank_name;
                    $userMeta->wages_type = $request->wages_type;
                    $userMeta->wage = $request->wage;
                    $userMeta->save();

                    $userpassport = new UserMetaPassportDetails();
                    $userpassport->user_id=$user->id;
                    $userpassport->passport_number =$request->passport_number;
                    $userpassport->place_of_issue=$request->place_of_issue;
                    $userpassport->passport_expire_date=$request->passport_expiredate;
                    $userpassport->date_of_issue=$request->passport_issuedate;
                    // $userpassport->passport_front_side=$user->id;
                    // $userpassport->passport_back_side=$user->id;
                    // $userpassport->other_doc_details=$user->id;
                    $userpassport->save(); 

                    $userdeduction = new UserMetaDeduction();
                    $userdeduction->user_id=$user->id;
                    // $userdeduction->taxslab =$user->passport_number;
                    $userdeduction->accommodation=$request->accommandation;
                    $userdeduction->cab=$request->cab;
                    $userdeduction->food=$request->food;
                    // $userdeduction->other=$user->passport_issuedate;
                    // $userpassport->passport_front_side=$user->id;
                    // $userpassport->passport_back_side=$user->id;
                    // $userpassport->other_doc_details=$user->id;
                    $userdeduction->save(); 


    DB::commit();

            DB::commit();
            return redirect()->route('staff')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e); 
            return redirect()->route('superadmin.staffcreate')->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /*** View Staff Details ***/
    public function hs_staffDetails($id)
    {
            
        return view('auth.admin.pages.staff.details', [
            'user_data' => Auth::user(),
            'services'  => Service::all(),
            'users'     => User::with('roles', 'userdetails')->get(),
            'users_detils'     => User::with('roles', 'userdetails')->where('id',$id)->first(),
        ]);
    }

    /*** Delete Staff ***/
    public function hs_staffdelete($id)
    {
        if ($user = User::find($id)) {
            $user->delete();
            return redirect()->route('superadmin.staff')->with('success', 'Staff deleted successfully.');
        }

        return redirect()->route('superadmin.staff')->with('error', 'User not found.');
    }

    /*** Edit Staff Form ***/
    public function hs_staffupdate($eid)
    {

        // dd(User::with('userdetails','leaves')->findOrFail($eid));
        return view('superadmin.pages.staff.staff_eform', [
            'user_data'  => Auth::user(),
            'services'   => Service::all(),
            'edit_user'  => User::with('userdetails','leaves')->findOrFail($eid),
            'roles'      => Role::all(),
            'allleaves'     => Leave::all(),
        ]);
    }


    /*** Update Staff ***/
    public function hs_supdatedstore(Request $request)
    {
    

        $validated = $request->validate([
            'name'    => 'string',
            'email'   => 'email',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;

            // $user->profile = $this->uploadProfile($request, $user);

            if ($request->role && $request->role !== 'Select Role') {
                $user->syncRoles([$request->role]);
            } else {
                $user->syncRoles(['simple user']);
            }

            $user->save();

            UserMeta::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone_number' => $request->phone,
                    // 'phone_code'   => $request->phone_code,
                    // 'address'      => $request->address,
                    // 'state'        => $request->state,
                    // 'country'      => $request->country,
                ]
            );


            $leave = LeaveAssign::where('user_id', $request->id)->get();

            // Delete previous leave assignments if they exist
            if ($leave->isNotEmpty()) {
                $leave->each->delete();
            }

          if (!empty($request->leaves) && is_array($request->leaves)) {
                $staff_id = $request->id;

                foreach ($request->leaves as $leave) {
                    $leave_add = new LeaveAssign();
                    $leave_add->user_id = $staff_id;
                    $leave_add->leave_type = $leave; // Use loop variable instead of $request->leave
                    $leave_add->save();
                }
            }

            // Debugging output (optional)
       
          
        



            DB::commit();
            return redirect()->route('staff')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('staff')->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    /*** Handle Profile Upload ***/
    private function uploadProfile(Request $request, $user)
    {

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $destinationPath = public_path('images/user/profile/');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            if ($user && $user->profile && File::exists($destinationPath . $user->profile)) {
                File::delete($destinationPath . $user->profile);
            }

            $fileName = 'profile_' . ($user ? $user->id : auth()->id()) . '_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            //  dd($fileName);
            $file->move($destinationPath, $fileName);

            return $fileName;
        }

        return $user ? $user->profile : null;
    }


    /**** Staf history*****/
    public function hs_staff_hisoty($id){
 
            $user=User::with('userdetails','passport','log','attendance')->where('id',$id)->first(); 
            $date = Carbon::now()->toDateString();
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();

            $login_time = $attendance ? $attendance->login_time : null; 
            
   
    //    dd($user);
    
        return view('superadmin.pages.staff.staffhistory', compact('user','login_time'));
    }



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


    /***attandance  */
  
    
    public function hs_attendance(Request $request) {
        try {
            DB::beginTransaction(); // Start Transaction
    
            $user_id = Auth::id();
            $date = Carbon::now()->toDateString();  // Gets current date (YYYY-MM-DD)
            $time = Carbon::now()->toTimeString();  // Gets current time (HH:MM:SS)

    
            // Create Login Detail Entry
            $login = new LoginDetail();
            $login->user_id = $user_id;
            $login->date = $date;
            $login->login_time = $time;
            $login->status = 'Present';
            $login->save();
    
            // Check if Attendance already exists for the user on the current date
            $get_attendance = Attendance::where('user_id', $user_id)->where('date', $date)->first();
            
            if (!$get_attendance) {
                // Create Attendance Entry
                $attendance = new Attendance();
                $attendance->login_id = $login->id;
                $attendance->user_id = $user_id;
                $attendance->date = $date;
                $attendance->login_time = $time;
                $attendance->attendance_status = 'Present'; // 'P' stands for Present
                $attendance->save();
            }
    
            // Update User Status
            $user = User::find($user_id); 
            if ($user) {
                $user->status = 'online';
                $user->save();
            }
    
            DB::commit(); // Commit the transaction
    
            return redirect()->route('dashboard')->with('message', 'Attendance successfully recorded');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any error occurs
            return redirect()->route('dashboard')->with('error', 'Failed to record attendance: ' . $e->getMessage());
        }
    }


    public function hs_profile(){
      
        $id=Auth::id();
        $user=User::with('userdetails','passport','log','attendance')->where('id',$id)->first(); 
            $date = Carbon::now()->toDateString();
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();

            $login_time = $attendance ? $attendance->login_time : null; 
        return view('superadmin.pages.proflie.profile', compact('user','login_time'));

    }
    
    



}
