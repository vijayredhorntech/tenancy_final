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
        Schema::create('authervisa_applications', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('booking_id'); // Foreign key reference to bookings table
            $table->unsignedBigInteger('clint_id')->nullable(); // Foreign key reference to members (nullable)
            $table->string('name'); // First name
            $table->string('lastname'); // Last name
            $table->string('email')->nullable(); // Email (optional)
            $table->string('phone')->nullable(); // Phone number (optional)
            $table->string('citizenship')->nullable(); // Citizenship
            $table->timestamps(); // Created at & Updated at

            // Add foreign key constraints if needed
            $table->foreign('booking_id')->references('id')->on('visabookings')->onDelete('cascade');
            $table->foreign('clint_id')->references('id')->on('client_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authervisa_applications');
    }
};
