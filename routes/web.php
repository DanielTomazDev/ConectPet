<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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
