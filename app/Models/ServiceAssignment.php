<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAssignment extends Model
{
    use HasFactory,SoftDeletes;

    
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
