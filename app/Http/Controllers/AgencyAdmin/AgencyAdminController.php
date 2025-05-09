<?php

namespace App\Http\Controllers\AgencyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
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
use App\Models\Agency;
use App\Services\AgencyService;
use App\Models\AddBalance;
use Illuminate\Support\Facades\Artisan;


class AgencyAdminController extends Controller
{

    protected $agencyService;
    public function __construct(AgencyService $agencyService)
    {
       
        $this->agencyService = $agencyService;
    }
    
    /*** Staff List ***/
    public function hs_staffindex()
    {

       
        $id = Auth::user()->id;
        $userData = \session('user_data');
        DatabaseHelper::setDatabaseConnection($userData['database']);
        $user = User::on('user_database')->get();
       
     
        return view('agencies.pages.staff.staff', [
            'user_data' => $user,
            'users'     => $user,
        ]);
    }

    /*** Staff Create Form ***/
    public function hs_staffcreate()
    {

        $id = Auth::user()->id;
        $userData = \session('user_data');
        DatabaseHelper::setDatabaseConnection($userData['database']);
        $user = User::on('user_database')->first();
   
        $agencyRecord = Agency::where('email', $user->email)->first();
           
        if (!$agencyRecord) {
            return;
        }

        $agency = Agency::with('userAssignments.service')->find($agencyRecord->id);
      

        // Extract services safely
         $agency = Agency::with('userAssignments.service')->find($agency->id);
        $service = $agency->userAssignments->pluck('service.name', 'service.icon');

        return view('agencies.pages.staff.createstaff_form', [
            'user_data' => Auth::user(),
            'services'  => $service,
            'users'     => User::all(),
        ]);
    }

    /*** Store Staff ***/
    public function hs_staffstore(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        DB::beginTransaction();
        try {
            // Upload profile image
            $profile = $this->uploadProfile($request, null);
    
            // Set database connection dynamically
            $userData = session('user_data');
            DatabaseHelper::setDatabaseConnection($userData['database']);
    
            // Create User
            $user = new User();
            $user->setConnection('user_database'); // Correct way to specify the connection
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->email); // Use email as password (not recommended)
            $user->profile = $profile;
            $user->type ='staff';

            $user->save(); // Save user data
    
            // Assign Role
            $user->assignRole('admin');
    
            // Create User Meta Data
            $userMeta = new UserMeta();
            $userMeta->setConnection('user_database');
            $userMeta->user_id = $user->id;
            $userMeta->phone_number = $request->staff_phone;
            $userMeta->phone_code = $request->phone_code;
            $userMeta->address = $request->address;
            $userMeta->state = $request->state;
            $userMeta->country = $request->country;
            $userMeta->emergency_person_name = $request->emergencyperson_name;
            $userMeta->emergency_contact_number = $request->emergencyperson_contact;
            $userMeta->emergency_email_id = $request->emergencyperson_email;
            $userMeta->account_number = $request->bankdetails;
            $userMeta->short_code = $request->short_code;
            $userMeta->bank_name = $request->bank_name;
            $userMeta->wages_type = $request->wages_type;
            $userMeta->wage = $request->wage;
            $userMeta->save();
    
            // Create Passport Details
            $userpassport = new UserMetaPassportDetails();
            $userpassport->setConnection('user_database');
            $userpassport->user_id = $user->id;
            $userpassport->passport_number = $request->passport_number;
            $userpassport->place_of_issue = $request->place_of_issue;
            $userpassport->passport_expire_date = $request->passport_expiredate;
            $userpassport->date_of_issue = $request->passport_issuedate;
            $userpassport->save();
    
            // Create Deduction Details
            $userdeduction = new UserMetaDeduction();
            $userdeduction->setConnection('user_database');
            $userdeduction->user_id = $user->id;
            $userdeduction->accommodation = $request->accommandation;
            $userdeduction->cab = $request->cab;
            $userdeduction->food = $request->food;
            $userdeduction->save();
    
            DB::commit(); // Commit once
    
            return redirect()->route('agency.staff')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack(); // Rollback on error
            return redirect()->route('agency.staff')->with('error', 'Failed to create user: ' . $e->getMessage());
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
            return redirect()->route('agencies.staff')->with('success', 'Staff deleted successfully.');
        }

        return redirect()->route('agencies.staff')->with('error', 'User not found.');
    }

    /*** Edit Staff Form ***/
    public function hs_staffupdate($eid)
    {
        $userData = session('user_data');
        DatabaseHelper::setDatabaseConnection($userData['database']);
   
         return view('agencies.pages.staff.staff_eform',[
            'allleaves'  => array(),
            'user_data'  => Auth::user(),
            'edit_user'  => User::on('user_database')->with('userdetails','leaves')->findOrFail($eid),
            'roles'      => Role::on('user_database')->get(),
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
            $destinationPath = public_path('images/user/agency/profile/');

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
 
        
            // $user=User::with('userdetails','passport','log','attendance')->where('id',$id)->first(); 
            $userData = session('user_data', []);

            if (!isset($userData['database'])) {
                return;
            }
    
            DatabaseHelper::setDatabaseConnection($userData['database']);
            // $user = User::on('user_database')->where('email', $userData['email'])->first();
            
            $user = User::on('user_database')->where('id', $id)->first();
            if (!$user) {
                return;
            }
       
               
                $user_data = User::on('user_database')
                ->with(['userdetails', 'passport', 'log', 'attendance','userdeduction'])
                ->where('id', $user->id)
                ->first();

                $agency_data=Agency::with('balance','details')->where('database_name',$userData['database'])->first(); 
    
            $date = Carbon::now()->toDateString();
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();

            $login_time = $attendance ? $attendance->login_time : null; 
            
   
    //    dd($user);
    
            return view('agencies.pages.staff.staffhistory',[
                'user'=>$user_data,
                'login_time'=>$login_time,
                'agency_data'=>$agency_data,
            ]);
        // return view('agencies.pages.staff.staffhistory', compact('user','login_time'));
    }



    /***attandance  */
  
    
    public function hs_attendance(Request $request) {
        try {
            DB::beginTransaction(); // Start Transaction
    
            $user_id = Auth::id();
            $date = Carbon::now()->toDateString();  // Gets current date (YYYY-MM-DD)
            $time = Carbon::now()->toTimeString();  // Gets current time (HH:MM:SS)
            // $time = Carbon::now()->format('h:i:s A');

        

    
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
            dd($e);
            DB::rollBack(); // Rollback if any error occurs
            return redirect()->route('dashboard')->with('error', 'Failed to record attendance: ' . $e->getMessage());
        }
    }


    public function hs_profile(){
      
   
        $userData = session('user_data', []);

        if (!isset($userData['database'])) {
            return;
        }

        DatabaseHelper::setDatabaseConnection($userData['database']);
        $user = User::on('user_database')->where('email', $userData['email'])->first();

        if (!$user) {
            return;
        }
   
           
            $user_data = User::on('user_database')
            ->with(['userdetails', 'passport', 'log', 'attendance','userdeduction'])
            ->where('id', $user->id)
            ->first();

        
            $date = Carbon::now()->toDateString();
        
            $attendance = Attendance::on('user_database')->where('user_id', $user->id)
                ->whereDate('date', $date) // Ensure date comparison is correct
                ->first();
            $agency_data=Agency::with('balance','details')->where('database_name',$userData['database'])->first(); 
         
     
                $login_time = $attendance ? $attendance->login_time : null; 
       

        return view('agencies.pages.proflie.profile', [
            'user'=>$user_data,
            'login_time'=>$login_time,
            'agency_data'=>$agency_data,
        ]);

    }

}
