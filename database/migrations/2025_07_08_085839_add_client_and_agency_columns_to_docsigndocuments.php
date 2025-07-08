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

            // ① client  
            $table->unsignedBigInteger('client_id')->nullable()->after('user_id');

            // ② agency  
            $table->unsignedBigInteger('agency_id')->nullable()->after('client_id');

            // ③ related record (rename if you meant something else)  
            $table->unsignedBigInteger('related_id')->nullable()->after('agency_id');

            // ④ document type (free text or enum)  
            $table->string('type_of_document')->nullable()->after('related_id');

            /* — optional foreign‑keys —
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreign('agency_id')->references('id')->on('agencies')->cascadeOnDelete();
            $table->foreign('related_id')->references('id')->on('some_table')->nullOnDelete();
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docsigndocuments', function (Blueprint $table) {
            $table->dropColumn(['client_id', 'agency_id', 'related_id', 'type_of_document']);
        });
    }
};
