<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('user_database')->create('client_document_selections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('booking_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('user_database')->dropIfExists('client_document_selections');
    }
};


