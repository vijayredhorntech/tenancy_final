<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by'); 
    }
}
