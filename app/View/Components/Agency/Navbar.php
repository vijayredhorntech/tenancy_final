<?php

namespace App\View\Components\Agency;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */

    public $user;
    public $services;

    public function __construct()
    {
       
        $this->initializeData();
    }

    /**
     * Initialize component data.
     */
    private function initializeData()
    {
        // $user = Auth::user();

      
     


        // Get session data safely
        $userData = session('user_data', []);

        if (!isset($userData['database'])) {
            return;
        }

        // Set the dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);

        $user = User::on('user_database')->where('email', $userData['email'])->first();
        if (!$user) {
            return;
        }

        // Fetch user from the dynamic database connection
        $this->user = User::on('user_database')->where('id', $user->id)->first();

        if (!$this->user) {
            return;
        }

        // Fetch agency details
        $agencyRecord = Agency::where('email', $this->user->email)->first();

        if (!$agencyRecord) {
            return;
        }

        $agency = Agency::with('userAssignments.service')->find($agencyRecord->id);

        // Extract services safely
        $this->services = $agency->userAssignments->map(function ($assignment) {
            return [
                'name' => $assignment->service->name ?? null,
                'icon' => $assignment->service->icon ?? null,
            ];
        })->filter(); // Remove null values
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.agency.navbar',[
            'user_data' => $this->user,
            'services' => $this->services,
        ]);
    }
}


