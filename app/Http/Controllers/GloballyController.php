<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Models\Service;

class GloballyController extends Controller
{
    public function hs_globalserach(Request $request)
    {
        // Get the search type from the request
        $type = $request->type;
        
        // Check if the type is 'agency' and call the agency search function
        if ($type === 'agency') {
            return $this->agencySearch($request->search);
        }

        // Handle other types if needed
        return response()->json(['error' => 'Invalid search type'], 400);
    }

    public function agencySearch($search)
    {
        $id = Auth::id(); // Get authenticated user's ID
        $user = User::find($id);

        // Search agencies by name, email, or contact person
        $agencies = Agency::with(['domains', 'userAssignments.service', 'balance','details'])
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('contact_person', 'LIKE', "%{$search}%");
            })
            ->get();

        $services = Service::all(); // Fetch all services

        return view('superadmin.pages.agencies.agency', [
            'user_data' => $user,
            'agencies' => $agencies,
            'services' => $services,
            'searchback'=>true
        ]);
    }
}
