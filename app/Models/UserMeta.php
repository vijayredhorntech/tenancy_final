<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMeta extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_meta';

    protected $fillable = [
        'user_id',
        'phone_number',
        'phone_code',
        'country_code',
        'address',
        'state',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
