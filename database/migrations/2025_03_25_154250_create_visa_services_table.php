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
        Schema::create('visa_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visa_id')->nullable()->index(); // Nullable visa_id
            $table->unsignedBigInteger('form_id'); // Required form_id
            $table->unsignedBigInteger('origin_id'); // Required origin_id
            $table->unsignedBigInteger('destination_id'); // Required destination_id
            $table->text('description')->nullable(); // Optional description
            $table->decimal('fee', 10, 2)->default(0.00); // Visa service fee
            $table->boolean('status')->default(true); // Active/Inactive status
            $table->timestamps(); // Created_at and Updated_at

            // Foreign Keys (If needed)
            $table->foreign('visa_id')->references('id')->on('visa_types')->onDelete('set null');
            $table->foreign('form_id')->references('id')->on('fromdocuments')->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_services');
    }
};
