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

        // Personal Details
        'title',
        'full_name',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'preview_name',
        'country_of_citizenship',
        'nationality_at_birth',
        'marital_status',
        'past_nationality',
        'religion',
        'visible_identification_marks',
        'languages_spoken',
        'citizenship',

        // Contact Details
        'current_residential_address',
        'city',
        'state',
        'postal_code',
        'permanent_residential_address',
        'country_of_residence',
        'phone_mobile',
        'phone_landline',
        'email_address',

        // Passport Information
        'passport_type',
        'passport_number',
        'place_of_issue',
        'date_of_issue',
        'date_of_expiry',
        'issuing_authority',
        'previous_passport_number',

        // Father Section
        'father_full_name',
        'father_place_of_birth',
        'father_nationality',
        'father_previous_nationality',
        'father_country_of_birth',
        'father_dob',
        'father_employment',
        'father_status_in_china',

        // Mother Section
        'mother_full_name',
        'mother_place_of_birth',
        'mother_nationality',
        'mother_previous_nationality',
        'mother_country_of_birth',
        'mother_dob',
        'mother_employment',
        'mother_status_in_china',

        // Spouse Section
        'spouse_full_name',
        'spouse_nationality',
        'spouse_place_of_birth',
        'spouse_previous_nationality',
        'spouse_country_of_birth',
        'spouse_dob',
        'spouse_employment_status',
        'spouse_address',

        // Employment / Education Details
        'occupation',
        'past_occupation',
        'designation',
        'employer_name',
        'business_name',
        'school_name',
        'employer_address',
        'employer_phone_number',
        'employment_duration',
        'duty',
        'study_duration',
        'employment_monthly_income',
        'educational_qualifications',

        // Military / Service History
        'military_status',
        'service_date_from',
        'service_date_to',

        // Social Media / Online Presence
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'other_social_media',
        'personal_website',
        'blog_urls',
    ];

    public function authervisaApplication()
    {
        return $this->belongsTo(AuthervisaApplication::class, 'authervisa_application_id');
    }
}
 