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
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('visa_fee', 10, 2)->default(0.00)->after('payment_type');
            $table->decimal('service_charge', 10, 2)->default(0.00)->after('visa_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('visa_fee');
            $table->dropColumn('service_charge');
        });
    }
};
