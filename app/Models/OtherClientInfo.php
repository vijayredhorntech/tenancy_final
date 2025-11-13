<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherClientInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'other_client_infos';

   protected $fillable = [
        'authervisa_application_id',
        'application_type',
        'client_id',
        'family_id',
        'previous_name',
        'previous_name_status',
        'religion',
        'place_of_birth',
        'country_of_birth',
        'citizenship_id',
        'educational_qualification',
        'identification_marks',
        'nationality',
        'past_nationality',
        'passport_country',
        'passport_issue_place',
        'passport_ic_number',
        'passport_issue_date',
        'passport_expiry_date',
        'haspassportidenty',
        'other_passport_details',
        'father_details',
        'mother_details',
        'spouse_details',
        'children',
        'present_occupation',
        'designation',
        'employer_name',
        'employer_address',
        'employer_phone',
        'past_occupation',
        'reference_name',
        'reference_address',
        'personal_details_permission',
        'other_details_permission',
        'address_permission',
        'passport_details_permission',
        'additional_passport_info_permission',
        'family_details_permission',
        'wife_details_permission',
        'children_permission',
        'occupation_details_permission',
        'armed_force_details_permission',
        'armed_permission',
        'arms_details',
        'title',
        'language_spoken',
        'citizenship_national_id_no',
        'employment',
        'education',
        'social_media',
        'has_military',
        'military_info',
        'relative_information',
        'passport_type',
        'duty',
        'date_from',
        'date_to',
    ];

    protected $casts = [
        'previous_name_status' => 'boolean',
        'personal_details_permission' => 'boolean',
        'other_details_permission' => 'boolean',
        'address_permission' => 'boolean',
        'passport_details_permission' => 'boolean',
        'additional_passport_info_permission' => 'boolean',
        'family_details_permission' => 'boolean',
        'wife_details_permission' => 'boolean',
        'children_permission' => 'boolean',
        'occupation_details_permission' => 'boolean',
        'armed_force_details_permission' => 'boolean',
        'armed_permission' => 'boolean',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
        'date_from' => 'date',
        'date_to' => 'date',
    ];

    // 🔗 Relationships
    public function authervisaApplication()
    {
        return $this->belongsTo(AuthervisaApplication::class, 'authervisa_application_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }
}
 