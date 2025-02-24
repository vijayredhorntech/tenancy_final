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



class AuthController extends Controller
{

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

       
        $id = Auth::user()->id;
  
        $user = User::find($id);
        $roles = $user->roles->pluck('name')->implode(', ');
        $service = Service::all(); // Use all() instead of get() (optional)
    
    // $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])->get(); // Array format for clarity
    $agency = Agency::with(['domains', 'userAssignments.service', 'balance'])
    ->take(5) // Limits the result to 5 records
    ->get();
    
    $total_balance = Balance::sum('balance'); // Add quotes around balance
    $total_deduction = Deduction::sum('amount');
  

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



// Now, $airlinePassengerTotals contains the total number of passengers per airline

   
    // dd($bookings[0]->flightBooking->details);

    
    // $data = json_decode(json_decode($bookings[0]->flightBooking->details, true), true);
    // $data = json_decode($bookings[1]->flightBooking->details, true);
    // $flight_search = json_decode($bookings[1]->flightBooking->flightSearch, true);

    $funds = AddBalance::with('agency')
    ->orderBy('created_at', 'desc') // Orders by latest records
    ->take(5)
    ->get();

 

    $recent_booking = Deduction::with(['service_name', 'agency','flightBooking'])
    ->orderBy('created_at', 'desc') // Orders by latest records
    ->take(5)
    ->get();


// dd($airlineBookings);

 
    // dd($bookings); 

    $users = User::get();
        
        return view('superadmin.pages.welcome',compact(
            'roles', 'service', 'agency', 'total_balance', 'bookings','users','recent_booking','funds',
            'airlineBookings','airlinePassengerTotals','total_deduction'));
        //  return view('auth.admin.pages.index', ['user_data' => $user,'services' => $service]);
    }


   public function superadmin_logout(){
            Auth::logout();
            return redirect('/');
   }


   
}

