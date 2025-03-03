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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); // Nullable description
            $table->unsignedBigInteger('assigned_by'); // Admin/Manager assigning task
            $table->date('assign_date');
            $table->date('due_date');
            $table->time('assign_time')->nullable();
            $table->time('close_time')->nullable();
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled'])->default('pending');
            $table->json('images')->nullable(); // Profile field
            $table->timestamps();

            // Foreign key constraint (assuming users table exists)
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
