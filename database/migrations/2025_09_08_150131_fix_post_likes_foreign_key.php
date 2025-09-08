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
        Schema::table('post_likes', function (Blueprint $table) {
            // Remove a foreign key constraint existente
            $table->dropForeign(['post_id']);
            
            // Adiciona a nova foreign key constraint para pet_posts
            $table->foreign('post_id')->references('id')->on('pet_posts')->onDelete('cascade');
        });
        
        Schema::table('post_comments', function (Blueprint $table) {
            // Remove a foreign key constraint existente
            $table->dropForeign(['post_id']);
            
            // Adiciona a nova foreign key constraint para pet_posts
            $table->foreign('post_id')->references('id')->on('pet_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
        
        Schema::table('post_comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
