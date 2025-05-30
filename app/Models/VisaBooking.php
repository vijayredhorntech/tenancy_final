<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaBooking extends Model
{
    //
    use HasFactory,SoftDeletes;

    protected $table = 'visabookings';
    // Define relationships
    

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visa()
    {
        return $this->hasOne(VisaServices::class, 'id', 'visa_id');
    }

    public function origin()
    {
        return $this->hasOne(Country::class, 'id','origin_id');
    }


    public function destination()
    {
        return $this->hasOne(Country::class, 'id','destination_id');
    }

    public function visasubtype(){
        return $this->hasOne(VisaSubtype::class, 'id','subtype_id');
    }
    public function clint(){
        return $this->hasOne(ClientDetails::class, 'id','client_id');
    }

    public function otherclients(){
        return $this->hasMany(AuthervisaApplication::class, 'booking_id','id');
    }

    public function clientapplciation(){
        return $this->hasMany(ClientApplicationDocument::class, 'application_id','id');
    }

    public function downloadDocument(){
        return $this->hasOne(DownloadCenter::class, 'booking_id','id');
    }
    
    public function agency(){
        return $this->hasOne(Agency::class, 'id','agency_id');
    }
    public function clientrequestdocuments(){
        return $this->hasMany(ClientApplicationDocument::class, 'application_id','id');

    }

    public function applicationlog(){
        return $this->hasMany(VisaApplicationAudit::class, 'application_id','id');

    }

    public function clientrequiremtsinfo(){
        return $this->hasOne(ClientInfoForCountry::class, 'destination_id','destination_id');

    }

    public function visarequireddocument(){
        return $this->hasOne(VisaRelatedDocument::class, 'bookingid','id');

    }
   
}
