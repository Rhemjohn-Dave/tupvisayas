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
        // Check if slug column already exists
        if (!Schema::hasColumn('jobs', 'slug')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Generate slugs for existing records
        $jobs = DB::table('jobs')->get();
        foreach ($jobs as $item) {
            $slug = \Illuminate\Support\Str::slug($item->title);
            $counter = 1;
            $originalSlug = $slug;
            
            // Make slug unique
            while (DB::table('jobs')->where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            DB::table('jobs')->where('id', $item->id)->update(['slug' => $slug]);
        }

        // Now add unique constraint if it doesn't exist
        if (!Schema::hasColumn('jobs', 'slug')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->change();
                $table->unique('slug');
            });
        } else {
            // Just add unique constraint to existing column
            Schema::table('jobs', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            if (Schema::hasColumn('jobs', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
