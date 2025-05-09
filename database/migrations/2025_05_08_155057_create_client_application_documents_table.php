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
        Schema::create('client_application_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('application_id')->nullable();
            $table->string('application_number')->nullable();
            $table->string('document_name')->nullable(); // Renamed field
            $table->string('document_file')->nullable();
            $table->tinyInteger('document_status')->default(0); // tinyint with default 0
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_application_documents');
    }
};
