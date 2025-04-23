<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyUserLeave extends Model
{
    use SoftDeletes;
    
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leave_id', 'id');
    }


    public function leaveName()
    {
        return $this->hasOne(Leave::class,'id' , 'leave_id');
    }


    public function userName()
    {
        return $this->hasOne(User::class, 'id' , 'user_id');
    }
}
