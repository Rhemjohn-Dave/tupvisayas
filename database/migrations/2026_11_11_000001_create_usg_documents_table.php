<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usg_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('reference_no')->nullable();
            $table->string('category');
            $table->date('issued_at')->nullable();
            $table->text('summary')->nullable();
            $table->string('file_path');
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index(['category', 'is_published']);
            $table->index('issued_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usg_documents');
    }
};
