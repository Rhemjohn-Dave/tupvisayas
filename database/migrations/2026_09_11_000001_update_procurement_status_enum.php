<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE procurements MODIFY COLUMN status ENUM('pending', 'ongoing', 'awarded', 'failed') NOT NULL DEFAULT 'pending'");
            DB::table('procurements')->where('status', 'pending')->update(['status' => 'ongoing']);
            DB::statement("ALTER TABLE procurements MODIFY COLUMN status ENUM('ongoing', 'awarded', 'failed') NOT NULL DEFAULT 'ongoing'");

            return;
        }

        // SQLite and other drivers: update values; enum constraints are not enforced the same way.
        DB::table('procurements')->where('status', 'pending')->update(['status' => 'ongoing']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE procurements MODIFY COLUMN status ENUM('pending', 'ongoing', 'awarded', 'failed') NOT NULL DEFAULT 'ongoing'");
            DB::table('procurements')->where('status', 'ongoing')->update(['status' => 'pending']);
            DB::table('procurements')->where('status', 'failed')->update(['status' => 'pending']);
            DB::statement("ALTER TABLE procurements MODIFY COLUMN status ENUM('pending', 'awarded') NOT NULL DEFAULT 'pending'");

            return;
        }

        DB::table('procurements')->whereIn('status', ['ongoing', 'failed'])->update(['status' => 'pending']);
    }
};
