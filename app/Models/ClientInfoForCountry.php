<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInfoForCountry extends Model
{
    //
    protected $table = 'client_info_for_country';

    protected $fillable = [
        'section_name',
        'name_of_field',
        'visa_id',
        'assignid',
        'destination_id',
    ];

}
