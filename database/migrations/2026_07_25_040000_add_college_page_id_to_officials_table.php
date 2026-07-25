<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->foreignId('college_page_id')
                ->nullable()
                ->after('order')
                ->constrained('college_pages')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->dropConstrainedForeignId('college_page_id');
        });
    }
};
