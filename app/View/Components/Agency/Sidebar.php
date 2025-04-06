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
        // $userData = session('user_data', []);

        // if (!isset($userData['database'])) {
        //     return;
        // }

        // DatabaseHelper::setDatabaseConnection($userData['database']);
        // $user = User::on('user_database')->where('email', $userData['email'])->first();

        // if (!$user) {
        //     return;
        // }

     


        // Get session data safely
      

        // Set the dynamic database connection
        // DatabaseHelper::setDatabaseConnection($userData['database']);

        
        // Fetch user from the dynamic database connection
        // $this->user = User::on('user_database')->where('id', $user->id)->first();

        // if (!$this->user) {
        //     return;
        // }

        // Fetch agency details
        // if( $this->user->type=="staff"){

        //     $agencyRecord = Agency::where('database_name', $userData['database'])->first();

        // }else{
        //     $agencyRecord = Agency::where('email', $this->user->email)->first();
        // }
       
      
        // if (!$agencyRecord) {
        //     return;
        // }

        // $agency = Agency::with('userAssignments.service')->find($agencyRecord->id);
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
            'visapermission'=>$this->visapermission,
        ]);
    }
}
