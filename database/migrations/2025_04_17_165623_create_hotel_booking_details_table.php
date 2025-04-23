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
        Schema::create('hotel_booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_booking_id')->constrained('hotel_bookings')->onDelete('cascade');
            $table->string('vendor_name')->nullable();
            $table->string('hotel_name')->nullable();
            $table->json('selected_operator')->nullable();
            $table->json('hotel_json_data')->nullable();
            $table->json('passenger_details')->nullable();
            $table->json('morehotel_details')->nullable(); 
            $table->string('booking_reference')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_booking_details');
    }
};
