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
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable()->after('status');
            $table->string('sender_user_type')->nullable()->after('agency_id');
            $table->string('uploaded_file')->nullable()->after('sender_user_type');
            $table->unsignedBigInteger('main_userid')->nullable()->after('uploaded_file');
            $table->unsignedBigInteger('client_id')->nullable()->after('main_userid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['agency_id','sender_user_type', 'uploaded_file', 'main_userid', 'client_id']);
        });
    }
};
