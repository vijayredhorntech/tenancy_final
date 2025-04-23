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
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('agency_email')->nullable();
            $table->string('domain')->nullable();;
            $table->string('database')->nullable();;
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('total_person')->nullable();
            $table->string('booking_id')->unique();
            $table->string('invoice_number')->unique();
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_bookings');
    }
};
