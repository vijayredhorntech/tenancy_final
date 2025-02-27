<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveAssign extends Model
{
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leave_type', 'id');
    }
}
