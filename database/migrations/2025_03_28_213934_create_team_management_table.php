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
        Schema::create('team_managements', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable(); // Manager is a user
            $table->timestamps();
       
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_managements');
    }
};
