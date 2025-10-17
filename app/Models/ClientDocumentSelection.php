<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocumentSelection extends Model
{
    protected $connection = 'user_database';
    protected $fillable = ['agency_id','client_id','booking_id'];

    public function booking()
    {
        return $this->belongsTo(VisaBooking::class, 'booking_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }
}


