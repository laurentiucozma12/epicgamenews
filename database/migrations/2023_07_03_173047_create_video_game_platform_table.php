<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_game_platform', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('video_game_id');
            $table->foreign('video_game_id')->references('id')->on('video_games')->onDelete('cascade');

            $table->unsignedBigInteger('platform_id'); 
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_game_platform');
    }
};