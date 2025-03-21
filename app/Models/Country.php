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
        'name',
        'code',
        'flag',
    ];
    public function visaServices() : HasManyThrough
    {
        return $this->HasManyThrough(Country::class, VisaServices::class,'origin','id','id','destination');
    }
}
