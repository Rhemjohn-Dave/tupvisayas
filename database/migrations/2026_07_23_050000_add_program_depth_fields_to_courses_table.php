<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->longText('career_opportunities')->nullable()->after('description');
            $table->longText('program_objectives')->nullable()->after('career_opportunities');
            $table->longText('program_outcomes')->nullable()->after('program_objectives');
            $table->longText('faq')->nullable()->after('scholarships');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'career_opportunities',
                'program_objectives',
                'program_outcomes',
                'faq',
            ]);
        });
    }
};
