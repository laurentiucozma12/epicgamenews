<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Added nullable()->change()
            $table->string('title')->nullable()->change();
            $table->string('excerpt')->nullable()->change();
            $table->text('body')->nullable()->change();

            // Drop column
            $table->dropColumn('scraped_slug');
        });
    }
    
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add back the dropped column
            $table->string('scraped_slug')->nullable();
    
            // Revert the changes made in the up() method
            $table->string('title')->nullable(false)->change();
            $table->string('excerpt')->nullable(false)->change();
            $table->text('body')->nullable(false)->change();
        });
    }
};
