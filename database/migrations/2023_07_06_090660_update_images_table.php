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
        Schema::table('images', function (Blueprint $table) {            
            // Added default value
            $table->string('name')->default('thumbnail_placeholder.jpg')->change();
            $table->string('extension')->default('jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            // Remove default values and revert attribute modifications
            $table->string('name')->change();
            $table->string('extension')->change();
        });
    }
};
