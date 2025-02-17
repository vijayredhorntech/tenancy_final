<?php

namespace App\View\Components;

use App\Models\Airline;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FlightSearch extends Component
{
    public $cabinClasses = [
        'Economy' => 'Economy',
        'PremiumEconomy' => 'Premium Economy',
        'Business' => 'Business',
        'First' => 'First',
    ];
    
    public $currencies = [
        'GBP' => 'GBP',
        'USD' => 'USD',
        'EUR' => 'EUR',
        'INR' => 'INR',
    ];

    public $airlines;
    public $fareTypes = [
        'PublicFaresOnly' => 'Public Fares Only',
        'PrivateFaresOnly' => 'Private Fares Only',
    ];

    // ✅ Define the property explicitly to prevent the undefined property error
    public array $defaults = [];

    public function __construct(array $defaults = [])
    {
        $this->airlines = Airline::all()->pluck('name', 'iata');

        $this->defaults = $defaults ?: [
            'origin' => old('origin'),
            'destination' => old('destination'),
            'departureDate' => old('departureDate'),
            'returnDate' => old('returnDate'),
            'flexi' => old('flexi'),
            'type' => old('type') ?? 'return',
            'adult' => old('adult') ?? 1,
            'child' => old('child') ?? 0,
            'infant' => old('infant') ?? 0,
            'cabinClass' => old('cabinClass') ?? 'Economy',
            'currency' => old('currency') ?? 'GBP',
            'fareType' => old('fareType') ?? 'PublicFaresOnly',
            'preferredAirline' => old('preferredAirline') ?? '',
            'directFlight' => old('directFlight') ?? false,
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.flight-search');
    }
}
