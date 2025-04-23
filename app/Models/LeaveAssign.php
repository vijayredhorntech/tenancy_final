<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveAssign extends Model
{
    use SoftDeletes;
    
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leave_type', 'id');
    }
}
