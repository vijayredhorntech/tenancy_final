<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class City extends Model
{
    use SoftDeletes;
    
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
