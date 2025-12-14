<?php

namespace App\View\Components\Agency;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;
use App\Services\AgencyService;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */

    public $user;
    public $login_time; 
    public $services;
    public $pendingNotification=[];

    public function __construct(AgencyService $agencyService)
    {
       
  
        $this->agencyService = $agencyService;
        $this->initializeData();
    }

    /**
     * Initialize component data.
     */
    private function initializeData()
    {
        $date = Carbon::now()->toDateString();
        $this->user = $this->agencyService->getCurrentLoginUser();  
        if ($this->user) {
            $attendance = Attendance::on('user_database')->where('user_id', $this->user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();

            $this->login_time = $attendance ? $attendance->login_time : null; // Assign login time or null
        } else {
            $this->login_time = null;
        }

        $agency = $this->agencyService->getAgencyData();  
    
        // Extract services safely
        $this->services = $agency->userAssignments->pluck('service.name', 'service.icon'); // Remove null values
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.agency.navbar',[
            'user_data' => $this->user,
            'services' => $this->services,
            'login_time' => $this->login_time,
            'pendingNotifications'=>$this->pendingNotification,
        ]);
    }
}


