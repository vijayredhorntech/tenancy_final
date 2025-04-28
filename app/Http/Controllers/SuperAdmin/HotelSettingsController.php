<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class HotelSettingsController extends Controller
{
    //

    /***** Hotel Supplier setting *****/
    public function hs_hotelsupplier(Request $request)
    {
       $api =['RATEHAWK','TRAVELLANDA','STUBA'];
       $data = array();
       $data['api'] = $api;
       return view('superadmin.pages.hotelsetting.hotelsupplier',compact('data'));
    }



}
