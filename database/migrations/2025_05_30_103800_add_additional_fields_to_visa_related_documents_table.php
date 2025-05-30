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
        Schema::table('visa_related_documents', function (Blueprint $table) {
            $table->date('intended_departure_date')->nullable();
            $table->string('duration_of_stay')->nullable();
            $table->text('travel_itinerary')->nullable();
            $table->string('mode_of_transport')->nullable();
            $table->text('visa_history_background')->nullable();
            $table->text('medical_visa_specifics')->nullable();
            $table->text('student_visa_specifics')->nullable();
            $table->text('accommodation_details')->nullable();
            $table->text('host_sponsor_inviter_details')->nullable();
            $table->text('financial_support_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visa_related_documents', function (Blueprint $table) {
            $table->dropColumn([
                'intended_departure_date',
                'duration_of_stay',
                'travel_itinerary',
                'mode_of_transport',
                'visa_history_background',
                'medical_visa_specifics',
                'student_visa_specifics',
                'accommodation_details',
                'host_sponsor_inviter_details',
                'financial_support_details',
            ]);
        });
    }
};
