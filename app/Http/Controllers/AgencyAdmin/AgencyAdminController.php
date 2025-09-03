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
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\PermissionRegistrar;



class AgencyAdminController extends Controller
{

    protected $agencyService;
    public function __construct(AgencyService $agencyService)
    {
       
        $this->agencyService = $agencyService;
    }
    
    
    public function migration(){
        $user = $this->agencyService->getCurrentLoginUser();  
        Artisan::call('migrate', [
            '--database' => 'user_database', // ✅ Your connection name
            '--path' => 'database/migrations', // Optional: if you want to run only specific path
            '--force' => true, // ✅ Required if running from code, especially in production
        ]);
        dd("heelo");
    }
  

    /*** Staff List ***/
    public function hs_staffindex()
    {
        $setConnection= $this->agencyService->setDatabaseConnection();  
        $user = User::on('user_database')
        ->where('type','staff')->get();
        
        return view('agencies.pages.staff.staff', [
            'user_data' => $user,
            'users'     => $user,
        ]);
    }

    /*** Staff Create Form ***/
    public function hs_staffcreate()
    {
         $agency = $this->agencyService->getAgencyData();  
            // Extract services safely
         $agency = Agency::with('userAssignments.service')->find($agency->id);
         $service = $agency->userAssignments->pluck('service.name', 'service.icon');
         return view('agencies.pages.staff.createstaff_form');
    }

    /*** Store Staff ***/
    
