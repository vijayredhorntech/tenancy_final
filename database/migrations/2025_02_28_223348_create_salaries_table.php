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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Link salary to user
            $table->date('start_date'); // Salary period start date
            $table->date('end_date'); // Salary period end date
            $table->decimal('total_earning', 10, 2); // Total earnings before deductions
            $table->decimal('total_deduction', 10, 2)->default(0.00); // Total deductions (loans, advances, etc.)
            $table->decimal('total_tax', 10, 2)->default(0.00); // Tax deducted
            $table->decimal('net_salary', 10, 2); // Final salary after all deductions
            $table->integer('count_of_days'); // Number of working days
            $table->string('status')->default('pending'); // pending, paid, etc.
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
