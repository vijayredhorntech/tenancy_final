<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Agency;
use App\Models\Deduction;
use App\Models\User;
use App\Models\TeamUser;


use Auth; 




class NotificationController extends Controller
{
    //
    /****Notification all  */
    public function hs_indexNotificationAll(){
        // dd("heelo");
        $services=Service::all();
        $agencies=Agency::all();
        $pendingnotifications=Deduction::with([
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
        return view('superadmin.pages.notification.notificationall',compact('services','agencies','pendingnotifications'));
    }

    /****View Function  ** */
    public function hsviewNotification($id)
    {
        $notification = Deduction::with([
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
        ])->findOrFail($id);
    
        $notification->displaynotification = 1;
        $notification->viewuserid = Auth::user()->id;
        $notification->save();
    
        if ($notification->service == 3) {
            return redirect()->route('superadminvisa.applicationview', ['id' => $notification->flight_booking_id]);
        } else {
            return back()->with('message', 'Notification marked as read');
        }
    }
    /****Assign user ** */
    public function hsAssignNotification($id)
    {
        $notification = Deduction::with([
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
        ])->findOrFail($id);
    
        $users = User::where('type', '!=', 'superadmin')->get();
        $teams = TeamUser::all();
    
        return view('superadmin.pages.notification.assign', compact('users', 'teams', 'notification'));
    }

    public function hsAssignassignNotification(){

        return redirect()->back();
    }
    
    
}
