<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaSubtype extends Model
{
    //
    use HasFactory,SoftDeletes;

    protected $fillable = ['country_type_id','visa_type_id', 'name', 'validity', 'processing', 'price', 'commission', 'gstin','status'];

    // Relationship with VisaType model
    public function visaType()
    {
        return $this->belongsTo(VisaType::class);
    }

    public function countryData(){
        return $this->hasOne(VisaServiceType::class, 'id', 'country_type_id');
    }
}
