<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddBalance;

class AccountController extends Controller
{
    //
    /****Cinet fund  */

    public function hsb2bClient(Request $request){
         // $credits = AddBalance::with('agency')->where('status',1)->get();
    $query = AddBalance::with('agency');

    // Search by keyword (e.g. name, email, or other fields)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('agency', function ($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })
            ->orWhere('invoice_number', 'like', "%{$search}%")
            ->orWhere('payment_number', 'like', "%{$search}%");
        });
    }

    // Filter by date range
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by payment type
    if ($request->filled('paymenttype')) {
        $query->where('payment_type', $request->paymenttype);
    }

    // Pagination (default 10 per page)
    $perPage = $request->get('per_page', 10);
    $credits = $query->paginate($perPage)->appends($request->all());

    // $credits = AddBalance::with('agency')->get();
    return view('superadmin.pages.inventory.clientfund',[
        'credits'=>$credits
       ]);
     
    }
}
