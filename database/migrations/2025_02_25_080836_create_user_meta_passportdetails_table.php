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
        Schema::create('user_meta_passportdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('passport_number')->unique();
            $table->string('place_of_issue')->nullable();
            $table->date('passport_expire_date')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('passport_front_side')->nullable();
            $table->string('passport_back_side')->nullable();
            $table->json('other_doc_details')->nullable(); // Stores multiple document details
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_meta_passportdetails');
    }
};
