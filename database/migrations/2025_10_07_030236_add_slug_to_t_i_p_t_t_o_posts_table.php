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
        Schema::table('t_i_p_t_t_o_posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Populate slugs for existing posts
        $posts = \App\Models\TIPTTOPost::whereNull('slug')->get();
        foreach ($posts as $post) {
            $post->slug = \Illuminate\Support\Str::slug($post->title) . '-' . $post->id;
            $post->save();
        }

        // Now make slug unique and not nullable
        Schema::table('t_i_p_t_t_o_posts', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_i_p_t_t_o_posts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
