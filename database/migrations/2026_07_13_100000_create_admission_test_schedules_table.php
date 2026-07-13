<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_test_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('exam_date');
            $table->string('times'); // e.g. "8 AM\n1 PM"
            $table->string('venue');
            $table->string('venue_note')->nullable();
            $table->string('address');
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'exam_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_test_schedules');
    }
};
