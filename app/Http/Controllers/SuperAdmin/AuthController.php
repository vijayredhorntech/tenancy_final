<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;
use App\Models\Agency;
use App\Models\Airport;
use App\Models\LoginDetail;
use Illuminate\Support\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\Session;
use DB; 
use App\Models\Domain;
use App\Services\AgencyService;

class AuthController extends Controller
{

    protected $agencyService;
 

    public function __construct(AgencyService $agencyService)
    {
        
        $this->agencyService = $agencyService;
       
    }


    public function login_form(){

      
//   $id = "/superadmin/dashboard";
        // AuthocheckHelper::logincheck();
        return view('auth.login');
    }
    // function for loginm
    public function superadmin_login(Request $request)
    {
    
        // Validate input
        // dd($request->all());
       
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect("/superadmin/dashboard");
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }


    public function hs_dashbord(){

   
        $agency = $this->agencyService->getAgencyData();
        if ($agency) {
            return redirect()->route('agency_dashboard');
        }
       
        $id = Auth::user()->id;
  
        $user = User::find($id);
      
        if($user->type=="staff"){
            return redirect()->route('profile');
        }
        $roles = $user->roles->pluck('name')->implode(', ');
        $service = Service::all(); // Use all() instead of get() (optional)
     
    // $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])->get(); // Array format for clarity
    $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])
    ->take(5) // Limits the result to 5 records
    ->get();
    
    $totalagency=Agency::get(); 
    $total_balance = Balance::sum('balance'); // Add quotes around balance
    $total_deduction = Deduction::sum('amount');
 
    // dd($total_deduction);

    // $bookings = Deduction::with('agency')->orderBy('id', 'desc')->get();
    $bookings = Deduction::with(['service_name', 'agency','flightBooking'])
    ->orderBy('created_at', 'desc') // Orders by latest records
    // ->take(5)
    ->get();

    

            $airlineBookings = []; // Array to store bookings grouped by airline
            $airlinePassengerTotals = []; // Array to store total passengers per airline
            $processedBookings = []; // Track processed flight_booking_id per airline

            foreach ($bookings as $booking) {
                if (!$booking->flightBooking) {
                    continue; // Skip if no flight booking data
                }

                $flight_booking_id = $booking->flight_booking_id; // Get flight_booking_id from booking

                $flight_details = json_decode($booking->flightBooking->details, true);
                $flightsearch = json_decode($booking->flightBooking->flightSearch, true);
                $data = json_decode($flightsearch, true);
                
                $adult = $data['adult'] ?? 0;
                $child = $data['child'] ?? 0;
                $infant = $data['infant'] ?? 0;
                $total = $adult + $child + $infant;

                if (isset($flight_details[0]['journey']) && is_array($flight_details[0]['journey'])) {
                    foreach ($flight_details[0]['journey'] as $journey) {
                        $carrier = $journey['Carrier'] ?? 'Unknown'; // Get carrier or default to 'Unknown'

                        // Store booking details
                        $airlineBookings[$carrier][] = [
                            'booking' => $booking, // Store full booking object
                            'total_passengers' => $total
                        ];

                        // Ensure we only count unique flight_booking_id per airline
                        if (!isset($processedBookings[$carrier])) {
                            $processedBookings[$carrier] = [];
                        }

                        if (!in_array($flight_booking_id, $processedBookings[$carrier])) {
                            $processedBookings[$carrier][] = $flight_booking_id; // Mark as counted
                            
                            // Sum up total passengers for each airline
                            if (!isset($airlinePassengerTotals[$carrier])) {
                                $airlinePassengerTotals[$carrier] = 0;
                            }
                            $airlinePassengerTotals[$carrier] += $total;
                        }
                    }
                }
            }



            $funds = AddBalance::with('agency')
            ->orderBy('created_at', 'desc') // Orders by latest records
            ->take(5)
            ->get();

        

            $flight_recent_booking = Deduction::with(['service_name', 'agency','flightBooking'])
            ->orderBy('created_at', 'desc') // Orders by latest records
            ->where('service','2')
            ->take(5)
            ->get();

            $visa_recent_booking = Deduction::with([
                'service_name', 
                'agency',
                'visaBooking', // Ensure this relationship is defined correctly
                'visaBooking.visa',
                'visaBooking.origin',
                'visaBooking.destination',
                'visaBooking.visasubtype',
                'visaBooking.clint',
                'visaApplicant' // Ensure the correct spelling: 'clint' → 'client' (if it's a typo)
            ])
            ->where('service', 3) // No need for quotes around integer
            ->orderBy('created_at', 'desc') // Order by latest records
            ->take(5)
            ->get();

   

