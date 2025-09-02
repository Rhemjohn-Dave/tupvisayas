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
            $table->enum('status', ['pending', 'awarded'])->default('pending')->after('type')->index();
            $table->string('po_file_url')->nullable()->after('status');
            $table->json('po_files')->nullable()->after('po_file_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropColumn(['status', 'po_file_url', 'po_files']);
        });
    }
};


