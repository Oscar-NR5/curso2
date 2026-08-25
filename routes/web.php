<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
       $posts = Post::publicados()->with('categoria')->latest()->get();

       return view('portada', ['posts' => $posts]);
   })->name('inicio');

Route::get('/contacto', fn () => view('contacto'))->name('contacto');
Route::post('/contacto', function () {
    return redirect()->route('inicio')->with('mensaje', 'Tu mensaje fue enviado correctamente.');
})->name('contacto.enviar');
