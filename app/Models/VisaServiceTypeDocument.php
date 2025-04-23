<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaServiceTypeDocument extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'visa_services'; // Fixed missing quotes and semicolon

    
    protected $fillable = [
        'visa_service_types_id',
        'document_name',
        'document_description',
    ];

    public function visaServiceType()
    {
        return $this->belongsTo(VisaServiceType::class);
    }
    
    public function from(){
        return $this->hasOne(Document::class, 'id','form_id');
    }

    
    public function origin()
    {
        return $this->hasOne(Country::class, 'id','origin_id');
    }


    public function destination()
    {
        return $this->hasOne(Country::class, 'id','destination_id');
    }
}
