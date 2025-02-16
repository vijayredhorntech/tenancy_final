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


        Schema::create('domains', function (Blueprint $table) {
            $table->id();  
            $table->string('domain_name')->unique();  
            $table->unsignedBigInteger('agency_id'); 
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');  
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active'); 
            $table->string('full_url')->nullable(); 
            $table->timestamps();  
        });
        // Schema::create('domains', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
