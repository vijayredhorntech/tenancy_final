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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();  
            $table->string('name');  
            $table->string('email')->unique();  
            $table->string('phone');  
            $table->text('address');  
            $table->string('contact_person');  
            $table->string('contact_phone');  
            $table->string('country');  
            $table->string('database_name');  
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->text('profile_description')->nullable(); 
            $table->string('profile_picture')->nullable();   
            $table->timestamps();  
        });
        // Schema::create('agencies', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
