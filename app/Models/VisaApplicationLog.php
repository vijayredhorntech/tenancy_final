<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplicationLog extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name (optional)
    protected $table = 'visaapplication_logs';

    // Define the fillable properties (for mass assignment)
    protected $fillable = [
        'booking_id',
        'application_number',
        'field_name',
        'old_value',
        'new_value',
        'type',
    ];

    // Define the timestamps if you don't want to use created_at/updated_at (optional)
    public $timestamps = true;
}
