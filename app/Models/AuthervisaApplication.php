<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthervisaApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'authervisa_applications'; // Table name

    protected $fillable = [
        'booking_id',
        'clint_id',
        'member_id',
        'name',
        'lastname',
        'email',
        'phone',
        'citizenship',
        'date_of_entry',
        'passport_number',
        'passport_issue_date',
        'passport_expire_date',
        'place_of_issue',
        'passportphoto',
    ];

    // Relationship with Booking Model
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Relationship with Member Model (if applicable)
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
