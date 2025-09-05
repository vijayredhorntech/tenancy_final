<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->string('custom_message')->nullable()->after('application_status');
        });
    }

    public function down(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->dropColumn('custom_message');
        });
    }
};


