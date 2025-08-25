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
        Schema::create('flight_requests', function (Blueprint $table) {
            $table->id();
            $table->string('service_type')->default('Flight');
            $table->foreignId('agency_id')->nullable()->constrained('agencies')->onDelete('cascade');
            $table->string('origin');
            $table->string('destination');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->enum('trip_type', ['oneWay', 'return', 'multiCity'])->default('oneWay');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->string('cabin_class')->default('Economy');
            $table->string('currency')->default('GBP');
            $table->string('preferred_airline')->nullable();
            $table->boolean('direct_flight')->default(false);
            $table->boolean('flexi_dates')->default(false);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('nationality');
            $table->string('zipcode')->nullable();
            $table->text('address');
            $table->string('city');
            $table->date('date_of_entry');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('special_requirements')->nullable();
            $table->string('budget_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_requests');
    }
};
