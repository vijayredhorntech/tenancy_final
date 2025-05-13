<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon; 
use Illuminate\Support\Collection;



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


    /***Count Present **** */


    
    public function countAttendanceStatus($status = 'Present', $date_from = null, $date_to = null)
    {
        $date_from = $date_from instanceof Carbon ? $date_from : now()->startOfMonth();
        $date_to = $date_to instanceof Carbon ? $date_to : now()->endOfMonth();
    
        return $this->attendance->filter(function ($att) use ($status, $date_from, $date_to) {
            $date = Carbon::parse($att->date);
            return $att->attendance_status === $status &&
                   $date->between($date_from, $date_to);
        })->count();
    }
    
    public function countAbsent($date_from = null, $date_to = null)
    {
        $date_from = $date_from instanceof Carbon ? $date_from : now()->startOfMonth();
        $date_to = $date_to instanceof Carbon ? $date_to : now()->endOfMonth();
    
        // Generate all dates in range
        $allDates = [];
        for ($date = $date_from->copy(); $date->lte($date_to); $date->addDay()) {
            $allDates[] = $date->toDateString();
        }
    
        // Dates when present
        $presentDates = $this->attendance->filter(function ($att) use ($date_from, $date_to) {
            $date = Carbon::parse($att->date);
            return $att->attendance_status === 'Present' &&
                   $date->between($date_from, $date_to);
        })->pluck('date')->map(fn($date) => Carbon::parse($date)->toDateString())->toArray();
    
        // Absent = all - present
        $absentDates = array_diff($allDates, $presentDates);
    
        return count($absentDates);
    }
    

    
}
