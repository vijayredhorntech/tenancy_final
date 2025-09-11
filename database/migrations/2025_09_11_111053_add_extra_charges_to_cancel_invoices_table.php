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
         Schema::table('cancel_invoices', function (Blueprint $table) {
            $table->decimal('safi', 10, 2)->default(0)->after('amount');
            $table->decimal('atol', 10, 2)->default(0)->after('safi');
            $table->decimal('credit_charge', 10, 2)->default(0)->after('atol');
            $table->decimal('penalty', 10, 2)->default(0)->after('credit_charge');
            $table->decimal('admin', 10, 2)->default(0)->after('penalty');
            $table->decimal('misc', 10, 2)->default(0)->after('admin');
            $table->decimal('total_amount', 10, 2)->default(0)->after('misc');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cancel_invoices', function (Blueprint $table) {
            $table->dropColumn(['safi', 'atol', 'credit_charge', 'penalty', 'admin', 'misc', 'total_amount']);
        });
    }
};
