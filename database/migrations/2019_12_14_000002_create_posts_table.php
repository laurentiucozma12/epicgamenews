<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('scraped_slug')->unique()->nullable();
            $table->string('excerpt');
            $table->string('author_thumbnail')->nullable();
            $table->text('body');

            $table->foreignId('user_id')->default(1);
            $table->foreignId('video_game_id')->nullable();
            $table->boolean('deleted')->default(1);

            $table->integer('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
