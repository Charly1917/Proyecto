<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProveedorAuthController;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| Rutas para USUARIOS
|--------------------------------------------------------------------------
*/

// Página de inicio que muestra el formulario de login (usuarios)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el login de usuarios
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Página principal (inicio) para usuarios autenticados
Route::get('/inicio', function () {
    $productos = Producto::all();
    return view('inicio', compact('productos'));
})->middleware('auth')->name('inicio');

// Ruta para cerrar sesión (usuarios)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');


// Formulario de registro de usuarios
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

// Procesar registro de usuarios
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


/*
|--------------------------------------------------------------------------
| Rutas para PROVEEDORES
|--------------------------------------------------------------------------
*/

// Formulario de registro de proveedores
Route::get('/proveedor/registro', [ProveedorAuthController::class, 'showRegisterForm'])->name('proveedor.register.form');

// Procesar registro de proveedores
Route::post('/proveedor/registro', [ProveedorAuthController::class, 'register'])->name('proveedor.register.store');

// Formulario de login para proveedores
Route::get('/proveedor/login', [ProveedorAuthController::class, 'showLoginForm'])->name('proveedor.login');

// Procesar login de proveedores
Route::post('/proveedor/login', [ProveedorAuthController::class, 'login'])->name('proveedor.login.submit');

// Cerrar sesión del proveedor
Route::post('/proveedor/logout', [ProveedorAuthController::class, 'logout'])->name('proveedor.logout');

// Rutas protegidas con el guard de proveedor
Route::middleware('auth:proveedor')->group(function () {
    
    // Panel principal del proveedor
    Route::get('/proveedor/dashboard', [ProveedorAuthController::class, 'dashboard'])->name('proveedor.dashboard');

    // Formulario para crear producto (solo proveedor autenticado)
    Route::get('/proveedor/productos/create', [ProveedorAuthController::class, 'crearProducto'])->name('proveedor.producto.create');

    // Guardar nuevo producto (solo proveedor autenticado)
    Route::post('/proveedor/productos', [ProveedorAuthController::class, 'guardarProducto'])->name('proveedor.producto.store');

    // Formulario para editar producto
Route::get('/proveedor/productos/{id}/edit', [ProveedorAuthController::class, 'editarProducto'])->name('proveedor.producto.edit');

// Guardar cambios al producto editado
Route::put('/proveedor/productos/{id}', [ProveedorAuthController::class, 'actualizarProducto'])->name('proveedor.producto.update');

});
