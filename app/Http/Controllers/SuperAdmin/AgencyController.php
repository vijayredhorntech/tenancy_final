<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Models\Domain;
use Illuminate\Support\Facades\DB;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\UserServiceAssignment;

use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\AgencyDetail;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\Agency\AgenciesPdfTrait;

class AgencyController extends Controller
{

    use AgenciesPdfTrait;



    /*** Pdf Generate *****/
    public function generatePDF()
    {
        $agencies = Agency::with('domains', 'userAssignments.service', 'balance')
            ->get()
            ->sortByDesc(fn($agency) => $agency->details->status == '0' ? 0 : 1);
        $title = "Agency Reports";

        return $this->generateAgenciesPDF($title, $agencies);
    }





    /******Generate Excel file ******/
    public function exportAgency()
    {
        $agencies = Agency::with('domains', 'userAssignments.service', 'balance')
            ->get()
            ->sortByDesc(fn($agency) => $agency->details->status == '0' ? 0 : 1);
        return $this->generateAgenciesExcel($agencies);
    }




    // code for all superadmin to contenncted with agency
    public function him_agency_index()
    {


        $id = Auth::user()->id;
        $user = User::find($id);
        // $agency=Agency::with('domains','userAssignments.service','balance','details')->get();   
        $agency = Agency::with('domains', 'userAssignments.service', 'balance')
            ->get()
            ->sortByDesc(function ($agency) {
                return $agency->details->status == '0' ? 0 : 1;
            });
        $service = Service::get();
        return  view('superadmin.pages.agencies.agency', ['user_data' => $user, 'agencies' => $agency, 'services' => $service, 'searchback' => false]);
    }


    // code for all agency
    public function him_create_agency()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $service = Service::get();

