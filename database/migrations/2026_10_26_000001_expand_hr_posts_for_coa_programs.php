<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hr_posts', function (Blueprint $table) {
            $table->string('report_file')->nullable()->after('featured_image');
        });

        // Expand enum for COA Sec. 13 program types (MySQL).
        DB::statement("ALTER TABLE hr_posts MODIFY COLUMN type ENUM('announcement', 'seminar', 'conference', 'training', 'oath_taking') NOT NULL DEFAULT 'announcement'");
    }

    public function down(): void
    {
        DB::table('hr_posts')
            ->whereIn('type', ['conference', 'training', 'oath_taking'])
            ->update(['type' => 'seminar']);

        DB::statement("ALTER TABLE hr_posts MODIFY COLUMN type ENUM('announcement', 'seminar') NOT NULL DEFAULT 'announcement'");

        Schema::table('hr_posts', function (Blueprint $table) {
            $table->dropColumn('report_file');
        });
    }
};
