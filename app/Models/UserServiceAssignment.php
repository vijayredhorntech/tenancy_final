<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserServiceAssignment extends Model
{
    use HasFactory,SoftDeletes;

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


                
                public function agency()
                {
                    return $this->hasOne(Agency::class, 'id', 'agency_id');
                }


}
