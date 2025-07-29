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
            $table->renameColumn('position', 'rank');
        });
    }

    public function down()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->renameColumn('rank', 'position');
        });
    }
};
