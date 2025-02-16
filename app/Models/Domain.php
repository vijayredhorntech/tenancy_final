<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

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

