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
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('agnecy_email');
            $table->string('domain');
            $table->string('database');
            $table->unsignedBigInteger('agency_id'); 
            $table->unsignedBigInteger('user_id')->nullable(); // Made user_id nullable
            $table->string('booking_number');
            $table->string('invoice_number');
            $table->json('details'); // Changed from array to json
            $table->json('flightSearch');
        
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
