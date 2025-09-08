<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetPostController extends Controller
{
    /**
     * Show the form for creating a new post for a pet.
     */
    public function create(Pet $pet)
    {
        // Verificar se o usuário é dono do pet
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para criar posts para este pet.');
        }

        return view('pet-posts.create', compact('pet'));
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request, Pet $pet)
    {
        // Verificar se o usuário é dono do pet
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para criar posts para este pet.');
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Upload da foto
        $path = $request->file('photo')->store('pet-posts', 'public');

        // Criar o post
        $post = $pet->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $path,
        ]);

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Post criado com sucesso!');
    }

    /**
     * Display the specified post.
     */
    public function show(Pet $pet, PetPost $post)
    {
        // Verificar se o post pertence ao pet
        if ($post->pet_id !== $pet->id) {
            abort(404);
        }

        return view('pet-posts.show', compact('pet', 'post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Pet $pet, PetPost $post)
    {
        // Verificar se o usuário é dono do pet
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este post.');
        }

        // Verificar se o post pertence ao pet
        if ($post->pet_id !== $pet->id) {
            abort(404);
        }

        return view('pet-posts.edit', compact('pet', 'post'));
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Pet $pet, PetPost $post)
    {
        // Verificar se o usuário é dono do pet
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este post.');
        }

        // Verificar se o post pertence ao pet
        if ($post->pet_id !== $pet->id) {
            abort(404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Atualizar dados
        $post->title = $request->title;
        $post->description = $request->description;

        // Upload de nova foto se fornecida
        if ($request->hasFile('photo')) {
            // Deletar foto antiga
            if ($post->photo) {
                Storage::disk('public')->delete($post->photo);
            }
            
            // Upload nova foto
            $path = $request->file('photo')->store('pet-posts', 'public');
            $post->photo = $path;
        }

        $post->save();

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Post atualizado com sucesso!');
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Pet $pet, PetPost $post)
    {
        // Verificar se o usuário é dono do pet
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir este post.');
        }

        // Verificar se o post pertence ao pet
        if ($post->pet_id !== $pet->id) {
            abort(404);
        }

        // Deletar foto do storage
        if ($post->photo) {
            Storage::disk('public')->delete($post->photo);
        }

        $post->delete();

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Post excluído com sucesso!');
    }
}