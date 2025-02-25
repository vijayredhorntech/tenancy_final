<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'url', 'method', 'ip', 'user_agent'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
