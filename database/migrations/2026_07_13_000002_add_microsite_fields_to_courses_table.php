<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->longText('curriculum')->nullable()->after('description');
            $table->longText('facilities_labs')->nullable()->after('curriculum');
            $table->longText('accreditation_info')->nullable()->after('facilities_labs');
            $table->longText('board_performance')->nullable()->after('accreditation_info');
            $table->longText('scholarships')->nullable()->after('board_performance');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'curriculum',
                'facilities_labs',
                'accreditation_info',
                'board_performance',
                'scholarships',
            ]);
        });
    }
};
