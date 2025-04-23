<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'countryCode',
        'countryName',
    ];
    public function visaServices() : HasManyThrough
    {
        return $this->HasManyThrough(Country::class, VisaServices::class,'origin','id','id','destination');
    }

    
    public static function data()
    {
        return self::all()->map(function ($country){
            return [
                'code' => $country->countryCode,
                'name' => $country->countryName,
            ];
        });
    }

    public function cities()
    {
        return $this->hasMany(City::class,'countryId','id');
    }
}
