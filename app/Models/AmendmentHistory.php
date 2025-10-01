<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmendmentHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'application_id',
        'origin_id',
        'destination_id',
        'visa_id',
        'subtype_id',
        'agency_id',
        'user_id',  
        'booking_id',
        'visa_type',
        'application_number',
        'total_price',
        'dateofentry',
    ];
}
