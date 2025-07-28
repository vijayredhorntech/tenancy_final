<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'agency_id',
        'service',
        'invoice_number',
        'flight_booking_id',
        'amount',
        'date',
        'superadmin_invoice_number',
    ];
    

    public function agency()
        {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function service_name()
    {
        return $this->belongsTo (Service::class, 'service'); // 'service' is the foreign key column in deductions table
    }

    public function flightBooking()
    {
        return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
    }
    
    /*****Get visa booking using by  id  the name of hotel_id is flight_booking_id ***** */

    public function visaBooking()
    {
        return $this->hasOne(VisaBooking::class, 'id','flight_booking_id');
    }
    
    public function visaApplicant()
    {
        return $this->hasMany(AuthervisaApplication::class, 'booking_id','flight_booking_id');
    }


    /*****Get Hotel booking using by  hotel_id  the name of hotel_id is flight_booking_id ***** */

    public function hotelBooking()
    {
        return $this->hasOne(HotelBooking::class, 'id','flight_booking_id');
    }
    
    public function hotelDetails()
    {
        return $this->hasOne(HotelBookingDetail::class, 'hotel_booking_id','flight_booking_id');
    }
    
    public function supplier()
    {
        return $this->hasOne(SupplierPaymentDetail::class, 'booking_id', 'id')
                    ->latestOfMany();
    }

    public function allpaydetails()
    {
        return $this->hasMany(SupplierPaymentDetail::class, 'booking_id', 'id');  
    }

    public function cancelinvoice(){
        return $this->hasOne(CancelInvoice::class, 'invoice_id', 'id');
    }
    

    public function invoice(){
        return $this->hasOne(Invoice::class, 'bookingid', 'id');
    }
    
    public function docsign(){
        return $this->hasOne(DocSignDocument::class, 'related_id', 'id');
    }

    
protected static function boot()
    {
        parent::boot();

        static::created(function ($deduction) {
            if (!$deduction->superadmin_invoice_number) {
                $deduction->superadmin_invoice_number = 'CLDSI00' . $deduction->id;
                $deduction->save();
            }
        });
    }

}
