<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'leave_type',
        'total_days',
        'status',
    ];

    public function Leavesbalance()
    {
        return $this->hasOne(LeaveBalance::class, 'leave_id', 'id'); 
    }
    // ... other model methods and relationships ...
}
