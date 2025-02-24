<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;


    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function service_name()
    {
        return $this->belongsTo (Service::class, 'service'); // 'service' is the foreign key column in deductions table
    }

    public function flightBooking()
    {
        return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
    }
    
}
