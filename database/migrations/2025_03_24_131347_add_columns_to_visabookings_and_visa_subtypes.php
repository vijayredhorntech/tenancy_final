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
        Schema::table('visabookings', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable()->after('subtype_id'); // Add agency_id column
        });

        Schema::table('visa_subtypes', function (Blueprint $table) {
            $table->decimal('govt_tax', 10, 2)->nullable()->after('commission'); // Add govt_tax column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('visabookings', function (Blueprint $table) {
                $table->dropColumn('agency_id');
            });

            Schema::table('visa_subtypes', function (Blueprint $table) {
                $table->dropColumn('govt_tax');
            });
    }
};
