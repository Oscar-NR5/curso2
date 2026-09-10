<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/token', [TokenController::class, 'crear'])
    ->middleware('throttle:6,1');

Route::get('/avisos', [PostController::class, 'index']);
Route::get('/avisos/{post}', [PostController::class, 'show']);
Route::get('/resumen', [PostController::class, 'resumen']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/yo', function (Request $request) {
        return [
            'id' => $request->user()->id,
            'nombre' => $request->user()->name,
            'rol' => $request->user()->rol,
        ];
    });

    Route::post('/avisos', [PostController::class, 'store']);
    Route::put('/avisos/{post}', [PostController::class, 'update']);
    Route::delete('/avisos/{post}', [PostController::class, 'destroy']);
    Route::post('/token/revocar', [TokenController::class, 'revocar']);
});
