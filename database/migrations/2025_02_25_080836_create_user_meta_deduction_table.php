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
        Schema::create('user_meta_deduction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('taxslab', 10, 2)->nullable();
            $table->decimal('accommodation', 10, 2)->nullable();
            $table->decimal('cab', 10, 2)->nullable();
            $table->decimal('food', 10, 2)->nullable();
            $table->json('other')->nullable(); // Stores multiple values as JSON
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_meta_deduction');
    }
};
