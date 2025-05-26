<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\User;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    
    public function hsatolVoice(){
        $services = Service::whereIn('name', ['flight', 'visa', 'hotel'])->get();

    return view('superadmin.pages.atol.atolindex', compact('services'));
    }
}
