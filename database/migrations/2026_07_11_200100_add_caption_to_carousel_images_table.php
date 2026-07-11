<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('carousel_images', 'caption')) {
            Schema::table('carousel_images', function (Blueprint $table) {
                $table->string('caption')->nullable()->after('image_path');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('carousel_images', 'caption')) {
            Schema::table('carousel_images', function (Blueprint $table) {
                $table->dropColumn('caption');
            });
        }
    }
};
