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


    /****Dash bord part *** */

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
                    continue; 
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
                'visaBooking', 
                'visaBooking.visa',
                'visaBooking.origin',
                'visaBooking.destination',
                'visaBooking.visasubtype',
                'visaBooking.clint',
                'visaApplicant'
            ])
            ->where('service', 3) // No need for quotes around integer
            ->orderBy('created_at', 'desc') // Order by latest records
            ->take(5)
            ->get();


            /***Get Hotel Booking *****/
            $hotel_recent_booking = Deduction::with([
                'service_name', 
                'agency',
                'hotelBooking',
                'hotelDetails'
            ])
            ->where('service', 1) // No need for quotes around integer
            ->orderBy('created_at', 'desc') // Order by latest records
            ->take(5)
            ->get();

          $users = User::get();

          $pending_booking = Deduction::with([
            'service_name',
            'agency',
            'hotelBooking',
            'hotelDetails',
            'visaBooking.visa',
            'visaBooking.origin',
            'visaBooking.destination',
            'visaBooking.visasubtype',
            'visaBooking.clint',
            'visaApplicant',
            'flightBooking'
        ])
        ->where('displaynotification', '0')
        ->orderBy('created_at', 'desc') // Optional: sort by recent
        ->get();
        
          // Pass the data to the view
            // return view('auth.admin.pages.index', ['user_data' => $user,'services' => $service]);
            // return view('auth.admin.pages.index', compact('user_data', 'services'));

            return view('superadmin.pages.welcome',compact(
                'roles', 'service', 'agency', 'total_balance', 'bookings','users','flight_recent_booking','funds','totalagency',
                'airlineBookings','airlinePassengerTotals','total_deduction','visa_recent_booking','hotel_recent_booking','pending_booking'));
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
    // public function agency_logout(){

    //     try {
     
    //        $data = session()->all();
    //        $domin=session('user_data');
  
    //        $domindata=Domain::where('domain_name',$domin['domain'])->first(); 

    //     //     $url=$data['agency_full_url'];
      
    //       $url=$domindata->full_url;
    //       $user=$this->agencyService->getCurrentLoginUser();
    //       $user_id=$user->id;
    //       $date = Carbon::now()->toDateString();  
    //       $time = Carbon::now()->toTimeString();  
  

    
    //       $login = LoginDetail::on('user_database')->where('date', $date)
    //       ->where('user_id', $user_id)
    //       ->orderBy('id', 'desc') // Get the latest record first
    //       ->first();
        
    //             $get_attendance = Attendance::on('user_database')->where('user_id', $user_id)->where('date', $date)->first();


    //             if ($login) {
    //             // $login_time = Carbon::parse($get_attendance->login_time);  // Convert login_time to Carbon instance
    //             $login_time = Carbon::parse($login->login_time);
    //             $logout_time = Carbon::parse($time);
    //             $work_hours = $login_time->diff($logout_time)->format('%H:%I:%S'); // Calculate work duration
              
    //             $login->setConnection('user_database');
    //             $login->logout_time = $time;
    //             $login->work_hours = $work_hours;
    //             $login->status = 'Logged Out';
    //             $login->save();

    //             // Get attendance record for the user

    //             if ($get_attendance) {
                        

    //                 if (!empty($get_attendance->work_hours)) {
    //                     // Convert stored work hours to seconds and add new work duration
    //                     $get_attendance->setConnection('user_database');
    //                     $existing_hours = Carbon::parse($get_attendance->work_hours)->secondsSinceMidnight();
    //                     $new_hours = Carbon::parse($work_hours)->secondsSinceMidnight();
    //                     $total_seconds = $existing_hours + $new_hours;
                        
    //                     $get_attendance->work_hours = gmdate("H:i:s", $total_seconds);
    //                     $get_attendance->logout_time =$time;

    //                     $get_attendance->save(); 
    //                 } else {
                    
    //                     $get_attendance->setConnection('user_database');
    //                     $get_attendance->work_hours = $work_hours;
    //                     $get_attendance->logout_time = $time;
    //                     $get_attendance->save();
    //                 }
    //             } else {
    //                 // Create Attendance Entry if it does not exist
    //                 $get_attendance->setConnection('user_database');
    //                 $get_attendance->work_hours = $work_hours;
    //                 $attendance->save();
    //             }
    //             }


    //             // Update user status to offline
    //             $user = User::on('user_database')->find($user_id);
    //             if ($user) {
    //             $get_attendance->setConnection('user_database');
    //             $user->status = 'offline';
    //             $user->save();
    //             }



    //     // Clear all session data
    //     session()->flush();

    //     // Redirect to the stored URL
    //     return redirect()->to($url ?: route('login')); 

    //         DB::beginTransaction(); // Start Transaction
    

           
    //         return redirect('/')->with('message', 'Logout successful');
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Rollback if any error occurs
    //         return redirect()->route('dashboard')->with('error', 'Failed to logout: ' . $e->getMessage());
    //     }

    // }
 
    public function agency_logout()
{
    DB::beginTransaction(); // Start Transaction

    try {
        $domin = session('user_data');
        $domindata = Domain::where('domain_name', $domin['domain'])->first();

        $url = $domindata ? $domindata->full_url : route('login');

        $user = $this->agencyService->getCurrentLoginUser();
        $user_id = $user->id;

        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        // Fetch latest login record
        $login = LoginDetail::on('user_database')
            ->where('date', $date)
            ->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->first();

        $get_attendance = Attendance::on('user_database')
            ->where('user_id', $user_id)
            ->where('date', $date)
            ->first();

        if ($login) {
            $login_time = Carbon::parse($login->login_time);
            $logout_time = Carbon::parse($time);
            $work_hours = $login_time->diff($logout_time)->format('%H:%I:%S');

            $login->setConnection('user_database');
            $login->logout_time = $time;
            $login->work_hours = $work_hours;
            $login->status = 'Logged Out';
            $login->save();

            if ($get_attendance) {
                $get_attendance->setConnection('user_database');

                if (!empty($get_attendance->work_hours)) {
                    $existing_seconds = Carbon::parse($get_attendance->work_hours)->secondsSinceMidnight();
                    $new_seconds = Carbon::parse($work_hours)->secondsSinceMidnight();
                    $total_seconds = $existing_seconds + $new_seconds;

                    $get_attendance->work_hours = gmdate("H:i:s", $total_seconds);
                } else {
                    $get_attendance->work_hours = $work_hours;
                }

                $get_attendance->logout_time = $time;
                $get_attendance->save();
            } else {
                // Create attendance if not exists
                $attendance = new Attendance();
                $attendance->setConnection('user_database');
                $attendance->user_id = $user_id;
                $attendance->date = $date;
                $attendance->work_hours = $work_hours;
                $attendance->logout_time = $time;
                $attendance->save();
            }
        }

        // Update user status to offline
        $user_db = User::on('user_database')->find($user_id);
        if ($user_db) {
            $user_db->status = 'offline';
            $user_db->save();
        }

        // Clear all session data
        session()->flush();

        DB::commit(); // Commit transaction

        // Redirect to the stored URL or login route
        return redirect()->to($url);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback transaction on error
        return redirect()->route('dashboard')->with('error', 'Failed to logout: ' . $e->getMessage());
    }
}


    
//     public function superadmin_logout()
//     {
//         return $this->handleLogout(Auth::id());
//     }

