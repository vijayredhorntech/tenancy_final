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
        Schema::create('client_more_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientid'); // Foreign key to clients table
            $table->string('last_name');
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('marital_status');
            $table->string('nationality');
            $table->date('passport_issue_date');
            $table->date('passport_expiry_date');
            $table->text('residential_address');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('spouse_name')->nullable();
            $table->integer('children_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_more_infos');
    }
};
