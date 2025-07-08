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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Core details
            $table->string('receiver_name');
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->string('different_name')->nullable();
            


        
            $table->text('address')->nullable();
            $table->string('bookingid')->nullable();
            $table->string('visa_applicant')->nullable();

            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('billing_id')->nullable();
            $table->unsignedBigInteger('applicant_id')->nullable();

            // Money
            $table->string('amount')->nullable();
            $table->decimal('discount', 10, 2)->default(0);

            // Payment type (restrict to your accepted methods)
            $table->string('payment_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
