<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuthocheckHelper;
use App\Models\User;
use App\Models\Service;
use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use App\Models\AddBalance;
use App\Models\Balance;
use App\Models\Deduction;

use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class InventoryController extends Controller
{

    public function hs_inventory(Request $request)
{
    // Fetch all records with agency relationship
    $inventory = AddBalance::with('agency')
    ->where('status', 0) // Filter by status = 0
    ->get()
    ->map(function ($item) {
        $item->type = 'credit'; // Mark as credit
        $item->amount = $item->amount; // Standardize amount field
        unset($item->added_amount);
        return $item;
    });

   

    // Fetch all Deduction records (debits)
    $deduction = Deduction::with('agency')->get()->map(function ($item) {
        $item->type = 'debit'; // Mark as debit
        $item->amount = $item->amount; // Standardize amount field
        unset($item->deducted_amount);
        return $item;
    });
    // dd($inventory);
    // Merge and sort both datasets by created_at
    $sorted = $inventory->concat($deduction)->sortByDesc('created_at')->values();

    return view('superadmin.pages.inventory.inventory', [
        'inventories' => $sorted
    ]);
}

    
}
