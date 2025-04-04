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
        return $this->hasOne(VisaServices::class, 'id', 'visa_id');
    }

    public function origin()
    {
        return $this->hasOne(Country::class, 'id','origin_id');
    }


    public function destination()
    {
        return $this->hasOne(Country::class, 'id','destination_id');
    }

    public function visasubtype(){
        return $this->hasOne(VisaSubtype::class, 'id','subtype_id');
    }
    public function clint(){
        return $this->hasOne(ClientDetails::class, 'id','client_id');
    }

    public function otherclients(){
        return $this->hasMany(AuthervisaApplication::class, 'booking_id','id');
    }


   
}
