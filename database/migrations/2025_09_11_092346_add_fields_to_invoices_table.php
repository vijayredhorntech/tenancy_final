<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('new_invoice_number')->nullable();
            $table->string('status')->default('confirm');   // default value confirm
            $table->string('new_price')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['new_invoice_number', 'status', 'new_price', 'type']);
        });
    }
};
