<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;



class UserMetaPassportDetails extends Model
{
    use HasFactory;

    protected $table = 'user_meta_passportdetails';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
