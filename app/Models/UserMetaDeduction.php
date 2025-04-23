<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserMetaDeduction extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_meta_deduction';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