// dd($airlineBookings);

 
    // dd($bookings); 

    $users = User::get();

    // dd("hyyy this"); 
        
        return view('superadmin.pages.welcome',compact(
            'roles', 'service', 'agency', 'total_balance', 'bookings','users','flight_recent_booking','funds','totalagency',
            'airlineBookings','airlinePassengerTotals','total_deduction','visa_recent_booking'));
        //  return view('auth.admin.pages.index', ['user_data' => $user,'services' => $service]);
    }


    public function superadmin_logout() {
  
        try {
     

            DB::beginTransaction(); // Start Transaction
    
            $user_id = Auth::id();
            $date = Carbon::now()->toDateString();  
            $time = Carbon::now()->toTimeString();  
    
            // Get the latest login record for the user
            $login = LoginDetail::where('date', $date)
                        ->where('user_id', $user_id)
                        ->orderBy('id', 'desc') // Get the latest record first
                        ->first();
             $get_attendance = Attendance::where('user_id', $user_id)->where('date', $date)->first();
          
  
            if ($login) {
                // $login_time = Carbon::parse($get_attendance->login_time);  // Convert login_time to Carbon instance
                $login_time = Carbon::parse($login->login_time);
                $logout_time = Carbon::parse($time);
                $work_hours = $login_time->diff($logout_time)->format('%H:%I:%S'); // Calculate work duration
    
                $login->logout_time = $time;
                $login->work_hours = $work_hours;
                $login->status = 'Logged Out';
                $login->save();
    
                // Get attendance record for the user
            
                if ($get_attendance) {
                      
        
                    if (!empty($get_attendance->work_hours)) {
                        // Convert stored work hours to seconds and add new work duration
                        $existing_hours = Carbon::parse($get_attendance->work_hours)->secondsSinceMidnight();
                        $new_hours = Carbon::parse($work_hours)->secondsSinceMidnight();
                        $total_seconds = $existing_hours + $new_hours;
                        
                        $get_attendance->work_hours = gmdate("H:i:s", $total_seconds);
                        $get_attendance->logout_time =$time;

                        $get_attendance->save(); 
                    } else {
                    
                        $get_attendance->work_hours = $work_hours;
                        $get_attendance->logout_time = $time;
                        $get_attendance->save();
                    }
                } else {
                    // Create Attendance Entry if it does not exist
                    $get_attendance->work_hours = $work_hours;
                    $attendance->save();
                }
            }
    
  
            // Update user status to offline
            $user = User::find($user_id);
            if ($user) {
                $user->status = 'offline';
                $user->save();
            }
    
            DB::commit(); // Commit the transaction
    
            Auth::logout(); // Logout the user
    
            return redirect('/')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any error occurs
            return redirect()->route('dashboard')->with('error', 'Failed to logout: ' . $e->getMessage());
        }
    }

    /******Agency Logout********/
    public function agency_logout(){

        try {
     
           $data = session()->all();
           $domin=session('user_data');
  
           $domindata=Domain::where('domain_name',$domin['domain'])->first(); 

        //     $url=$data['agency_full_url'];
      
          $url=$domindata->full_url;


        // Clear all session data
        session()->flush();

        // Redirect to the stored URL
        return redirect()->to($url ?: route('login')); 

            DB::beginTransaction(); // Start Transaction
    

            $user_id = Auth::id();

            
            $date = Carbon::now()->toDateString();  
            $time = Carbon::now()->toTimeString();  
    
            // Get the latest login record for the user
            $login = LoginDetail::where('date', $date)
                        ->where('user_id', $user_id)
                        ->orderBy('id', 'desc') // Get the latest record first
                        ->first();
             $get_attendance = Attendance::where('user_id', $user_id)->where('date', $date)->first();
          
  
            if ($login) {
                $login_time = Carbon::parse($get_attendance->login_time);  // Convert login_time to Carbon instance
                $logout_time = Carbon::parse($time);
                $work_hours = $login_time->diff($logout_time)->format('%H:%I:%S'); // Calculate work duration
    
                $login->logout_time = $time;
                $login->work_hours = $work_hours;
                $login->status = 'Logged Out';
                $login->save();
    
                // Get attendance record for the user
            
                if ($get_attendance) {
                      
        
                    if (!empty($get_attendance->work_hours)) {
                        // Convert stored work hours to seconds and add new work duration
                        $existing_hours = Carbon::parse($get_attendance->work_hours)->secondsSinceMidnight();
                        $new_hours = Carbon::parse($work_hours)->secondsSinceMidnight();
                        $total_seconds = $existing_hours + $new_hours;
                        
                        $get_attendance->work_hours = gmdate("H:i:s", $total_seconds);
                        $get_attendance->logout_time =$time;

                        $get_attendance->save(); 
                    } else {
                    
                        $get_attendance->work_hours = $work_hours;
                        $get_attendance->logout_time = $time;
                        $get_attendance->save();
                    }
                } else {
                    // Create Attendance Entry if it does not exist
                    $get_attendance->work_hours = $work_hours;
                    $attendance->save();
                }
            }
    
  
            // Update user status to offline
            $user = User::find($user_id);
            if ($user) {
                $user->status = 'offline';
                $user->save();
            }
    
            DB::commit(); // Commit the transaction
    
            Auth::logout(); // Logout the user
    
            return redirect('/')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any error occurs
            return redirect()->route('dashboard')->with('error', 'Failed to logout: ' . $e->getMessage());
        }

    }
    
    
}

   


