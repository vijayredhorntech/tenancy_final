<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthervisaApplication extends Model
{
    use HasFactory;

    protected $table = 'authervisa_applications'; // Table name

    protected $fillable = [
        'booking_id',
        'member_id',
        'name',
        'lastname',
        'email',
        'phone',
        'citizenship',
        'date_of_entry'
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
