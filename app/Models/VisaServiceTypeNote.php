<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaServiceTypeNote extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'visa_service_types_id',
        'note',
    ];
    public function visaServiceType()
    {
        return $this->belongsTo(VisaServiceType::class);
    }
}
