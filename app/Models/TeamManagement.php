<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamManagement extends Model
{
    use HasFactory;

    protected $table = 'team_managements'; // Define table name if different from model name

    protected $fillable = [
        'team_name',
        'description',
        'manager_id',
    ];
    
    // Relationship: A team belongs to a manager (u ser)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // If teams have members
    public function members()
    {
        return $this->hasMany(TeamUser::class, 'team_management_id','id');
    }
}
