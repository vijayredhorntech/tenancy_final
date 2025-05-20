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
        Schema::create('visaapplication_audit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('application_number')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('user_type'); // e.g., 'admin', 'agency', 'client'
            $table->string('audit_name'); // e.g., 'Document Uploaded', 'Status Changed'
            $table->text('description')->nullable(); // Optional: details about the action
            $table->date('audit_date')->nullable();   // 👈 Custom date
            $table->time('audit_time')->nullable();
            $table->timestamps();

            // Optional: Foreign keys (uncomment if needed)
            // $table->foreign('application_id')->references('id')->on('visa_bookings')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visaapplication_audit');
    }
};
