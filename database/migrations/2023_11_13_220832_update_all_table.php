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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->boolean('deleted')->default(0);
        });      

        Schema::table('video_games', function (Blueprint $table) {
            $table->boolean('deleted')->default(0);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('deleted')->default(0);
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->boolean('deleted')->default(0);
        });

        Schema::table('others', function (Blueprint $table) {
            $table->boolean('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
        
        Schema::table('video_games', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('others', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
        
    }
};
