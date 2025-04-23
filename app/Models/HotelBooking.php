<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelBooking extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'agency_id',
        'user_id',
        'agency_email',
        'domain',
        'database',
        'checkin_date',
        'checkout_date',
        'price',
        'total_person',
        'booking_id',
        'invoice_number',
        'total_price',
    ];

    public function details()
    {
        return $this->hasMany(HotelBookingDetail::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