    public function hs_staffstore(Request $request)
    {
       
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc,dns|unique:users,email',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'staff_phone' => 'nullable|numeric|digits_between:10,15',  // User's phone number between 10 - 15 characters
            'date_ofbirth' => 'nullable|date|before:14 years ago',
            'zip_code' => 'required|regex:/^([A-Z]{1,2}[0-9][0-9A-Z]?) ?([0-9][A-Z]{2})$/i', // Ensures the zip code follows the UK postcode pattern.
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255|unique:user_meta_passportdetails,passport_number',
            'accommandation' => 'nullable|numeric',
            
            'cab' => 'nullable|numeric',
            'food' => 'nullable|numeric',
            'deductionvalue1' => 'nullable|numeric',
            'taxvalue1' => 'nullable|numeric',
            'wage' => 'nullable|numeric',
        ]);

        // Collect dynamic tax and deduction values
        $taxes = $this->collectDynamicInputs($request, 'tax', 'taxvalue');
        $deductions = $this->collectDynamicInputs($request, 'deduction', 'deductionvalue');

        // Upload profile
        $profile = $this->uploadProfile($request, null);
        $setConnection= $this->agencyService->setDatabaseConnection();  

        // Create User
        DB::beginTransaction();
        try {
            $user = new User();
            $user->setConnection('user_database');
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->email); // Use password instead of email
            $user->profile = $profile;
            $user->type =  'staff';
            $user->save();


            $user->assignRole('simple user');

            $education = $this->uploaddocumentFiles($request, 'educations', 'eductionname', 'images/agency/user/marksheets/', 'eductionfile');
            $documents = $this->uploaddocumentFiles($request, 'documents', 'document', 'images/agency/user/documents/', 'file');
            // Save user meta data
            $this->saveUserMeta($user->id, $request, $education);
            $this->saveUserPassport($user->id, $request,  $this->uploadFiles($request, ['passportfront', 'passport_back'], 'images/user/passport/'), $documents);
            $this->saveUserDeduction($user->id, $request, $deductions, $taxes);

            DB::commit();
            return redirect()->route('agency.staff')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('agency.staff')->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }
    

    /****Prite Function to save data *** */
    
    /**
     * Helper function to collect dynamic input fields.
     */
    private function collectDynamicInputs(Request $request, $prefix, $valuePrefix)
    {
        return collect($request->all())->filter(function ($value, $key) use ($prefix, $valuePrefix, $request) {
            return str_starts_with($key, $prefix) && $request->has($valuePrefix . str_replace($prefix, '', $key));
        })->mapWithKeys(function ($value, $key) use ($prefix, $valuePrefix, $request) {
            $index = str_replace($prefix, '', $key);
            return [$value => $request->input($valuePrefix . $index)];
        })->toArray();
    }

    /**
     * Upload files dynamically and return stored filenames.
     */
    private function uploadFiles(Request $request, $keys, $path)
    {
        $keys = (array) $keys;
        $uploadedFiles = [];

        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0755, true);
        }

        foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = "{$key}_" . Str::slug($request->name, '_') . "_" . time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();
                $file->move(public_path($path), $fileName);
                $uploadedFiles[$key] = "{$path}{$fileName}";
            }
        }

        return $uploadedFiles;
    }

    /**
     * Upload files uploade document  and return stored filenames.
     */

    private function uploaddocumentFiles(Request $request, $array, $type, $path, $images)
    {
        $array = [];

        $staff_name = Str::slug(trim($request->name), '_');

        // Loop through request data to extract document name and file
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, $type)) {
                $number = str_replace($type, '', $key); // Extract number (1,2,3..)
                $fileKey = $images . $number; // Match corresponding file input

                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);

                    // Define destination path
                    $destinationPath = public_path($path);

                    // Create directory if it doesn't exist
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true, true);
                    }

                    // Clean document name
                    $educationname = Str::slug(trim($value), '_');

                    // Generate filename format: documentName_agencyName_timestamp_randomString.extension
                    $fileName = "{$educationname}_{$staff_name}_" . time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();

                    // Move file to destination
                    $file->move($destinationPath, $fileName);

                    // Store document data in array
                    $array[] = [
                        'name' => $value, // Document Name
                        'file' => $fileName, // Correct File Path
                    ];
                }
            }
        }


        return $array;
    }

    /**
     * Save User Meta.
     */
    private function saveUserMeta($userId, Request $request, $educations)
    {
        $setConnection= $this->agencyService->setDatabaseConnection();  
        
        $userMeta = new UserMeta();
        $userMeta->setConnection('user_database');
        
        $userMeta->user_id = $userId;
        $userMeta->phone_number = $request->staff_phone;
        $userMeta->phone_code = $request->phone_code; // Change this if needed
        $userMeta->address = $request->address;
        $userMeta->state = $request->state;
        $userMeta->country = $request->country;
        $userMeta->emergency_person_name = $request->emergencyperson_name;
        $userMeta->emergency_contact_number     = $request->emergencyperson_contact;
        $userMeta->emergency_email_id = $request->emergencyperson_email;
        $userMeta->account_number = $request->bankdetails;
        $userMeta->short_code = $request->short_code;
        $userMeta->bank_name = $request->bank_name;
        $userMeta->wages_type = $request->wages_type;
        $userMeta->wage = $request->wage;
        $userMeta->education = json_encode($educations);
        $userMeta->save();
    }

    /**
     * Save User Passport Details.
     */
    private function saveUserPassport($userId, Request $request, $passportFiles, $documents)
    {

        $setConnection= $this->agencyService->setDatabaseConnection();  
        
        $userpassport = new UserMetaPassportDetails();
        $userpassport->setConnection('user_database');
        $userpassport->user_id = $userId;
        $userpassport->passport_number = $request->passport_number;
        $userpassport->place_of_issue = $request->place_of_issue;
        $userpassport->passport_expire_date = $request->passport_expiredate;
        $userpassport->date_of_issue = $request->passport_issuedate;
        $userpassport->other_doc_details = json_encode($documents);
        $userpassport->passport_front_side = $savedFiles['passport_front'] ?? '';
        $userpassport->passport_back_side = $savedFiles['passport_back'] ?? '';
        $userpassport->save();
    }


    /**
     * Save User Deduction Details.
     */
    private function saveUserDeduction($userId, Request $request, $deductions, $taxes)
    {
        $setConnection= $this->agencyService->setDatabaseConnection();  
        $userdeduction = new UserMetaDeduction();
        $userdeduction->setConnection('user_database');
        $userdeduction->user_id = $userId;
        $userdeduction->othertaxslap = json_encode($taxes);
        $userdeduction->accommodation = $request->accommandation;
        $userdeduction->cab = $request->cab;
        $userdeduction->food = $request->food;
        $userdeduction->other = json_encode($deductions);
        $userdeduction->save();
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
        // $userData = session('user_data');
        // DatabaseHelper::setDatabaseConnection($userData['database']);
        $setConnection= $this->agencyService->setDatabaseConnection(); 
        $leaves=Leave::on('user_database')->get(); 

   
         return view('agencies.pages.staff.staff_eform',[
            'allleaves'  => $leaves,
            'user_data'  => Auth::user(),
            'edit_user'  => User::on('user_database')->with('userdetails','leaves')->findOrFail($eid),
            'roles'      => Role::on('user_database')->get(),
         ]);
    }



    /*** Update Staff ***/
    // public function hs_staffUpdateStore(Request $request)
    // {
    //     $setConnection= $this->agencyService->setDatabaseConnection();   
    //     $validated = $request->validate([
    //         'name'    => 'string',
    //         'email'   => 'email',
    //     ]);
    //     DB::beginTransaction();
    //     try {
    //         $user = User::on('user_database')->findOrFail($request->id);
    
            
    //         $user->name = $request->name;
    //         $user->email = $request->email;
            
    //         // $user->profile = $this->uploadProfile($request, $user);

    //         if ($request->role && $request->role !== 'Select Role') {
    //            $role = Role::on('user_database')
    //             ->where('name', $request->role)
    //             ->where('guard_name', 'web')
    //             ->firstOrFail();
    //             $value=DB::('user_database')->table('model_has_roles')->where('model_id', $user->id)->first();
    //             if($value){
    //                 DB::('user_database')->table('model_has_roles')->where('model_id', $user->id)->update([
    //                     'role_id' => $role->id,
    //                 ]);
    //             }

    //         // Sync using the role instance (from same connection)
    //         $user->syncRoles([$role->name]);
    //         } else {
    //              $user->syncRoles(['simple user']);
    //         }

    //         $user->save();

    //         UserMeta::on('user_database')->updateOrCreate(
    //             ['user_id' => $user->id],
    //             [
    //                 'phone_number' => $request->phone,
    //             ]
    //         );

    //         $leave = LeaveAssign::on('user_database')->where('user_id', $request->id)->get();
    //         // Delete previous leave assignments if they exist
    //         if ($leave->isNotEmpty()) {
    //             $leave->each->delete();
    //         }
    //       if (!empty($request->leaves) && is_array($request->leaves)) {
    //             $staff_id = $request->id;

    //             foreach ($request->leaves as $leave) {
    //                 $leave_add = new LeaveAssign();
    //                 $leave_add->setConnection('user_database');
    //                 $leave_add->user_id = $staff_id;
    //                 $leave_add->leave_type = $leave; // Use loop variable instead of $request->leave
    //                 $leave_add->save();
    //             }
    //         }
    //         // Debugging output (optional)
    //         DB::commit();
    //         return redirect()->route('agency.staff')->with('success', 'User updated successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('agency.staff')->with('error', 'Failed to update user: ' . $e->getMessage());
    //     }
    // }

    public function hs_staffUpdateStore(Request $request)
{
    // 1) Ensure tenant connection is set
    $this->agencyService->setDatabaseConnection();

    // 2) Tell Spatie to use the tenant DB for this request and reset cache
    config(['permission.connection' => 'user_database']);
    app(PermissionRegistrar::class)->forgetCachedPermissions();

    $validated = $request->validate([
        'name'  => 'required|string',
        'email' => 'required|email',
    ]);

    DB::connection('user_database')->beginTransaction();

    try {
        // User on tenant DB
        $user = User::on('user_database')->findOrFail($request->id);
        $user->name  = $request->name;
        $user->email = $request->email;

        // --- Roles ---
        if ($request->role && $request->role !== 'Select Role') {
            // Fetch the Role INSTANCE from tenant DB
            $role = Role::on('user_database')
                ->where('name', $request->role)
                ->where('guard_name', 'web')
                ->firstOrFail();

            // IMPORTANT: pass the ROLE INSTANCE, not the name
            $user->syncRoles([$role]);   // or: $user->syncRoles($role);
        } else {
            // Also fetch default role instance from tenant DB
            $defaultRole = Role::on('user_database')
                ->where('name', 'simple user')
                ->where('guard_name', 'web')
                ->firstOrFail();

            $user->syncRoles([$defaultRole]);
        }

        $user->save();

        // Meta on tenant DB
        UserMeta::on('user_database')->updateOrCreate(
            ['user_id' => $user->id],
            ['phone_number' => $request->phone]
        );

        // Leaves on tenant DB
        LeaveAssign::on('user_database')->where('user_id', $user->id)->delete();

        if (!empty($request->leaves) && is_array($request->leaves)) {
            foreach ($request->leaves as $leave) {
                $leaveAdd = new LeaveAssign();
                $leaveAdd->setConnection('user_database');
                $leaveAdd->user_id    = $user->id;
                $leaveAdd->leave_type = $leave;
                $leaveAdd->save();
            }
        }

        DB::connection('user_database')->commit();

        return redirect()->route('agency.staff')->with('success', 'User updated successfully.');
    } catch (\Throwable $e) {
        DB::connection('user_database')->rollBack();
        return redirect()->route('agency.staff')->with('error', 'Failed to update user: '.$e->getMessage());
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
 
            $userData = session('user_data', []);

            if (!isset($userData['database'])) {
                return;
            }
      
        $user = $this->agencyService->getCurrentLoginUser();  
             $user_data = User::on('user_database')
                ->with(['userdetails', 'passport', 'log', 'attendance', 'userdeduction', 'salaryshilp'])
                ->where('id', $id)
                ->first();
                $agency_data=Agency::with('balance','details')->where('database_name',$userData['database'])->first(); 
                // dd($agency_data);
            $date = Carbon::now()->toDateString();
           
            $attendance = Attendance::on('user_database')->where('user_id', $user_data->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();   
         
            $login_time = $attendance ? $attendance->login_time : null; 

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
    
        
            $user = $this->agencyService->getCurrentLoginUser();  
          
            $user_id = $user->id;
      
            $date = Carbon::now()->toDateString();  // Gets current date (YYYY-MM-DD)
            $time = Carbon::now()->toTimeString();  // Gets current time (HH:MM:SS)
            // $time = Carbon::now()->format('h:i:s A');

        

    
            // Create Login Detail Entry
            $login = new LoginDetail();
            $login->setConnection('user_database');
            $login->user_id = $user_id;
            $login->date = $date;
            $login->login_time = $time;
            $login->status = 'Present';
            $login->save();

            // Check if Attendance already exists for the user on the current date
            $get_attendance = Attendance::on('user_database')->where('user_id', $user_id)->where('date', $date)->first();
            
            if (!$get_attendance) {
                // Create Attendance Entry
                $attendance = new Attendance();
                $attendance->setConnection('user_database');
                $attendance->login_id = $login->id;
                $attendance->user_id = $user_id;
                $attendance->date = $date;
                $attendance->login_time = $time;
                $attendance->attendance_status = 'Present'; // 'P' stands for Present
                $attendance->save();
            }
    
            // Update User Status
            $user = User::on('user_database')->find($user_id); 
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

        $setConnection= $this->agencyService->setDatabaseConnection();   
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


    /*******staff attandance */
    public function hs_staffattandance(Request $request){
            // Start with the base query for users
            $user = $this->agencyService->getCurrentLoginUser();  

            $query = User::on('user_database')->with(['attendance', 'userdetails'])
                ->where('type', '=', 'staff'); // Exclude superadmin users
        
            // Date range filter
            if ($request->filled('date_from')) {
                $date_from = Carbon::parse($request->date_from);
                $query->whereHas('attendance', function ($q) use ($date_from) {
                    $q->whereDate('date', '>=', $date_from);
                });
            } else {
                $date_from = now()->startOfMonth();
            }
        
            if ($request->filled('date_to')) {
                $date_to = Carbon::parse($request->date_to);
                $query->whereHas('attendance', function ($q) use ($date_to) {
                    $q->whereDate('date', '<=', $date_to);
                });
            } else {
                $date_to = now()->endOfMonth();
            }
            $perPage = $request->filled('per_page') ? $request->per_page : 10;

            $users = $query->paginate($perPage);
      
        
            return view('agencies.pages.staff.staffattandance', compact('users', 'date_from', 'date_to'));
        }
        
        /*******staff wages */
        public function hs_staffwages(Request $request)
        {
            // Determine the selected date or use today's date
            $user = $this->agencyService->getCurrentLoginUser();  
            $date = $request->filled('date_from') 
                ? Carbon::parse($request->date_from)->toDateString()
                : now()->toDateString();
        
            // Query users and their attendance for the selected date
            $query = User::on('user_database')->with(['attendance' => function ($q) use ($date) {
                $q->whereDate('date', '=', $date);
            }, 'userdetails'])
            ->where('type', '!=', 'superadmin');
        
            // Pagination: default to 10 per page
            $perPage = $request->filled('per_page') ? $request->per_page : 10;
            $users = $query->paginate($perPage);
        
            // Return view with users and date
            return view('agencies.pages.staff.staffwages', compact('users', 'date'));
        }
        
        /****Attendance by Id *** */
        
        
        
        public function hsstaffAttendance(Request $request, $id)
        {
            // Get the user
            $user = $this->agencyService->getCurrentLoginUser();  
            $user = User::on('user_database')->with('attendance')->findOrFail($id);
        
            // Parse the date range
            $date_from = $request->filled('date_from') ? Carbon::parse($request->date_from)->startOfDay() : now()->startOfMonth();
            $date_to = $request->filled('date_to') ? Carbon::parse($request->date_to)->endOfDay() : now()->endOfMonth();
        
            // Create an array of all dates between date_from and date_to
            $dateRange = [];
            $current = $date_from->copy();
        
            while ($current->lte($date_to)) {
                $dateRange[] = $current->toDateString();
                $current->addDay();
            }
        
            // Get attendance dates as array
            $attendanceDates = $user->attendance
                ->filter(function ($att) use ($date_from, $date_to) {
                    $date = Carbon::parse($att->date);
                    return $date->between($date_from, $date_to);
                })
                ->pluck('date')
                ->map(fn($d) => Carbon::parse($d)->toDateString())
                ->toArray();
        
            // Generate attendance status for each date
            $attendanceStatus = [];
            foreach ($dateRange as $date) {
                $attendanceStatus[] = [
                    'date' => $date,
                    'status' => in_array($date, $attendanceDates) ? 'P' : 'A'
                ];
            }
        
            // Manual pagination
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            $offset = ($page - 1) * $perPage;
        
            $paginatedData = new LengthAwarePaginator(
                array_slice($attendanceStatus, $offset, $perPage),
                count($attendanceStatus),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        
            return view('agencies.pages.staff.single_attendance', compact('user', 'paginatedData', 'date_from', 'date_to'));
        }

}
