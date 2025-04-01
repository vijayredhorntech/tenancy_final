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
        Schema::create('visa_subtypes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('visa_type_id'); // Foreign key for visa type
            $table->string('name'); // Name of the subtype
            $table->decimal('price', 10, 2); // Price with two decimal places
            $table->decimal('commission', 10, 2); // Commission with two decimal places
            $table->boolean('status')->default(1); // Active/Inactive status (1 = active, 0 = inactive)
            $table->timestamps();

            // Foreign Key Constraint (Assuming visa_types table exists)
            // $table->foreign('visa_type_id')->references('id')->on('visa_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_subtypes');
    }
};
