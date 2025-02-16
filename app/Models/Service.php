<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function userAssignments()
            {
                return $this->hasMany(UserAssignment::class, 'service_id');
            }

}
