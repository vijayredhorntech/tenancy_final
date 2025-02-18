<?php

namespace App\View\Components;

use App\Models\Flight\FlightSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FlightInfoCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $flightPrice;
    public function __construct(public $flight, public $flightSearch, public $id, public $customSettings, public $defaultSettings, public $airlines)
    {
        // if($customSettings->count()){
        //     $settings = $customSettings->first();
        // } else {
        //     $settings = $this->defaultSettings;
        // }

        // $settings = $this->defaultSettings;
        // dd($settings);
  
        // $this->flightPrice = $settings->markupType == 'percentage' ? $flight['totalPrice'] + ($flight['totalPrice'] * $settings->markupValue / 100) : $flight['totalPrice'] + $settings->markupValue;

        $settings = $this->defaultSettings;

            $this->flightPrice = $settings['markupType'] == 'percentage' 
                ? $flight['totalPrice'] + ($flight['totalPrice'] * $settings['markupValue'] / 100) 
                : $flight['totalPrice'] + $settings['markupValue'];

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.flight.flight-info-card');
    }
}
