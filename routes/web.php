<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;


// Página de inicio que muestra el formulario de login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');

// Ruta para procesar el login
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Página principal (inicio) solo accesible si el usuario está autenticado
Route::get('/inicio', function () {
    $productos = Producto::all();
    return view('inicio', compact('productos'));
})->middleware('auth')->name('inicio');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para el formulario de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

// Ruta para procesar el registro
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
