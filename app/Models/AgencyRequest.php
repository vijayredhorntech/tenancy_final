<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'business_type',
        'services',
        'experience',
        'approved',
    ];

    protected $casts = [
        'services' => 'array',
        'approved' => 'boolean',
    ];
}
