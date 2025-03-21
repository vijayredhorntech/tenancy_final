<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaServiceTypeEntries extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_service_type_id',
        'entry_type',
        'duration',
        'processing_time',
        'embassy_fee',
        'service_fee',
        'vat',
        'total_cost',
    ];

    public function visaServiceType()
    {
        return $this->belongsTo(VisaServiceType::class);
    }
}
