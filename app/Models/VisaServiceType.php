<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaServiceType extends Model
{
    use HasFactory;

    protected $table = 'visa_service_country'; // Specify the table name
    
   

    public function visaService()
    {
        return $this->belongsTo(VisaServices::class);
    }

    public function VisaServices(){
        return $this->hasOne(VisaServices::class,'id','visa_id');
    }

    public function Subvisas(){
        return $this->hasMany(VisaSubtype::class,'visa_type_id','visa_id');
    }

    public function origincountry(){
        return $this->hasOne(Country::class,'id','origin');
    }
    public function destinationcountry(){
        return $this->hasOne(Country::class,'id','destination');
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
