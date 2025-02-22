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
        return view('auth.admin.pages.staff.staff_form', [
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
                    $user->assignRole('admin');

                    // Create User Meta Data
                    $userMeta = new UserMeta();
                    $userMeta->user_id = $user->id;
                    $userMeta->phone_number = $request->contact_phone;
                    $userMeta->phone_code = $request->phone_code; // Change this if needed
                    $userMeta->address = $request->address;
                    $userMeta->state = $request->state;
                    $userMeta->country = $request->country;
                    $userMeta->save();

    DB::commit();

            DB::commit();
            return redirect()->route('superadmin.staff')->with('success', 'User created successfully.');
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
        return view('superadmin.pages.staff.staff_eform', [
            'user_data'  => Auth::user(),
            'services'   => Service::all(),
            'edit_user'  => User::with('userdetails')->findOrFail($eid),
            'roles'      => Role::all(),
        ]);
    }


    /*** Update Staff ***/
    public function hs_supdatedstore(Request $request)
    {
        // dd($request->all());
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
}