// public function agency_logout()
// {
//     try {
//         $domainData = Domain::where('domain_name', session('user_data.domain'))->first();
//         $redirectUrl = $domainData->full_url ?? route('login');

//         $this->agencyService->setDatabaseConnection();
//         $user=$this->agencyService->getCurrentLoginUser();

        
//         $userId = $user->id; // Assuming user ID stored in session
//         $this->handleLogout($userId, true);

//         session()->flush();
//         return redirect()->to($redirectUrl);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return redirect()->route('dashboard')->with('error', 'Failed to logout: ' . $e->getMessage());
//     }
// }


// private function handleLogout($userId, $isAgency = false)
// {
   
//     try {
//         DB::beginTransaction();

//         $connection = $isAgency ? 'user_database' : 'mysql';
//         $date = Carbon::now()->toDateString();
//         $time = Carbon::now()->toTimeString();

//         $login = LoginDetail::on($connection)
//             ->where('date', $date)
//             ->where('user_id', $userId)
//             ->latest()
//             ->first();
       
        
//         $attendance = Attendance::on($connection)
//             ->where('user_id', $userId)
//             ->where('date', $date)
//             ->first();
           

//         if ($login) {
//             $loginTime = Carbon::parse($login->login_time);
//             $logoutTime = Carbon::parse($time);
//             $workHours = $loginTime->diff($logoutTime)->format('%H:%I:%S');

//             $login->update([
//                 'logout_time' => $time,
//                 'work_hours' => $workHours,
//                 'status' => 'Logged Out',
//             ]);

//             if ($attendance) {
//                 $existing = $attendance->work_hours ? Carbon::parse($attendance->work_hours)->secondsSinceMidnight() : 0;
//                 $new = Carbon::parse($workHours)->secondsSinceMidnight();
//                 $totalSeconds = $existing + $new;

//                 $attendance->update([
//                     'work_hours' => gmdate("H:i:s", $totalSeconds),
//                     'logout_time' => $time,
//                 ]);
//             }
//         }

//         // Update user status
//         $user = User::on($connection)->find($userId);
//         if ($user) {
//             $user->status = 'offline';
//             $user->save();
//         }

//         DB::commit();

//         if (!$isAgency) {
//             Auth::logout();
//             return redirect('/')->with('message', 'Logout successful');
//         }
//     } catch (\Exception $e) {
//         dd($e);
//         DB::rollBack();
//         throw $e; // Re-throw to be handled by the calling method
//     }
// }


    
}

   


