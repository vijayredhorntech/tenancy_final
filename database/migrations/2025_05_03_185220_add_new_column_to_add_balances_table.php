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
            $table->string('receiptcopy')->nullable()->after('added_date'); // add after 'added_date'
            $table->string('reason')->nullable()->after('receiptcopy');     // add after 'receiptcopy'
            $table->tinyInteger('paymentstatus')->default(1)->after('reason');
        });
   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_balances', function (Blueprint $table) {
            $table->dropColumn(['receiptcopy', 'reason','paymentstatus']);
        });
    }
};
