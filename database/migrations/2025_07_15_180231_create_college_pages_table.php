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
        Schema::create('college_pages', function (Blueprint $table) {
            $table->id();
            $table->string('college')->unique();
            $table->string('cover_photo')->nullable();
            $table->text('history')->nullable();
            $table->text('department_faculty')->nullable();
            $table->text('student_organization')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_pages');
    }
};
