<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SPStaffRepositoryInterface;

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
use App\Models\TeamManagement;
use Illuminate\Support\Carbon;
use App\Models\LeaveBalance;

use Illuminate\Pagination\LengthAwarePaginator;


class SPStaffRepository implements SPStaffRepositoryInterface
{
    protected $model;

 
/***Get All record **** */
    public function all($request)
    {
        $query = User::with(['roles', 'userdetails', 'teams']);
    
        // Exclude users with "Super Admin" role
        $query->whereDoesntHave('roles', function ($q) {
            $q->where('name', 'Super Admin');
        });
    
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
    
        // Date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
    
        // Status (from hasMany userdetails)
        if ($request->filled('status')) {
            $query->whereHas('userdetails', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }
    
        // Department (from hasMany userdetails)
        if ($request->filled('department')) {
            $query->whereHas('userdetails', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }
    
        // Team ID (from hasMany teams relation)
        if ($request->filled('teamid')) {
            $query->whereHas('teams', function ($q) use ($request) {
                $q->where('id', $request->teamid);
            });
        }
    
        // Role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->role);
            });
        }
    
        // Sorting
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
    
        // Pagination
        $users = $query->paginate($request->input('per_page', 10));
    
        return $users;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $spStaff = $this->find($id);
        $spStaff->update($data);
        return $spStaff;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /*****Store Function ***** */

    public function store($request)
    {
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


    /***Store Collection *** */
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

    /****Store Profile  */
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
}
