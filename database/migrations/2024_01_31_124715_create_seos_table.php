<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosTable extends Migration
{
public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('page_type')->nullable();
            $table->string('page_name')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('keywords');
            $table->foreignId('user_id')->default(1);
            $table->foreignId('video_game_id')->nullable();
            $table->foreignId('platform_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seos');
    }
}
