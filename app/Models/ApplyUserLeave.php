<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyUserLeave extends Model
{
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leave_id', 'id');
    }
}
