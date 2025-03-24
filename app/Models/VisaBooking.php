<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaBooking extends Model
{
    //
    use HasFactory;

    protected $table = 'visabookings';
    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visa()
    {
        return $this->belongsTo(Visa::class, 'visaid');
    }

    public function origin()
    {
        return $this->belongsTo(Location::class, 'originid');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destinationid');
    }
}
