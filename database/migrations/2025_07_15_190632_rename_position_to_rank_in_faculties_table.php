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
        // Use CHANGE to rename and keep the type
        DB::statement('ALTER TABLE faculties CHANGE position rank VARCHAR(255)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE faculties CHANGE rank position VARCHAR(255)');
    }
};
