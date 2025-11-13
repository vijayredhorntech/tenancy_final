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

            // Relations
            $table->unsignedBigInteger('authervisa_application_id')->nullable()->index();
            $table->enum('application_type', ['family', 'other'])->nullable();
            $table->unsignedBigInteger('client_id')->nullable()->index();
            $table->unsignedBigInteger('family_id')->nullable()->index();

            // Client details
            $table->string('previous_name')->nullable();
            $table->boolean('previous_name_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('citizenship_id')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('identification_marks')->nullable();
            $table->string('nationality')->nullable();
            $table->string('past_nationality')->nullable();
            $table->string('passport_country')->nullable();
            $table->string('passport_issue_place')->nullable();
            $table->string('passport_ic_number')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->enum('haspassportidenty', ['yes', 'no'])->nullable();
            $table->text('other_passport_details')->nullable();

            // Family details
            $table->text('father_details')->nullable();
            $table->text('mother_details')->nullable();
            $table->text('spouse_details')->nullable();
            $table->text('children')->nullable();

            // Occupation details
            $table->string('present_occupation')->nullable();
            $table->string('designation')->nullable();
            $table->string('employer_name')->nullable();
            $table->text('employer_address')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('past_occupation')->nullable();

            // References
            $table->string('reference_name')->nullable();
            $table->text('reference_address')->nullable();

            // Permissions
            $table->boolean('personal_details_permission')->default(0);
            $table->boolean('other_details_permission')->default(0);
            $table->boolean('address_permission')->default(0);
            $table->boolean('passport_details_permission')->default(0);
            $table->boolean('additional_passport_info_permission')->default(0);
            $table->boolean('family_details_permission')->default(0);
            $table->boolean('wife_details_permission')->default(0);
            $table->boolean('children_permission')->nullable();
            $table->boolean('occupation_details_permission')->default(0);
            $table->boolean('armed_force_details_permission')->default(0);
            $table->boolean('armed_permission')->nullable();

            // Other details
            $table->text('arms_details')->nullable();
            $table->string('title')->nullable();
            $table->string('language_spoken')->nullable();
            $table->string('citizenship_national_id_no')->nullable();
            $table->text('employment')->nullable();
            $table->text('education')->nullable();
            $table->text('social_media')->nullable();
            $table->string('has_military')->nullable();
            $table->longText('military_info')->nullable();
            $table->text('relative_information')->nullable();
            $table->string('passport_type')->nullable();
            $table->string('duty')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_client_infos');
    }
};
