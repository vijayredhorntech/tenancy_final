<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Removed Schema::connection('user_database')
        Schema::create('client_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('client_id');
            $table->string('document_name');
            $table->timestamp('received_on');
            $table->text('remarks')->nullable();
            $table->timestamp('returned_on')->nullable();
            $table->text('return_remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_documents');
    }
};
