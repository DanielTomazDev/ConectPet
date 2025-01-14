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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relacionamento com usuários
            $table->string('name'); // Nome do pet
            $table->integer('age'); // Idade do pet
            $table->string('breed')->nullable(); // Raça (opcional)
            $table->enum('type', ['dog', 'cat', 'other']); // Tipo de pet
            $table->enum('gender', ['male', 'female']); // Gênero
            $table->string('profile_picture')->nullable(); // URL da foto do pet
            $table->text('bio')->nullable(); // Breve descrição
            $table->timestamps(); // created_at e updated_at

            // Chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
