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
        'client_id',
        'agency_id',
        'client_name',
        'first_name',
        'last_name',
        'gender',
        'marital_status',
        'date_of_birth',
        'phone_number',
        'email',
        'zip_code',
        'address',
        'street',
        'city',
        'country',
        'permanent_address',
        'passport_ic_number',
        'passport_issue_date',
        'passport_expiry_date',
        'passport_issue_place',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
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

    // Relationship with OtherClientInfo Model
    public function clientinfo()
    {
        return $this->hasOne(OtherClientInfo::class, 'authervisa_application_id');
    }

    public function client()
    {
        return $this->hasOne(ClientDetails::class, 'id', 'client_id');
    }
}
