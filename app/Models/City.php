<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'CityId',
        'CityName',
        'countryId',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
}
