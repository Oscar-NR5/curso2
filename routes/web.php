<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [PostController::class, 'index'])->name('avisos.index');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/avisos/crear', [PostController::class, 'create'])->name('avisos.create');
    Route::post('/avisos', [PostController::class, 'store'])->name('avisos.store');
    Route::get('/avisos/{post}/editar', [PostController::class, 'edit'])->name('avisos.edit');
    Route::put('/avisos/{post}', [PostController::class, 'update'])->name('avisos.update');
    Route::delete('/avisos/{post}', [PostController::class, 'destroy'])->name('avisos.destroy');
});

Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.enviar');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'mostrar'])->name('login');
Route::post('/login', [AuthController::class, 'entrar'])->name('login.entrar');
Route::post('/logout', [AuthController::class, 'salir'])->name('logout');
