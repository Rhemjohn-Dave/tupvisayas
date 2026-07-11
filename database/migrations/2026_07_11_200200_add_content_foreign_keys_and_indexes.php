<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $tables = ['news', 'announcements', 'events', 'jobs'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'category_id')) {
                continue;
            }

            $validIds = DB::table('categories')->pluck('id');

            $orphanQuery = DB::table($table)->whereNotNull('category_id');
            if ($validIds->isNotEmpty()) {
                $orphanQuery->whereNotIn('category_id', $validIds);
            }

            $orphanQuery->update(['category_id' => null]);

            $this->ensureForeignKey($table);
            $this->ensureIndex($table, "{$table}_category_id_created_at_index", ['category_id', 'created_at']);
            $this->ensureIndex($table, "{$table}_created_at_index", ['created_at']);
        }

        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default(false)->after('password');
            });
        }

        if (Schema::hasTable('officials')) {
            $this->ensureIndex('officials', 'officials_order_index', ['order']);
        }

        if (Schema::hasTable('carousel_images')) {
            $this->ensureIndex('carousel_images', 'carousel_images_order_index', ['order']);
        }
    }

    public function down(): void
    {
        $tables = ['news', 'announcements', 'events', 'jobs'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                try {
                    $blueprint->dropForeign([$table === 'news' ? 'category_id' : 'category_id']);
                } catch (\Throwable $e) {
                    // ignore if FK name differs
                }

                try {
                    $blueprint->dropIndex("{$table}_category_id_created_at_index");
                } catch (\Throwable $e) {
                }

                try {
                    $blueprint->dropIndex("{$table}_created_at_index");
                } catch (\Throwable $e) {
                }
            });
        }
    }

    private function ensureForeignKey(string $table): void
    {
        $database = Schema::getConnection()->getDatabaseName();
        $fkName = "{$table}_category_id_foreign";

        $exists = DB::table('information_schema.table_constraints')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('constraint_name', $fkName)
            ->where('constraint_type', 'FOREIGN KEY')
            ->exists();

        if ($exists) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) {
            $blueprint->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
        });
    }

    private function ensureIndex(string $table, string $indexName, array $columns): void
    {
        $database = Schema::getConnection()->getDatabaseName();

        $exists = DB::table('information_schema.statistics')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('index_name', $indexName)
            ->exists();

        if ($exists) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) use ($columns, $indexName) {
            $blueprint->index($columns, $indexName);
        });
    }
};
