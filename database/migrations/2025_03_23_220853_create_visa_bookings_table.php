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
        Schema::create('visabookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('visa_id');
            $table->unsignedBigInteger('subtype_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->string('application_number')->unique();
            $table->string('document_status')->default('Pending');
            $table->string('applicationworkin_status')->default('Pending');
            $table->string('application_status')->default('Submitted');
            $table->boolean('status')->default(true);
            $table->string('payment_status')->default('Pending');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->date('dateofentry')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('visa_id')->references('id')->on('visa_types')->onDelete('cascade');
            $table->foreign('subtype_id')->references('id')->on('visa_subtypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_bookings');
    }
};
