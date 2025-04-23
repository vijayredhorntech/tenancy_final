<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function userdetails()
    {
        return $this->hasOne(UserMeta::class, 'user_id', 'id'); 
    }

    
    public function passport()
    {
        return $this->hasOne(UserMetaPassportDetails::class, 'user_id', 'id'); 
    }

    public function userdeduction()
    {
        return $this->hasOne(UserMetaDeduction::class, 'user_id', 'id'); 
    }

    public function log()
    {
        return $this->hasMany(UserActivityLog::class, 'user_id', 'id'); 
    }

    public function leaves()
    {
        return $this->hasMany(LeaveAssign::class, 'user_id', 'id'); 
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id'); 
    }

    public function applyLeaves()
    {
        return $this->hasMany(ApplyUserLeave::class, 'user_id', 'id'); 
    }

   


    public function salaryshilp()
    {
        return $this->hasMany(Salary::class, 'user_id', 'id'); 
    }

    public function teams(){
        return $this->hasMany(TeamUser::class, 'user_id', 'id'); 
    }
    

    
}
