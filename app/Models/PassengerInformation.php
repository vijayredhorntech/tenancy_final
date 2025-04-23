<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class PassengerInformation extends Model
{

    use HasFactory,SoftDeletes;

    protected $table = 'flight_bookings_passenger_details';
       // Relationship: A passenger belongs to a flight booking
       public function flightBooking() {
        return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
    }

    // Relationship: A passenger belongs to an agency
    public function agency() {
        return $this->belongsTo(Agency::class);
    }
}
