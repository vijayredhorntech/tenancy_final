<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocSignDocument extends Model
{
    // Tell Laravel the custom table name
    protected $table = 'docsigndocuments';

    protected $fillable = [
        'name',
        'servicerelatedtableid',
        'document_type',
        'document_name',
        'termandcondition',
        'termstype',
        'terms_data',
        'document_file',
        'user_type',
        'user_id',
        'client_id',
        'agency_id',
        'related_id',
        'type_of_document',
    ];

    protected $casts = [
        'document_type' => 'array',
        'document_name' => 'array',
        'termandcondition' => 'array',
        'termstype' => 'array',
        'terms_data' => 'array',
        'document_file' => 'array',
    ];

    // Optional: Link to users table if needed
    public function agency()
    {
        return $this->hasOne(Agency::class, 'id','user_id');
    }

    public function sign()
    {
        return $this->hasOne(DocSignProcess::class, 'document_id','id');
    }

    public function docsign()
    {
        return $this->hasOne(DocSignProcess::class, 'document_id','id');
    }

    public function visaBookingApplication()
    {
        return $this->hasOne(VisaBooking::class, 'id','servicerelatedtableid');
    }
    
}
