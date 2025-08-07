<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNameToVisaapplicationLogsTable extends Migration
{
    public function up()
    {
        Schema::table('visaapplication_logs', function (Blueprint $table) {
            $table->string('field_name')->nullable(); // Make 'field_name' nullable
        });
    }

    public function down()
    {
        Schema::table('visaapplication_logs', function (Blueprint $table) {
            $table->dropColumn('field_name'); // Drop the 'field_name' column
        });
    }
}
