<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;

//Route::get('/', [ProductoController::class, 'index']);


// GET con parámetro en la URL
Route::get('/{nombre}/{numero}', function ($nombre,$numero) {
    return response()->json(['mensaje' => "Hola $nombre, numero de la suerte es $numero"]);
});

// POST con parámetro en el body
Route::post('/saludo', function (Request $request) {
    $nombre = $request->nombre;
    $edad = $request->edad;
    return response()->json(['mensaje' => "Hola $nombre, tienes $edad años."]);
});