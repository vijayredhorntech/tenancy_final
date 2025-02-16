<?php

namespace App\View\Components\Agency;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;

class Sidebar extends Component
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
        $user = Auth::user();

        if (!$user) {
            return;
        }

     


        // Get session data safely
        $userData = session('user_data', []);

        if (!isset($userData['database'])) {
            return;
        }

        // Set the dynamic database connection
        DatabaseHelper::setDatabaseConnection($userData['database']);

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
         $agency = Agency::with('userAssignments.service')->find($agency->id);
         $this->services = $agency->userAssignments->pluck('service.name', 'service.icon'); // Remove null values
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.agency.sidebar',[
            'user_data' => $this->user,
            'services' => $this->services,
        ]);
    }
}
