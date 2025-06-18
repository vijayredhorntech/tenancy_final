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
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn([
                'number_of_entries',
                'visa_period',
                'expected_journey_date',
                'port_of_arrival',
                'port_of_exit',
                'places_to_visit',
                'visited_india_before',
                'address_in_india',
                'cities_visited',
                'previous_visa_number',
                'previous_visa_place',
                'previous_visa_issue_date',
                'countries_visited_last_10_years',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            // Add columns back here if needed (you'll need to define the types again)
            $table->string('number_of_entries')->nullable();
            $table->string('visa_period')->nullable();
            $table->date('expected_journey_date')->nullable();
            $table->string('port_of_arrival')->nullable();
            $table->string('port_of_exit')->nullable();
            $table->text('places_to_visit')->nullable();
            $table->boolean('visited_india_before')->nullable();
            $table->text('address_in_india')->nullable();
            $table->text('cities_visited')->nullable();
            $table->string('previous_visa_number')->nullable();
            $table->string('previous_visa_place')->nullable();
            $table->date('previous_visa_issue_date')->nullable();
            $table->text('countries_visited_last_10_years')->nullable();
        });
    }
};
