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
use App\Models\UserServiceAssignment;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */

     public $user;
     public $services;
     public $visapermission;
     public $agencyService;
     public $agency;


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
        
        $agency = $this->agencyService->getAgencyData();  
        // dd($agency); 
        $this->user = $this->agencyService->getCurrentLoginUser();  

        $visapermission=UserServiceAssignment::
        where('agency_id',$agency->id)
        ->where('service_id','3')->first(); 
        if($visapermission){
            $this->visapermission=true;  
        }else{
            $this->visapermission=false;  
        }

  
      
      
        // Extract services safely
         $this->agency = Agency::with('userAssignments.service','domains')->find($agency->id);
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
            'agency' => $this->agency,
            'visapermission'=>$this->visapermission,
        ]);
    }
}
