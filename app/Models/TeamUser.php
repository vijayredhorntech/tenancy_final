<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamUser extends Pivot
{
    use HasFactory,SoftDeletes;

    protected $table = 'team_user'; // Define pivot table

    protected $fillable = ['user_id', 'team_management_id'];

    public $timestamps = false;


    public function membername()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
