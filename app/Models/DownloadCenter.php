<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DownloadCenter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'client_id',
        'documents',
        'agency_id',
        'booking_id',
        'booking_type',
    ];

    protected $casts = [
        'documents' => 'array',
    ];
}
