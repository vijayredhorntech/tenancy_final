<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaSection extends Model
{
    //
    protected $fillable = [
        'section_name',
        'slug',
        'fields',
    ];

    protected $casts = [
        'fields' => 'array', // Automatically cast JSON to array
    ];
    
}
