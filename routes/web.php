<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController; // Añade esta línea
use App\Http\Controllers\Admin\CategoryController; // Añade esta línea
use App\Http\Controllers\HomeController; // Añade esta línea
use Illuminate\Support\Facades\Route;

// 1. Ruta pública (Donde se verán las Cards de Bootstrap)
Route::get('/', [HomeController::class , 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 2. Rutas del Panel Administrativo (CRUD)
// Las protegemos con 'auth' para que solo usuarios logueados entren
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

// Rutas de Perfil (Ya las tenías)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
