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
        Schema::table('docsigndocuments', function (Blueprint $table) {
            $table->unsignedBigInteger('servicerelatedtableid')->nullable()->after('related_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docsigndocuments', function (Blueprint $table) {
            $table->dropColumn('servicerelatedtableid');
        });
    }
};
