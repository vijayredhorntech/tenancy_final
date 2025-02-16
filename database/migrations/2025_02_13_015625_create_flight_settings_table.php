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
        Schema::create('flight_settings', function (Blueprint $table) {
            $table->id();
            $table->string('markupType');
            $table->string('markupValue');
            $table->string('fareType');
            $table->enum('type',['default','custom'])->default('custom');
            $table->dateTime('validFrom')->nullable();
            $table->dateTime('validTill')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_settings');
    }
};
