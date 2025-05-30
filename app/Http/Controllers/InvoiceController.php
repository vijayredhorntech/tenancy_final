<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\User;
use App\Models\Country;
use App\Models\Deduction;
use App\Models\CLientDetails;
use App\Models\ClientMoreInfo;
use App\Models\AuthervisaApplication;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\AgencyService;


use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    protected $agencyService;

    public function __construct(AgencyService $agencyService) {
        $this->agencyService = $agencyService;
    }
    
     /****Invoice Data ****/
    // public function hs_invoice(Request $request,$type){
       
    //         $countries = Country::all();
    //         $services = Service::whereIn('id', [1, 2, 3])->get();  
    //         $invoices = Deduction::with(['service_name', 'agency', 'flightBooking'])
    //             ->when($request->filled('search'), function ($query) use ($request) {
    //                 $query->where(function ($q) use ($request) {
    //                     $q->where('invoice_number', 'like', '%' . $request->search . '%')
    //                     ->orWhereHas('agency', function ($q2) use ($request) {
    //                         $q2->where('name', 'like', '%' . $request->search . '%');
    //                     });
    //                 });
    //             })
    //             ->when($request->filled('date_from'), function ($query) use ($request) {
    //                 $query->whereDate('created_at', '>=', $request->date_from);
    //             })
    //             ->when($request->filled('date_to'), function ($query) use ($request) {
    //                 $query->whereDate('created_at', '<=', $request->date_to);
    //             })
    //             ->when($request->filled('min_price'), function ($query) use ($request) {
    //                 $query->where('amount', '>=', $request->min_price);
    //             })
    //             ->when($request->filled('max_price'), function ($query) use ($request) {
    //                 $query->where('amount', '<=', $request->max_price);
    //             });
    //             // ->when($request->filled('application_status'), function ($query) use ($request) {
    //             //     $query->where('application_status', $request->application_status);
    //             // });

    //         // Pagination or get all
    //         if ($request->filled('per_page') && is_numeric($request->per_page)) {
    //             $invoices = $invoices->paginate($request->per_page);
    //         } else {
    //             $invoices = $invoices->get();
    //         }

    //         if ($type == 'agencies') {
    //             return view('agencies.pages.invoicehandling.invoiceindex', compact('countries', 'invoices', 'services'));
    //         }

    //         // Optional: fallback or error for unsupported types
    //         abort(404);
            
  
    // }

    public function hs_invoice(Request $request, $type)
{
    // Step 1: Base Query with Eager Loading
    $invoicesQuery = Deduction::with([
        'service_name', 
        'agency',
        'visaBooking', 
        'visaBooking.visa',
        'visaBooking.origin',
        'visaBooking.destination',
        'visaBooking.visasubtype',
        'visaBooking.clint',
        'visaApplicant',
        'flightBooking',
        'hotelBooking',
        'hotelDetails'
    ]);

    // Step 2: Filtering
    $invoicesQuery
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('agency', function ($q2) use ($request) {
                      $q2->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        })
        ->when($request->filled('date_from'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->date_from);
        })
        ->when($request->filled('date_to'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->date_to);
        })
        ->when($request->filled('min_price'), function ($query) use ($request) {
            $query->where('amount', '>=', $request->min_price);
        })
        ->when($request->filled('max_price'), function ($query) use ($request) {
            $query->where('amount', '<=', $request->max_price);
        });

    // Step 3: Get Data (Pagination or all)
    $invoices = $request->filled('per_page') && is_numeric($request->per_page)
        ? $invoicesQuery->paginate($request->per_page)
        : $invoicesQuery->get();

    // Step 4: Loop through all invoices and dynamically set extra data
    foreach ($invoices as $invoice) {
        if ($invoice->agency && $invoice->visaBooking) {
            // dd('heelo there is');
            $this->agencyService->setDatabaseConnection($invoice->agency->database_name);
              
            $clientFromUserDB = ClientDetails::on('user_database')
                ->with('clientinfo')
                ->where('id', $invoice->visaBooking->client_id)
                ->first();

            $otherMembers = AuthervisaApplication::on('user_database')
                ->where('clint_id', $invoice->visaBooking->client_id)
                ->where('booking_id', $invoice->visaBooking->id)
                ->get();

            // Set dynamic relations manually
            $invoice->visaBooking->setRelation('clientDetailsFromUserDB', $clientFromUserDB);
            $invoice->visaBooking->setRelation('otherMembersFromUserDB', $otherMembers);
        }
        // dd("sorry");
        dd($invoice);
    }

    // Step 5: Return View
    if ($type === 'agencies') {
        return view('agencies.pages.invoicehandling.invoiceindex', [
            'countries' => $countries ?? [],
            'invoices' => $invoices,
            'services' => $services ?? [],
        ]);
    }

    // Step 6: Fallback
    abort(404);
}



    /****Invoice Data ****/
    public function hs_viewInvoice(Request $request,$id){

        $invoice = Deduction::with([
            'service_name', 
            'agency',
            'visaBooking', 
            'visaBooking.visa',
            'visaBooking.origin',
            'visaBooking.destination',
            'visaBooking.visasubtype',
            'visaBooking.clint',
            'visaApplicant',
            'flightBooking',
            'hotelBooking',
            'hotelDetails'
        ])->where('id',$id)->first();
     
      
        $this->agencyService->setDatabaseConnection($invoice->agency->database_name);

        $clientFromUserDB = ClientDetails::on('user_database')
        ->with('clientinfo') // You can add other nested relations if needed
        ->where('id', $invoice->visaBooking->client_id)
        ->first();
    
        $otherMember = AuthervisaApplication::on('user_database')
        ->where('clint_id', $invoice->visaBooking->client_id)
        ->where('booking_id', $invoice->visaBooking->id)
        ->get();
    
        $invoice->setRelation('clint', $clientFromUserDB);
        $invoice->setRelation('otherclients', $otherMember);


        $countries = Country::all();
        $services = Service::whereIn('id', [1, 2, 3])->get();
        
        return view('agencies.pages.invoicehandling.invoiceview', compact('countries', 'invoice','services'));
    }
}
