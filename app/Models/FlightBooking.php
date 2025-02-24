<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;
    // Relationship: A flight booking can have multiple passengers
    public function passengers() {
        return $this->hasMany(PassengerInformation::class, 'flight_booking_id');
    }

    // Relationship: A flight booking belongs to an agency
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // Relationship: A flight booking may belong to a user (nullable)
    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function flightBooking()
        {
            return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
        }

}
