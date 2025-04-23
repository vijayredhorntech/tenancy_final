<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HotelBookingDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'hotel_booking_id',
        'vendor_name',
        'hotel_name',
        'hotel_json_data',
        'passenger_details',
        'booking_reference',
    ];

    protected $casts = [
        'hotel_json_data' => 'array',
        'passenger_details' => 'array',
        'selected_operator' => 'array',
        'morehotel_details' => 'array',
    ];

    public function hotelBooking()
    {
        return $this->belongsTo(HotelBooking::class);
    }
}
