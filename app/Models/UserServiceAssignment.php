<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceAssignment extends Model
{
    use HasFactory;

    protected $table = 'user_service_assignments';
    

    protected $fillable = ['user_id', 'service_id'];

    // public function user()
    // {   
    //     return $this->belongsTo(User::class);
    // }

    // public function service()
    // {
    //     return $this->belongsTo(Service::class);
    // }

                public function service()
                {
                    return $this->belongsTo(Service::class, 'service_id');
                }

}
