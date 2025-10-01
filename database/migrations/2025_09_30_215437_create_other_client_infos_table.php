<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('other_client_infos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('authervisa_application_id')->nullable();

    // Personal Details
    $table->string('title', 50)->nullable();
    $table->string('full_name', 150)->nullable();
    $table->string('gender', 20)->nullable();
    $table->date('date_of_birth')->nullable();
    $table->string('place_of_birth', 150)->nullable();
    $table->string('preview_name', 150)->nullable();
    $table->string('country_of_citizenship', 150)->nullable();
    $table->string('nationality_at_birth', 150)->nullable();
    $table->string('marital_status', 100)->nullable();
    $table->string('past_nationality', 150)->nullable();
    $table->string('religion', 100)->nullable();
    $table->text('visible_identification_marks')->nullable();
    $table->text('languages_spoken')->nullable();
    $table->string('citizenship', 150)->nullable();

    // Contact Details
    $table->text('current_residential_address')->nullable();
    $table->string('city', 100)->nullable();
    $table->string('state', 100)->nullable();
    $table->string('postal_code', 50)->nullable();
    $table->text('permanent_residential_address')->nullable();
    $table->string('country_of_residence', 150)->nullable();
    $table->string('phone_mobile', 50)->nullable();
    $table->string('phone_landline', 50)->nullable();
    $table->string('email_address', 191)->nullable(); // 191 to avoid index issues

    // Passport Information
    $table->string('passport_type', 100)->nullable();
    $table->string('passport_number', 100)->nullable();
    $table->string('place_of_issue', 150)->nullable();
    $table->date('date_of_issue')->nullable();
    $table->date('date_of_expiry')->nullable();
    $table->string('issuing_authority', 150)->nullable();
    $table->string('previous_passport_number', 100)->nullable();

    // Father Section
    $table->string('father_full_name', 150)->nullable();
    $table->string('father_place_of_birth', 150)->nullable();
    $table->string('father_nationality', 150)->nullable();
    $table->string('father_previous_nationality', 150)->nullable();
    $table->string('father_country_of_birth', 150)->nullable();
    $table->date('father_dob')->nullable();
    $table->string('father_employment', 150)->nullable();
    $table->string('father_status_in_china', 150)->nullable();

    // Mother Section
    $table->string('mother_full_name', 150)->nullable();
    $table->string('mother_place_of_birth', 150)->nullable();
    $table->string('mother_nationality', 150)->nullable();
    $table->string('mother_previous_nationality', 150)->nullable();
    $table->string('mother_country_of_birth', 150)->nullable();
    $table->date('mother_dob')->nullable();
    $table->string('mother_employment', 150)->nullable();
    $table->string('mother_status_in_china', 150)->nullable();

    // Spouse Section
    $table->string('spouse_full_name', 150)->nullable();
    $table->string('spouse_nationality', 150)->nullable();
    $table->string('spouse_place_of_birth', 150)->nullable();
    $table->string('spouse_previous_nationality', 150)->nullable();
    $table->string('spouse_country_of_birth', 150)->nullable();
    $table->date('spouse_dob')->nullable();
    $table->string('spouse_employment_status', 150)->nullable();
    $table->text('spouse_address')->nullable();

    // Employment & Education
    $table->string('occupation', 150)->nullable();
    $table->string('past_occupation', 150)->nullable();
    $table->string('designation', 150)->nullable();
    $table->string('employer_name', 150)->nullable();
    $table->string('business_name', 150)->nullable();
    $table->string('school_name', 150)->nullable();
    $table->text('employer_address')->nullable();
    $table->string('employer_phone_number', 100)->nullable();
    $table->string('employment_duration', 150)->nullable();
    $table->string('duty', 150)->nullable();
    $table->string('study_duration', 150)->nullable();
    $table->string('employment_monthly_income', 100)->nullable();
    $table->text('educational_qualifications')->nullable();

    // Military / Service History
    $table->string('military_status', 150)->nullable();
    $table->string('service_date_from', 150)->nullable();
    $table->string('service_date_to', 150)->nullable();

    // Social Media / Online Presence
    $table->string('facebook', 191)->nullable();
    $table->string('instagram', 191)->nullable();
    $table->string('twitter', 191)->nullable();
    $table->string('linkedin', 191)->nullable();
    $table->string('other_social_media', 191)->nullable();
    $table->string('personal_website', 191)->nullable();
    $table->string('blog_urls', 191)->nullable();

    $table->timestamps();
    $table->softDeletes();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('other_client_infos');
    }
};
