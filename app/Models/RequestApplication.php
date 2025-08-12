<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestApplication extends Model
{
    //
       protected $fillable = [
        'service_type',
        'agency_id',
        'country_id',
        'visa_id',
        'visa_subtype',
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
    ];

      public function visa()
    {
        return $this->hasOne(VisaServices::class, 'id', 'visa_id');
    }

    // public function origin()
    // {
    //     return $this->hasOne(Country::class, 'id','origin_id');
    // }


    // public function destination()
    // {
    //     return $this->hasOne(Country::class, 'id','destination_id');
    // }

    public function visasubtype(){
        return $this->hasOne(VisaSubtype::class, 'id','visa_subtype');
    }

      public function combination(){
        return $this->hasOne(VisaServiceType::class, 'id','country_id');
    }

    
}
