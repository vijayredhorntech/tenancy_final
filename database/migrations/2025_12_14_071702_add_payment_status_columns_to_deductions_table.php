<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->string('agency_pay')->default('pending')->after('invoicestatus');
            $table->string('superadmin_pay')->default('pending')->after('agency_pay');
        });
    }

    public function down(): void
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->dropColumn(['agency_pay', 'superadmin_pay']);
        });
    }
};
