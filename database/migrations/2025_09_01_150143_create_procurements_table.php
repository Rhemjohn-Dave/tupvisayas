<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('reference_no')->index();
            $table->string('category')->index();
            $table->date('posting_date')->index();
            $table->date('closing_date')->nullable()->index();
            $table->string('file_url');
            $table->enum('type', ['bid_opportunity', 'philgeps_posting'])->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurements');
    }
};
