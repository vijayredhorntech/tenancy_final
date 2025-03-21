<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaServiceTypeFaq extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_service_types_id',
        'question',
        'answer',
    ];

    public function visaServiceType()
    {
        return $this->belongsTo(VisaServiceType::class);
    }
}
