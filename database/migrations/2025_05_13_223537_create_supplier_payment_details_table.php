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
        Schema::create('supplier_paymentdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('payment_type')->nullable(); // e.g., cash, bank, etc.
            $table->date('payment_date')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->decimal('paying_amount', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            // Add these lines:
            $table->string('receipt')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_payment_details');
    }
};
