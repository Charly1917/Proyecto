<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProveedorAuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CodigoPostalController;

Route::get('/buscar-cp/{codigo_postal}', [CodigoPostalController::class, 'buscar']);



Route::post('/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');


/*
|--------------------------------------------------------------------------
| Rutas para USUARIOS
|--------------------------------------------------------------------------
*/

// Página de inicio que muestra el formulario de login (usuarios)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Procesar login de usuarios
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Página principal (inicio) para usuarios autenticados
Route::get('/inicio', function () {
    $productos = \App\Models\Producto::all();
    return view('inicio', compact('productos'));
})->middleware('auth')->name('inicio');

// Cerrar sesión de usuarios
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Ruta raíz redirige a login
Route::get('/', function () {
    return redirect()->route('login');
})->name('login.form');

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

// Cerrar sesión de proveedores
Route::post('/proveedor/logout', [ProveedorAuthController::class, 'logout'])->middleware('auth:proveedor')->name('proveedor.logout');

// Rutas protegidas para proveedores autenticados
Route::middleware('auth:proveedor')->group(function () {

    // Dashboard del proveedor
    Route::get('/proveedor/dashboard', [ProveedorAuthController::class, 'dashboard'])->name('proveedor.dashboard');

    // Formulario para crear producto
    Route::get('/proveedor/productos/create', [ProveedorAuthController::class, 'crearProducto'])->name('proveedor.producto.create');

    // Guardar nuevo producto
    Route::post('/proveedor/productos', [ProveedorAuthController::class, 'guardarProducto'])->name('proveedor.producto.store');

    // Formulario para editar producto
    Route::get('/proveedor/productos/{id}/edit', [ProveedorAuthController::class, 'editarProducto'])->name('proveedor.producto.edit');

    // Actualizar producto editado
    Route::put('/proveedor/productos/{id}', [ProveedorAuthController::class, 'actualizarProducto'])->name('proveedor.producto.update');
});

/*
|--------------------------------------------------------------------------
| Rutas para PRODUCTOS, CARRITO y PEDIDOS (usuarios autenticados)
|--------------------------------------------------------------------------
*/

// Mostrar listado de productos (acceso público o autenticado, según necesidad)
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
});

// Página checkout
Route::get('/checkout', [PedidoController::class, 'checkout'])->middleware('auth')->name('pedido.checkout');

// Procesar pedido
Route::post('/checkout', [PedidoController::class, 'procesar'])->middleware('auth')->name('pedido.procesar');


Route::get('/pedido/confirmacion', function () {
    return view('pedidos.confirmacion');
})->middleware('auth')->name('pedido.confirmacion');
