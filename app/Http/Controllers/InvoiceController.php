<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\User;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    
    public function hs_invoice(Request $request){
        dd("heelo");
        $services = Service::whereIn('name', ['flight', 'visa', 'hotel'])->get();

    return view('superadmin.pages.atol.atolindex', compact('services'));
    }
}
