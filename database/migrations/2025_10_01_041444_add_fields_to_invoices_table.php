<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('invoice_number')->after('invoice_date');
            $table->unsignedBigInteger('agency_id')->after('invoice_number');
            $table->unsignedBigInteger('client_id')->after('agency_id');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['invoice_number', 'agency_id', 'client_id']);
        });
    }
};
