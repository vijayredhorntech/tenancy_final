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
        Schema::create('flight_bookings_passenger_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('flight_booking_id'); // Foreign key to flight_bookings
            $table->string('booking_number');
            $table->string('invoice_number');
            $table->json('adult')->nullable();
            $table->json('children')->nullable();
            $table->json('infant')->nullable();
            $table->string('postcode');
            $table->string('address_line');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('email_id');
            $table->string('mobile');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('flight_booking_id')->references('id')->on('flight_bookings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings_passenger_details');
    }
};
