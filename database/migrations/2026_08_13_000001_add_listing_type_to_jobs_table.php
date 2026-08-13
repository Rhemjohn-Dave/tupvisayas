<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (! Schema::hasColumn('jobs', 'listing_type')) {
                $table->string('listing_type', 32)
                    ->default('job_opening')
                    ->after('category_id')
                    ->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (Schema::hasColumn('jobs', 'listing_type')) {
                $table->dropIndex(['listing_type']);
                $table->dropColumn('listing_type');
            }
        });
    }
};
