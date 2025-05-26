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
        Schema::create('visa_related_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visa_id')->nullable();
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->unsignedBigInteger('bookingid')->nullable();


            $table->string('type_of_visa_required')->nullable();
            $table->string('number_of_entries')->nullable();
            $table->string('period_of_visa_month')->nullable();
            $table->date('expected_date_of_journey')->nullable();
            $table->string('port_of_arrival')->nullable();
            $table->string('port_of_exit')->nullable();

            $table->text('places_to_be_visited')->nullable();
            $table->string('purpose_of_visit')->nullable();

            $table->text('previous_visit_details')->nullable();
            $table->boolean('ever_visited_india')->nullable();
            $table->text('address_stayed_in_india')->nullable();
            $table->text('cities_visited_in_india')->nullable();
            $table->string('previous_visa_type')->nullable();
            $table->string('previous_visa_number')->nullable();
            $table->string('previous_visa_issued_place')->nullable();
            $table->date('previous_visa_issue_date')->nullable();

            $table->text('countries_visited_last_10_years')->nullable();
            $table->text('otherdocument')->nullable();

            $table->boolean('visa_refused_or_deported')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_related_documents');
    }
};
