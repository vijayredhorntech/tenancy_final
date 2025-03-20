<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->string('supplier_name')->nullable()->after('amount'); // Adjust column placement if needed
        });
    }

    public function down()
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->dropColumn('supplier_name');
        });
    }
};
