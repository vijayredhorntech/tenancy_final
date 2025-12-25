<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_edit')->default(false)->after('status');
            $table->timestamp('edited_at')->nullable()->after('is_edit');
            $table->foreignId('updated_user_id')->nullable()->after('edited_at')->constrained('users')->nullOnDelete();

            $table->boolean('is_delete')->default(false)->after('updated_user_id');
            $table->timestamp('deleted_at_manual')->nullable()->after('is_delete');
            $table->foreignId('deleted_user_id')->nullable()->after('deleted_at_manual')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['updated_user_id']);
            $table->dropForeign(['deleted_user_id']);
            $table->dropColumn([
                'is_edit',
                'edited_at',
                'updated_user_id',
                'is_delete',
                'deleted_at_manual',
                'deleted_user_id',
            ]);
        });
    }
};
