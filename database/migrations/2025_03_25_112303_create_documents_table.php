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
        Schema::create('fromdocuments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('form_name'); // Form Name
            $table->text('form_description')->nullable(); // Form Description
            $table->longText('form_html')->nullable(); // Form HTML
            $table->string('document'); // Document file name or path
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fromdocuments');
    }
};
