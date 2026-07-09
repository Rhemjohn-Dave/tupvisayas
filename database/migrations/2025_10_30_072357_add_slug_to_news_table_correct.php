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
        if (!Schema::hasColumn('news', 'slug')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Generate slugs for existing records
        $news = DB::table('news')->get();
        foreach ($news as $item) {
            $slug = \Illuminate\Support\Str::slug($item->title);
            $counter = 1;
            $originalSlug = $slug;

            // Make slug unique
            while (DB::table('news')->where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            DB::table('news')->where('id', $item->id)->update(['slug' => $slug]);
        }

        // Now add unique constraint if it doesn't exist
        if (Schema::hasColumn('news', 'slug')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->change();
                $table->unique('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            if (Schema::hasColumn('news', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