        $countries = DatabaseHelper::getCountries();
        return view('superadmin.pages.agencies.create_agency', ['user_data' => $user, 'services' => $service, 'countries' => $countries]);
    }


    // code for store agency

    public function him_store_agency(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:agencies,email',
            'agency_phone' => 'required|numeric|digits_between:10,15',
            'domain_name' => [
                'required',
                'string',
                'unique:domains,domain_name',
                'regex:/^[a-z_\-.]+$/'
            ], // Ensures a valid domain format. allowed: _do.ma-in.
            'database_name' => [
                'required',
                'string',
                'max:64',
                'min:1',
                'regex:/^[a-zA-Z][a-zA-Z_]*[a-zA-Z]$|^[a-zA-Z]$/',
            ], // Ensures a valid database name format. Allowed: database, my_database, Database_Name, and a.
            'contact_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'zip_code' => 'required|regex:/^([A-Z]{1,2}[0-9][0-9A-Z]?) ?([0-9][A-Z]{2})$/i', // Ensures the zip code follows the UK postcode pattern.
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ], [
            // Custom Error Messages
            'domain_name.required' => 'The domain name is required.',
            'domain_name.string' => 'The domain name must be a valid string.',
            'domain_name.unique' => 'This domain name is already in use.',
            'domain_name.regex' => 'The domain name format is invalid. Please enter a valid domain (e.g., example-domain).',

            'database_name.required' => 'The database name is required.',
            'database_name.string' => 'The database name must be a valid string.',
            'database_name.unique' => 'This database name is already in use.',
            'database_name.regex' => 'The database name can only contain lowercase, uppercase, and underscore characters',
            'database_name.max' => 'The database name must not exceed 64 characters.',
        ]);

        // Get the authenticated user's ID
        $auth_id = Auth::user()->id;

        // Start a transaction
        \DB::beginTransaction();

        // code for images
        $profile = "";

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $destinationPath = public_path('images/agencies/logo/');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $fileName = 'profile_' . auth()->id() . '_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $profile = $fileName;
        }

        try {


            $documents = [];

            // Get and clean the agency name
            $agencyName = Str::slug(trim($request->name), '_');

            // Loop through request data to extract document name and file
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'document')) {
                    $number = str_replace('document', '', $key); // Extract number (1,2,3..)
                    $fileKey = 'file' . $number; // Match corresponding file input

                    if ($request->hasFile($fileKey)) {
                        $file = $request->file($fileKey);

                        // Define destination path
                        $destinationPath = public_path('images/agencies/documents/');

                        // Create directory if it doesn't exist
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true, true);
                        }

                        // Clean document name
                        $documentName = Str::slug(trim($value), '_');

                        // Generate filename format: documentName_agencyName_timestamp_randomString.extension
                        $fileName = "{$documentName}_{$agencyName}_" . time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();

                        // Move file to destination
                        $file->move($destinationPath, $fileName);

                        // Store document data in array
                        $documents[] = [
                            'name' => $value, // Document Name
                            'file' => $fileName, // Correct File Path
                        ];
                    }
                }
            }
            // Insert into the 'agencies' table


            $agency = new Agency();
            $agency->name = $request->name;
            $agency->email = $request->email;
            $agency->phone = $request->agency_phone;
            $agency->database_name = $request->database_name;
            $agency->contact_person = $request->contact_name;
            $agency->contact_phone = $request->contact_phone;
            $agency->address = $request->address;
            $agency->country = $request->country;
            $agency->user_id = $auth_id;
            $agency->profile_picture = $profile;
            $agency->save();


            $agency_details = new AgencyDetail();
            $agency_details->agency_id  = $agency->id;
            $agency_details->user_id  = $auth_id;
            $agency_details->country = $request->country;
            $agency_details->telephone = $request->telephone;
            $agency_details->agency_phone = $request->agency_phone;
            $agency_details->state  = $request->state;
            $agency_details->city = $request->city;
            $agency_details->zipcode  = $request->zip_code;
            $agency_details->vat_number = $request->agency_phone;
            $agency_details->agency_document = json_encode($documents);
            $agency_details->status = '1';
            $agency_details->save();




            $full_url = env('DOMAIN') . "/" . $request->domain_name;


            // Insert into the 'domains' table
            $domain = Domain::create([
                'domain_name' => $request->domain_name,
                'agency_id' => $agency->id,
                'user_id' => $auth_id,
                'full_url' => $full_url,
            ]);




            // Assign Services if provided
            if (!empty($request->services) && is_array($request->services)) {

                $agency_id = $agency->id;
                foreach ($request->services as $service_id) {
                    $serviceassign = new UserServiceAssignment();
                    $serviceassign->agency_id = $agency_id;
                    $serviceassign->service_id = $service_id;
                    $serviceassign->save();
                }
            }

            Mail::to($agency->email)->queue(new UserRegisteredMail($agency));

            // Create database and run migrations         
            \DB::commit();
            DatabaseHelper::createDatabaseForUser($request->database_name, $agency, $profile);

            return redirect()->route('agency')->with('success', 'Agency and domain created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if anything fails
            \DB::rollBack();

            // Delete the agency if domain creation fails
            if (isset($agency)) {

                $agency->delete();
            }
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create agency and domain: ' . $e->getMessage());
        }
    }


    /*** Function for update****/
    public function him_edit_agency($eid)
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        $service = Service::get();
        $agency = Agency::with('userAssignments.service', 'details')->where('id', $eid)->first();


        //   dd($countries);
        // dd($service);

        return view('superadmin.pages.agencies.agency_eform', [
            'user_data' => $user,
            'services' => $service,
            'edit_agency' => $agency
        ]);
    }


    /**** Update function for agency *****/
    public function him_editstore(Request $request)
    {

        \DB::beginTransaction(); // Start transaction

        try {
            $agency = Agency::where('id', $request->id)->first();


            if (!$agency) {
                return response()->json(['error' => 'Agency not found'], 404);
            }

            $agency->name = $request->name;
            $agency->email = $request->email;
            $agency->phone = $request->agency_phone;
            $agency->contact_person = $request->contact_name;
            $agency->contact_phone = $request->contact_phone;
            $agency->address = $request->address;
            $agency->country = $request->country;
            $agency->save();

            // Delete existing service assignments for the agency
            UserServiceAssignment::where('agency_id', $request->id)->delete();

            // Assign new services if provided
            if (!empty($request->services) && is_array($request->services)) {
                $agency_id = $request->id;
                // dd($agency_id);
                foreach ($request->services as $service_id) {
                    $serviceassign = new UserServiceAssignment();
                    $serviceassign->agency_id = $agency_id;
                    $serviceassign->service_id = $service_id;
                    $serviceassign->save();
                }
            }

            $agency_details = AgencyDetail::where('agency_id', $request->id)->first();
            $agency_details->country = $request->country;
            $agency_details->telephone = $request->telephone;
            $agency_details->agency_phone = $request->agency_phone;
            $agency_details->state  = $request->state;
            $agency_details->city = $request->city;
            $agency_details->zipcode  = $request->zip_code;
            $agency_details->vat_number = $request->agency_phone;
            $agency_details->status = $request->status;
            $agency_details->save();


            \DB::commit();
            return redirect()->route('agency')->with('success', 'Agency and domain created successfully.');
        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback transaction on error
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }



    /*** Single view agency ***/
    public function hs_agency_hisoty($id)
    {
        $agency = Agency::with('balance', 'details')->where('id', $id)->first();

        // $deductions = Deduction::with('agency', 'service')->where('agency_id', $id)->get();
        // $deductions = Deduction::with('service_name')->where('agency_id', $id)->get();
        // $credits = AddBalance::with('agency')->where('agency_id', $id)->where('status',0)->get();
        $deductions = Deduction::with('service_name')
            ->where('agency_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $credits = AddBalance::with('agency')
            ->where('agency_id', $id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('superadmin.pages.agencies.agencyhistory', compact('agency', 'deductions', 'credits'));
    }



    /*****  Route for agency   ***** */
    public function him_agencylogin($domain)
    {

    
        $domin = session('user_data');
        if (isset($domin)) {
            return redirect()->route('agency_dashboard');
        }
        $agency = Agency::with('details')->whereHas('domains', function ($query) use ($domain) {
            $query->where('domain_name', $domain);
        })->with('domains')->first();


        if ($agency->details->status == 0) {
            return view('agencies.permission');
        }

        if ($agency) {
            $fullUrl = optional($agency->domains->first())->full_url;


            session(['agency_full_url' => $fullUrl]);

            return view('agencies.login', ['agency' => $agency]);
        } else {
            return redirect()->route('login')->with('error', 'Domain not found.');
        }
    }


    /*** Function for agencies login ** */
    public function him_agencies_store(Request $request)
    {

        // Validate input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'domain' => 'required',
            'database' => 'required',
        ]);
        $databaseName = $validatedData['database'];
        try {
            // Set the dynamic connection config using the helper function
            session()->flush();
            DatabaseHelper::setDatabaseConnection($databaseName);
            // Check if user exists in the specified database
            $user = User::on('user_database')->where('email', $validatedData['email'])->first();
            if ($user && Hash::check($validatedData['password'], $user->password)) {
                // Log the user in if the password matches
                // Store validated data in the session
                \session(['user_data' => $validatedData]);


                Auth::login($user);

                return redirect()->route('agency_dashboard')->with('success', 'User updated successfully.');
                // return redirect('/agencies/dashboard');
                // return redirect()->route('agency_dashboard');

            } else {
                // If authentication fails

                return back()->withErrors(['error' => 'Invalid credentials']);
            }
        } catch (\Exception $e) {
            dd($e);
            // Handle the error if the database doesn't exist or connection fails
            return back()->withErrors(['error' => 'Database does not exist or could not be connected']);
        }
    }


    /*
          *
          *
          * Function for dashboard
          *
          *
          **/

    public function him_agenciesdashboard()
    {

        // session()->flush();

        // Print specific session value


        //    $user = User::on('user_database')->where('email', $validatedData['email'])->first();

        // $id = Auth::user()->id;
        // dd($id); 
        $userData = \session('user_data');
        DatabaseHelper::setDatabaseConnection($userData['database']);
        $email = \session('user_data.email');
        $user = User::on('user_database')->where('email', $email)->first();

        $id = $user->id;


        if (!$user->type == "staff") {

            $agency_record = Agency::where('email', $user->email)->first();
            // if(dd($agency_record))
            $user->assignRole('super admin');

            $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])->find($agency_record->id);
            $services = $agency->userAssignments->pluck('service.name', 'service.icon');


            $total = Balance::where('agency_id', $agency_record->id)->sum('balance');

            $balance = Deduction::with(['service_name', 'agency'])
                ->where('agency_id', $agency_record->id)
                ->get();


            $bookings = Deduction::with(['service_name', 'agency'])
                ->where('agency_id', $agency_record->id)

                ->get();

            $credits = AddBalance::where('agency_id', $agency_record->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $recent_booking = Deduction::with(['service_name', 'agency'])
                ->where('agency_id', $agency_record->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('agencies.pages.welcome', [
                'agency' => $agency,
                'services' => $services,
                'total' => $total,
                'bookings' => $bookings,
                'recent_booking' => $recent_booking,
                'credits' => $credits
            ]);
        } else {

            $recent_booking = array();
            $credits = array();
            $bookings = array();

            return view('agencies.pages.welcome', [
                'recent_booking' => $recent_booking,
                'credits' => $credits,
                'bookings' => $bookings
            ]);
        }
    }
}
