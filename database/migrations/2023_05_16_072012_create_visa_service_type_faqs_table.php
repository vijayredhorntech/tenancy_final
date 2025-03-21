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
        Schema::create('visa_service_type_faqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visa_service_type_id')->unsigned();
            $table->foreign('visa_service_type_id')->references('id')->on('visa_types');
            $table->string('question');
            $table->longText('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_service_type_faqs');
    }
};
