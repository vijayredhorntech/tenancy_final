<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightRequest extends Model
{
    protected $fillable = [
        'service_type',
        'agency_id',
        'origin',
        'destination',
        'departure_date',
        'return_date',
        'trip_type',
        'adults',
        'children',
        'infants',
        'cabin_class',
        'currency',
        'preferred_airline',
        'direct_flight',
        'flexi_dates',
        'first_name',
        'last_name',
        'full_name',
        'email',
        'phone_number',
        'nationality',
        'zipcode',
        'address',
        'city',
        'date_of_entry',
        'status',
        'special_requirements',
        'budget_range',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'date_of_entry' => 'date',
        'direct_flight' => 'boolean',
        'flexi_dates' => 'boolean',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
