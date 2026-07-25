<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('college_pages', function (Blueprint $table) {
            $table->longText('board_exam_ratings')->nullable()->after('history');
        });
    }

    public function down(): void
    {
        Schema::table('college_pages', function (Blueprint $table) {
            $table->dropColumn('board_exam_ratings');
        });
    }
};
