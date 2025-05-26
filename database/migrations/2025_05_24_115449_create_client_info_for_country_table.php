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
        Schema::create('client_info_for_country', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->text('name_of_field')->nullable(); // Nullable string field
            $table->unsignedBigInteger('visa_id')->nullable(); // Nullable foreign key
            $table->unsignedBigInteger('assignid')->nullable(); // Nullable foreign key
            $table->unsignedBigInteger('destination_id')->nullable();  // Reference to origin (could be country/client/etc.)
            $table->timestamps();
    
            // If you have visa and origin tables:
            // $table->foreign('visa_id')->references('id')->on('visas')->onDelete('cascade');
            // $table->foreign('origin_id')->references('id')->on('origins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_info_for_country');
    }
};
