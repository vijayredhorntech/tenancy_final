<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('user_database')->create('client_document_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_document_id');
            $table->string('action'); // received | returned
            $table->timestamp('action_at');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('client_document_id')
                ->references('id')
                ->on('client_documents')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection('user_database')->dropIfExists('client_document_movements');
    }
};
