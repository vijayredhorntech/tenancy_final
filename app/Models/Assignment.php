<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by'); 
    }

      /**
     * Get the team that the assignment is assigned to.
     */
    public function team()
    {
        return $this->hasOne(TeamManagement::class, 'id','assign_id');
                    
    }

    public function teammember()
    {
        return $this->hasMany(TeamUser::class, 'team_management_id','assign_id');
                    
    }
    
}
