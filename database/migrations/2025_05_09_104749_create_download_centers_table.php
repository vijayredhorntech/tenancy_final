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
        Schema::create('download_centers', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->json('documents')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->string('booking_type')->nullable(); // e.g., hotel, flight, etc.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_centers');
    }
};
