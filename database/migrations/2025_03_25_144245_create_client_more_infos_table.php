<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_more_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientid'); // Foreign key to clients table

                // Personal & Passport Info
            $table->string('previous_name')->nullable();
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

            
            // Family Info - JSON
            $table->string('father_details')->nullable();
            $table->string('mother_details')->nullable();
            $table->string('spouse_details')->nullable();
            $table->string('children')->nullable();


            // Visa Info
            $table->string('number_of_entries')->nullable();
            $table->string('visa_period')->nullable();
            $table->date('expected_journey_date')->nullable();
            $table->string('port_of_arrival')->nullable();
            $table->string('port_of_exit')->nullable();
            $table->text('places_to_visit')->nullable();

            // Travel History - JSON
            $table->boolean('visited_india_before')->nullable();
            $table->text('address_in_india')->nullable();
            $table->text('cities_visited')->nullable();
            $table->string('previous_visa_number')->nullable();
            $table->string('previous_visa_place')->nullable();
            $table->date('previous_visa_issue_date')->nullable();
            $table->json('countries_visited_last_10_years')->nullable();

            // Occupation
            $table->string('present_occupation')->nullable();
            $table->string('designation')->nullable();
            $table->string('employer_name')->nullable();
            $table->text('employer_address')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('past_occupation')->nullable();

            // Reference
            $table->string('reference_name')->nullable();
            $table->text('reference_address')->nullable();

            $table->timestamps();
            $table->softDeletes(); // Enable soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_more_infos');
    }
};
