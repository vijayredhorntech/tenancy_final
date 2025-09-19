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
        Schema::create('invoice_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_invoice_id'); // Reference to deductions table
            $table->unsignedBigInteger('selected_application_id')->nullable(); // Reference to visa_bookings table
            $table->unsignedBigInteger('agency_id'); // Reference to agencies table
            $table->string('adjustment_number')->unique(); // Unique adjustment reference number
            $table->string('original_invoice_number'); // Original invoice number
            $table->decimal('original_amount', 10, 2); // Original invoice amount
            $table->decimal('adjusted_amount', 10, 2)->default(0); // Amount after adjustment
            $table->string('selected_application_number')->nullable(); // Application number that was selected
            $table->string('selected_client_name')->nullable(); // Client name from selected application
            $table->decimal('selected_application_amount', 10, 2)->nullable(); // Amount of selected application
            $table->string('processed_by')->nullable(); // Staff member who processed
            $table->text('internal_notes')->nullable(); // Internal notes
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->enum('adjustment_type', ['application_adjustment', 'manual_adjustment'])->default('application_adjustment');
            $table->unsignedBigInteger('processed_by_user_id')->nullable(); // User ID who processed
            $table->timestamp('adjustment_date')->useCurrent(); // When adjustment was made
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('original_invoice_id')->references('id')->on('deductions')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('processed_by_user_id')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for better performance
            $table->index(['agency_id', 'status']);
            $table->index(['original_invoice_id']);
            $table->index(['adjustment_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_adjustments');
    }
};
