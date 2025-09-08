<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Rota de teste sem autenticação
Route::get('/teste-pets', function () {
    return '<h1 style="background: red; color: white; padding: 50px; text-align: center; font-size: 50px;">TESTE PETS FUNCIONANDO!</h1>';
});

// Rota de teste com autenticação
Route::get('/teste-auth', function () {
    if (auth()->check()) {
        return '<h1 style="background: green; color: white; padding: 50px; text-align: center; font-size: 50px;">USUÁRIO LOGADO: ' . auth()->user()->name . '</h1>';
    } else {
        return '<h1 style="background: red; color: white; padding: 50px; text-align: center; font-size: 50px;">USUÁRIO NÃO LOGADO!</h1>';
    }
})->middleware('auth');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $petsCount = $user->pets()->count();
    $totalPets = \App\Models\Pet::count();
    $totalUsers = \App\Models\User::count();
    $totalMatches = \App\Models\PetMatch::count();
    
    // Buscar todos os posts dos pets com usuários e pets
    $allPosts = \App\Models\PetPost::with(['pet.user'])->latest()->paginate(10);
    
    // Marcar quais pets o usuário já curtiu (para compatibilidade)
    $userLikedPets = \App\Models\PetLike::where('user_id', $user->id)->pluck('pet_id')->toArray();
    
    return view('dashboard', compact('petsCount', 'totalPets', 'totalUsers', 'totalMatches', 'allPosts', 'userLikedPets'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ROTAS DE USUÁRIO
Route::get('/users',[UserController::class, 'index'])->middleware(['auth'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth','isAdmin'])->name('users.create');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware(['auth','confirm_id'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['auth','isAdmin'])->name('users.update');
Route::post('/users', [UserController::class, 'store'])->middleware(['auth','isAdmin'])->name('users.store');
Route::delete('/users/{id}',[UserController::class, 'delete'])->middleware(['auth','isAdmin'])->name('users.delete');
Route::get('/users/{id}',[UserController::class,'show'])->middleware(['auth','isAdmin'])->name('users.show');

// ROTAS DE PETS
Route::middleware(['auth'])->group(function () {
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');
    Route::post('/pets/{pet}/like', [PetController::class, 'like'])->name('pets.like');
    Route::post('/pets/{pet}/comment', [PetController::class, 'comment'])->name('pets.comment');
    
    // Rotas para posts dos pets
    Route::get('/pets/{pet}/posts/create', [App\Http\Controllers\PetPostController::class, 'create'])->name('pet-posts.create');
    Route::post('/pets/{pet}/posts', [App\Http\Controllers\PetPostController::class, 'store'])->name('pet-posts.store');
    Route::get('/pets/{pet}/posts/{post}', [App\Http\Controllers\PetPostController::class, 'show'])->name('pet-posts.show');
    Route::get('/pets/{pet}/posts/{post}/edit', [App\Http\Controllers\PetPostController::class, 'edit'])->name('pet-posts.edit');
    Route::put('/pets/{pet}/posts/{post}', [App\Http\Controllers\PetPostController::class, 'update'])->name('pet-posts.update');
    Route::delete('/pets/{pet}/posts/{post}', [App\Http\Controllers\PetPostController::class, 'destroy'])->name('pet-posts.destroy');
});