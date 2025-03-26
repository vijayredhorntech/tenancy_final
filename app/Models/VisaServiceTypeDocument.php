<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaServiceTypeDocument extends Model
{
    use HasFactory;

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
}
