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
    Schema::table('client_details', function (Blueprint $table) {
        $table->string('county')->nullable()->after('city');
    });

    Schema::table('authervisa_applications', function (Blueprint $table) {
        $table->string('county')->nullable()->after('city');
    });
}

public function down()
{
    Schema::table('client_details', function (Blueprint $table) {
        $table->dropColumn('county');
    });

    Schema::table('authervisa_applications', function (Blueprint $table) {
        $table->dropColumn('county');
    });
}

};
