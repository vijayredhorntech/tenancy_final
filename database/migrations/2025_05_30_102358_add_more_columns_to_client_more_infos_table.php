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
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('language_spoken')->nullable();
            $table->text('employment')->nullable();
            $table->text('education')->nullable();
            $table->text('social_media')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'language_spoken',
                'employment',
                'education',
                'social_media',
            ]);
        });
    }
};
