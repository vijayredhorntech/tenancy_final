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
use App\Models\Salary;
use Illuminate\Support\Carbon;
use App\Models\LeaveBalance;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\Student\StudentPdfTrait;

class SuperadminController extends Controller
{



    public function generatePDF()
    {
        $data = [
            'title' => 'Staff Reports',
            'users'     => User::with('roles', 'userdetails')->get()
        ];

        $pdf = Pdf::loadView('pdf.staffpdf', $data);

        return $pdf->download('Staff.pdf');
    }



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
        ]);

        // Collect dynamic tax and deduction values
        $taxes = $this->collectDynamicInputs($request, 'tax', 'taxvalue');
        $deductions = $this->collectDynamicInputs($request, 'deduction', 'deductionvalue');

        // Upload profile
        $profile = $this->uploadProfile($request, null);

        // Create User
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->email); // Use password instead of email
            $user->profile = $profile;
            $user->type =  'staff';
            $user->save();


            $user->assignRole('simple user');

            $education = $this->uploaddocumentFiles($request, 'educations', 'eductionname', 'images/user/marksheets/', 'eductionfile');
            $documents = $this->uploaddocumentFiles($request, 'documents', 'document', 'images/user/documents/', 'file');
            // Save user meta data
            $this->saveUserMeta($user->id, $request, $education);
            $this->saveUserPassport($user->id, $request,  $this->uploadFiles($request, ['passportfront', 'passport_back'], 'images/user/passport/'), $documents);
            $this->saveUserDeduction($user->id, $request, $deductions, $taxes);

            DB::commit();
            return redirect()->route('staff')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('superadmin.staffcreate')->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }


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
        $userMeta = new UserMeta();
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


        $userpassport = new UserMetaPassportDetails();
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

        $userdeduction = new UserMetaDeduction();
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
            'users_detils'     => User::with('roles', 'userdetails')->where('id', $id)->first(),
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
            'edit_user'  => User::with('userdetails', 'leaves')->findOrFail($eid),
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
                    // $leaves=Leave::find($leave); 
                    // $leave_balance=new LeaveBalance(); 
                    // $leave_add->user_id = $staff_id;
                    // $leave_add->leave_type = $leave;
                    // $leave_add->leave_type = $leave; // Use loop variable instead of $request->leave
                    // $leave_add->save();

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
    public function hs_staff_hisoty($id)
    {

        $user = User::with('userdetails', 'passport', 'log', 'attendance', 'userdeduction', 'salaryshilp')->where('id', $id)->first();

        $date = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $date) // Corrected 'data' to 'date'
            ->first();

        $login_time = $attendance ? $attendance->login_time : null;


        //    dd($user);

        return view('superadmin.pages.staff.staffhistory', compact('user', 'login_time'));
    }



    /***attandance  */


    public function hs_attendance(Request $request)
    {
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


    public function hs_profile()
    {

        $id = Auth::id();

        $user = User::with('userdetails', 'passport', 'log', 'attendance', 'userdeduction')->where('id', $id)->first();
        $date = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $date) // Corrected 'data' to 'date'
            ->first();

        $login_time = $attendance ? $attendance->login_time : null;

        return view('superadmin.pages.proflie.profile', compact('user', 'login_time'));
    }


    /*****Generate salary slip ****** */
    public function hs_generatesaleryslip()
    {
        $users = User::with('userdetails', 'attendance', 'userdeduction')->get();

        foreach ($users as $user) {
            if ($user->attendance->isNotEmpty()) {

                // Get the first attendance date & define month range
                $firstAttendance = $user->attendance->where('salary_slip_created', 0)->first();
                if (!$firstAttendance) continue; // Skip if no unpaid attendance

                $attendanceDate = Carbon::parse($firstAttendance->date);
                $firstDate = $attendanceDate->firstOfMonth()->toDateString();
                $lastDate = $attendanceDate->lastOfMonth()->toDateString();

                // Fetch all attendances for the month
                $attendances = Attendance::where('user_id', $user->id)
                    ->whereBetween('date', [$firstDate, $lastDate])
                    ->where('salary_slip_created', 0)
                    ->get();


                if ($attendances->isEmpty()) continue; // Skip if no records

                // Wage details
                // dd($attendances); 

                $wages_type = $user->userdetails->wages_type;
                $wage_amount = $user->userdetails->wage; // Ensure correct field name

                // Calculate total work hours in seconds

                $totalWorkSeconds = $attendances->sum(function ($attendance) {

                    list($hours, $minutes, $seconds) = explode(':', $attendance->work_hours);
                    return ($hours * 3600) + ($minutes * 60) + $seconds;
                });
                $totalWorkHours = $totalWorkSeconds / 3600; // Convert to hours

                // Calculate salary based on wage type
                $total_earning = 0;
                $daysInMonth = Carbon::now()->daysInMonth;
                if ($wages_type == 'hourly') {
                    $total_earning = $totalWorkHours * $wage_amount;
                } elseif ($wages_type == 'weekly') {
                    $total_earning = ($wage_amount / 7) * $daysInMonth; // Convert weekly to monthly
                } elseif ($wages_type == 'monthly') {
                    $total_earning = $wage_amount; // Fixed salary
                }

                // Fetch deductions
                $deductions = $user->userdeduction;
                $fixed_deductions = collect(['accommodation', 'cab', 'food'])->sum(function ($key) use ($deductions) {
                    return floatval($deductions->$key ?? 0);
                });

                // Percentage-based deductions (EPFO, ESI, etc.)
                $percentage_deductions = 0;
                if (!empty($deductions->other)) {
                    $percentageData = json_decode($deductions->other, true);
                    foreach ($percentageData as $percentage) {
                        $percentage_deductions += ($total_earning * ($percentage / 100));
                    }
                }

                // Total deductions
                $total_deduction = $fixed_deductions + $percentage_deductions;

                // Tax Calculation (Example: 5%)
                $total_tax = ($total_earning * 0.05);

                // Count present days
                $count_of_days = $attendances->count();

                // Net Salary Calculation (Only deduct if days > 9)
                $net_salary = ($count_of_days > 9) ? ($total_earning - ($total_deduction + $total_tax)) : $total_earning;

                // Save salary slip using a transaction
                DB::transaction(function () use ($user, $firstDate, $lastDate, $total_earning, $total_deduction, $total_tax, $net_salary, $count_of_days) {

                    $salary = new Salary();
                    $salary->user_id = $user->id;
                    $salary->start_date = $firstDate;
                    $salary->end_date = $lastDate;
                    $salary->total_earning = $total_earning;
                    $salary->total_deduction = $total_deduction;
                    $salary->total_tax = $total_tax;
                    $salary->net_salary = $net_salary;
                    $salary->count_of_days = $count_of_days;
                    $salary->save();

                    // Update all attendances for the month
                    Attendance::where('user_id', $user->id)
                        ->whereBetween('date', [$firstDate, $lastDate])
                        ->update(['salary_slip_created' => 1]);
                });
            }
        }

        return back()->with('success', 'Salary slips generated successfully!');
    }
}
