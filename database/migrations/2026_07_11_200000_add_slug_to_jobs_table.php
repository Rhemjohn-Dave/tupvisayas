<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('jobs', 'slug')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        $jobs = DB::table('jobs')->select('id', 'title', 'slug')->get();
        foreach ($jobs as $job) {
            if (! empty($job->slug)) {
                continue;
            }

            $base = Str::slug(strip_tags((string) $job->title)) ?: ('job-' . $job->id);
            $slug = $base;
            $counter = 1;

            while (
                DB::table('jobs')
                    ->where('slug', $slug)
                    ->where('id', '!=', $job->id)
                    ->exists()
            ) {
                $slug = $base . '-' . $counter++;
            }

            DB::table('jobs')->where('id', $job->id)->update(['slug' => $slug]);
        }

        $this->ensureUniqueIndex('jobs', 'jobs_slug_unique', 'slug');
    }

    public function down(): void
    {
        if (! Schema::hasColumn('jobs', 'slug')) {
            return;
        }

        Schema::table('jobs', function (Blueprint $table) {
            try {
                $table->dropUnique(['slug']);
            } catch (\Throwable $e) {
                // index may not exist
            }
            $table->dropColumn('slug');
        });
    }

    private function ensureUniqueIndex(string $table, string $indexName, string $column): void
    {
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();

        $exists = DB::table('information_schema.statistics')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('index_name', $indexName)
            ->exists();

        if (! $exists) {
            Schema::table($table, function (Blueprint $blueprint) use ($column) {
                $blueprint->unique($column);
            });
        }
    }
};
