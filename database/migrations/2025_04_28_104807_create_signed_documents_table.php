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
        Schema::create('signed_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->string('title');
            $table->string('path');
            $table->text('description')->nullable();
            $table->string('mimetype');
            $table->bigInteger('size');
            $table->boolean('is_active')->default(true);
            $table->integer('current_version')->default(1);
            $table->timestamps();
            $table->softDeletes();
    
            // If you want to link to another table like 'agencies', uncomment this:
            // $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signed_documents');
    }
};
