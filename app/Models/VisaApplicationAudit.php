<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaApplicationAudit extends Model
{
    protected $table = 'visaapplication_audit';

    protected $fillable = [
        'application_id',
        'application_number',
        'user_id',
        'user_type',
        'audit_name',
        'description',
        'audit_date',
        'audit_time',
    ];

    protected $casts = [
        'audit_date' => 'date',
        'audit_time' => 'datetime:H:i:s',
    ];


   
}
