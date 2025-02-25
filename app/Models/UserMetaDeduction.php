<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserMetaDeduction extends Model
{
    use HasFactory;

    protected $table = 'user_meta_deduction';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
