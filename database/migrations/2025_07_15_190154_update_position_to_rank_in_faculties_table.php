<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->string('rank')->nullable();
        });

        // Copy data from position to rank
        DB::statement('UPDATE faculties SET rank = position');

        // Drop the old column
        Schema::table('faculties', function (Blueprint $table) {
            $table->dropColumn('position');
        });

        // Make rank not nullable if you want
        Schema::table('faculties', function (Blueprint $table) {
            $table->string('rank')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->string('position')->nullable();
        });

        DB::statement('UPDATE faculties SET position = rank');

        Schema::table('faculties', function (Blueprint $table) {
            $table->dropColumn('rank');
        });

        Schema::table('faculties', function (Blueprint $table) {
            $table->string('position')->nullable(false)->change();
        });
    }
};
