<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hola');
});

Route::get('hola', function () {
    return view("hola");
});

Route::get('prueba', function () {
    return view("prueba/prueba");
});