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
        Schema::table('client_application_documents', function (Blueprint $table) {
            $table->boolean('returnable')->default(false)->after('document_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_application_documents', function (Blueprint $table) {
            $table->dropColumn('returnable');
        });
    }
};
