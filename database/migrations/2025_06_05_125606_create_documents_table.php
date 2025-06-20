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
        Schema::create('docsigndocuments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('document_type');
            $table->json('document_name');
            $table->json('termandcondition');
            $table->json('termstype');
            $table->json('terms_data');
            $table->json('document_file');
            
            // New columns
            $table->string('user_type'); // e.g., admin, employee, etc.
            $table->unsignedBigInteger('user_id'); // FK if you want
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docsigndocuments');
    }
};
