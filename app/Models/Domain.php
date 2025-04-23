<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'domains';

    protected $fillable = [
        'domain_name', 
        'agency_id', 
        'status', 
        'full_url',
        'user_id',  
    ];


    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}

