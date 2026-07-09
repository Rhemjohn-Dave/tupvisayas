<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
        });

        // Backfill links for existing data where names match within the same college
        // Using a raw SQL update for efficiency and case/trim-insensitive matching
        // This assumes MySQL or compatible SQL. Adjust if needed for other drivers.
        try {
            DB::statement("UPDATE departments d JOIN courses c ON c.college_page_id = d.college_page_id AND LOWER(TRIM(c.name)) = LOWER(TRIM(d.name)) SET d.course_id = c.id WHERE d.course_id IS NULL");
        } catch (\Throwable $e) {
            // Best-effort backfill; ignore if driver doesn't support this exact syntax
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
};


