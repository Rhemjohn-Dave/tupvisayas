<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('procurements', function (Blueprint $table) {
            if (!Schema::hasColumn('procurements', 'po_files')) {
                $table->json('po_files')->nullable()->after('po_file_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procurements', function (Blueprint $table) {
            if (Schema::hasColumn('procurements', 'po_files')) {
                $table->dropColumn('po_files');
            }
        });
    }
};


