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
          
            Schema::create('request_applications', function (Blueprint $table) {
                $table->id();
                $table->string('service_type');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->unsignedBigInteger('country_id');
                $table->unsignedBigInteger('visa_id');
                $table->unsignedBigInteger('visa_subtype');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('full_name');
                $table->string('email');
                $table->string('phone_number');
                $table->string('nationality');
                $table->string('zipcode')->nullable();
                $table->string('address');
                $table->string('city');
                $table->date('date_of_entry');
                $table->string('status')->default('pending');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_applications');
    }
};
