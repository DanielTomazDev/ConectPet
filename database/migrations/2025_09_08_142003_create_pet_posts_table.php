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
        Schema::create('pet_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->string('title')->nullable(); // Título do post
            $table->text('description')->nullable(); // Descrição do post
            $table->string('photo'); // Caminho da foto
            $table->integer('likes_count')->default(0); // Contador de curtidas
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->index(['pet_id', 'created_at']); // Índice para ordenação
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_posts');
    }
};
