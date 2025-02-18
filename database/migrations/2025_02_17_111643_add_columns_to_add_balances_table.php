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
        Schema::table('add_balances', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0);
            $table->string('payment_number')->nullable();
            $table->string('invoice_number')->nullable(false);
            $table->text('remark')->nullable();

            // Ensuring other fields are nullable when invoice_number is null
            $table->foreignId('related_id')->nullable(); // Example of another nullable field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_balances', function (Blueprint $table) {
            $table->dropColumn(['status', 'payment_number', 'invoice_number', 'remark']);
        });
    }
};
