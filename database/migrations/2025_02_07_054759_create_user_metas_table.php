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
        
        Schema::create('user_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('phone_number')->nullable(); // User's phone number
            $table->string('phone_code', 10)->nullable(); // Phone dialing code (e.g., +91, +1)
            $table->string('country_code', 10)->nullable(); // ISO Country Code (e.g., US, IN)
            $table->text('address')->nullable(); // Full address
            $table->string('state')->nullable(); // State
            $table->string('country')->nullable(); // Country
            $table->timestamps();
        });
        // Schema::create('user_metas', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_meta');
    }
};
