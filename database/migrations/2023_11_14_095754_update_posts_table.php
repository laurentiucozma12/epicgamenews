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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('approved');
            // posts should be set on deleted default, because when a post is created, it should not be approved until an admin sees it.
            $table->boolean('deleted')->default(1);     
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
