<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->string('passport_type')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn('passport_type');
        });
    }
};
