<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Navbar extends Component
{
    public $user;
    public $login_time; // Declare login_time property
    public $isSuperAdmin; 

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $date = Carbon::now()->toDateString();

        $this->user = Auth::user();

        if ($this->user) {

            
            // dd($this->user);
            // Get the latest login time from Attendance table for today's date
            $attendance = Attendance::where('user_id', $this->user->id)
                ->where('date', $date) // Corrected 'data' to 'date'
                ->first();

            $this->login_time = $attendance ? $attendance->login_time : null; // Assign login time or null
        } else {
            $this->login_time = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.front.navbar', [
            'user' => $this->user,
            'login_time' => $this->login_time,
            'isSuperAdmin' => $this->isSuperAdmin,  // Pass login time to the view
        ]);
    }
}
