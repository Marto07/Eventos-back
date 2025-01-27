<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::prefix('api')->group(function () {
    
//     Route::get('/usuario',         [UsuarioController::class, 'index']);
    
//     Route::get('/usuario/{id}',    [UsuarioController::class, 'show']);
    
//     Route::post('/usuario',        [UsuarioController::class, "store"]);
    
//     Route::put('/usuario/{id}',    [UsuarioController::class, "update"]);
    
//     Route::delete('/usuario/{id}', [UsuarioController::class, "destroy"]);
// });

// Route::apiResource('usuarios', UsuarioController::class);

Route::get('/api/documentation', function () {
    return view('l5-swagger::index');
});