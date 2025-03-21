<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_services_id',
        'visa_type',
        'visa_required',
        'visa_on_arrival',
    ];

    public function visaService()
    {
        return $this->belongsTo(VisaServices::class);
    }
    public function visaServiceTypeNotes()
    {
        return $this->hasMany(VisaServiceTypeNote::class);
    }
    public function visaServiceTypeDocuments()
    {
        return $this->hasMany(VisaServiceTypeDocument::class);
    }
    public function visaServiceTypeFaq()
    {
        return $this->hasMany(VisaServiceTypeFaq::class);
    }
    public function visaServiceTypeEntry()
    {
        return $this->hasMany(VisaServiceTypeEntries::class);
    }
}
