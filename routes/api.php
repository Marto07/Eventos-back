<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('usuarios')->group(function () {

    Route::get('/',         [\App\Http\Controllers\UsuarioController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\UsuarioController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\UsuarioController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\UsuarioController::class, "update"]);

    Route::patch('/{id}',    [\App\Http\Controllers\UsuarioController::class, "partialUpdate"]);
    
    Route::delete('/{id}', [\App\Http\Controllers\UsuarioController::class, "destroy"]);

    Route::post('/login', [\App\Http\Controllers\UsuarioController::class, "authenticate"]);
    
});

Route::prefix('tickets')->group(function () {

    Route::get('/',         [\App\Http\Controllers\TicketController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\TicketController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\TicketController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\TicketController::class, "update"]);
    
    Route::patch('/{id}',    [\App\Http\Controllers\TicketController::class, "partialUpdate"]);

    Route::delete('/{id}', [\App\Http\Controllers\TicketController::class, "destroy"]);
    
});

Route::prefix('eventos')->group(function () {

    Route::get('/',         [\App\Http\Controllers\EventoController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\EventoController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\EventoController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\EventoController::class, "update"]);

    Route::patch('/{id}',    [\App\Http\Controllers\EventoController::class, "partialUpdate"]);
    
    Route::delete('/{id}', [\App\Http\Controllers\EventoController::class, "destroy"]);
    
});

Route::prefix('invitados')->group(function () {

    Route::get('/',         [\App\Http\Controllers\InvitadoController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\InvitadoController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\InvitadoController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\InvitadoController::class, "update"]);

    Route::patch('/{id}',    [\App\Http\Controllers\InvitadoController::class, "partialUpdate"]);
    
    Route::delete('/{id}', [\App\Http\Controllers\InvitadoController::class, "destroy"]);
    
});

Route::prefix('requisitos')->group(function () {

    Route::get('/',         [\App\Http\Controllers\RequisitoController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\RequisitoController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\RequisitoController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\RequisitoController::class, "update"]);

    Route::patch('/{id}',    [\App\Http\Controllers\RequisitoController::class, "partialUpdate"]);
    
    Route::delete('/{id}', [\App\Http\Controllers\RequisitoController::class, "destroy"]);
    
});

Route::prefix('tipo-requisitos')->group(function () {

    Route::get('/',         [\App\Http\Controllers\TipoRequisitoController::class, 'index']);
    
    Route::get('/{id}',    [\App\Http\Controllers\TipoRequisitoController::class, 'show']);
    
    Route::post('/',        [\App\Http\Controllers\TipoRequisitoController::class, "store"]);
    
    Route::put('/{id}',    [\App\Http\Controllers\TipoRequisitoController::class, "update"]);

    Route::patch('/{id}',    [\App\Http\Controllers\TipoRequisitoController::class, "partialUpdate"]);
    
    Route::delete('/{id}', [\App\Http\Controllers\TipoRequisitoController::class, "destroy"]);
    
});