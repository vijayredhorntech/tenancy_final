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
    Schema::table('client_more_infos', function (Blueprint $table) {
        $table->string('citizenship_national_id_no')->nullable()->after('language_spoken');
    });
}

public function down()
{
    Schema::table('client_more_infos', function (Blueprint $table) {
        $table->dropColumn('citizenship_national_id_no');
    });
}
};
