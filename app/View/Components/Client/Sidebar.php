<?php

namespace App\View\Components\Client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;
use App\Services\AgencyService;
use App\Models\UserServiceAssignment;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */


     public $user;
     public $agency;

    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
        $this->initializeData();
    }

    private function initializeData()
    {
         $loggedInClient = Auth::guard('client')->user();
         $this->user = $loggedInClient;
         $this->agency = Agency::with('userAssignments.service')->find($loggedInClient->agency_id);
   

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.sidebar',[
            'user_data' => $this->user,
            'agency' => $this->agency
        ]);
    }
}
