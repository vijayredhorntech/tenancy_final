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
        Schema::create('visa_service_country', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title_image')->nullable(); // Image field (optional)
            $table->unsignedBigInteger('origin'); // Foreign key for country
            $table->unsignedBigInteger('destination'); // Foreign key for country
            $table->unsignedBigInteger('visa_id'); // Foreign key for visa_type
            $table->text('description')->nullable(); // Description (optional)
            $table->boolean('required')->default(0); // Tenenty column (0 or 1)
            $table->timestamps(); // Created at & Updated at

            // Foreign key constraints
            $table->foreign('origin')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('destination')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('visa_id')->references('id')->on('visa_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('visa_service_country');
    }
};
