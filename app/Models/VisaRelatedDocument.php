<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaRelatedDocument extends Model
{
    //
    protected $fillable = [
        'visa_id',
        'destination_id',
        'bookingid',
        'type_of_visa_required',
        'number_of_entries',
        'period_of_visa_month',
        'expected_date_of_journey',
        'port_of_arrival',
        'port_of_exit',
        'places_to_be_visited',
        'purpose_of_visit',
        'previous_visit_details',
        'ever_visited_india',
        'address_stayed_in_india',
        'cities_visited_in_india',
        'previous_visa_type',
        'previous_visa_number',
        'previous_visa_issued_place',
        'previous_visa_issue_date',
        'countries_visited_last_10_years',
        'otherdocument',
        'visa_refused_or_deported',
    ];
    
}
