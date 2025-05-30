<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProveedorAuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CodigoPostalController;
use App\Http\Controllers\InicioController;

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
Route::middleware('verificar.usuario')->group(function () {
    Route::get('/inicio', [InicioController::class, 'inicio'])->name('inicio');
    
});




// Cerrar sesión de usuarios
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
// Login y registro de proveedores
Route::get('/proveedor/login', [ProveedorAuthController::class, 'showLoginForm'])->name('proveedor.login');
Route::post('/proveedor/login', [ProveedorAuthController::class, 'verificarLogin'])->name('proveedor.login.submit');

Route::get('/proveedor/registro', [ProveedorAuthController::class, 'showRegisterForm'])->name('proveedor.register.form');
Route::post('/proveedor/registro', [ProveedorAuthController::class, 'register'])->name('proveedor.register.store');

// Cerrar sesión proveedor (sin middleware 'auth:proveedor' porque usas sesión manual)
Route::post('/proveedor/logout', [ProveedorAuthController::class, 'logout'])->name('proveedor.logout');

// Rutas protegidas para proveedores autenticados
Route::middleware('verificarproveedor')->group(function () {
    Route::get('/proveedor/dashboard', [ProveedorAuthController::class, 'dashboard'])->name('proveedor.dashboard');

    Route::get('/proveedor/productos/create', [ProveedorAuthController::class, 'crearProducto'])->name('proveedor.producto.create');
    Route::post('/proveedor/productos', [ProveedorAuthController::class, 'guardarProducto'])->name('proveedor.producto.store');

    Route::get('/proveedor/productos/{id}/edit', [ProveedorAuthController::class, 'editarProducto'])->name('proveedor.producto.edit');
    Route::put('/proveedor/productos/{id}', [ProveedorAuthController::class, 'actualizarProducto'])->name('proveedor.producto.update');
});

/*
|--------------------------------------------------------------------------
| Rutas para PRODUCTOS, CARRITO y PEDIDOS (usuarios autenticados)
|--------------------------------------------------------------------------
*/

// Mostrar listado de productos (acceso público o autenticado, según necesidad)
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

Route::middleware('verificar.usuario')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
});


Route::middleware('verificar.usuario')->group(function () {
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('pedido.checkout');
    Route::post('/checkout', [PedidoController::class, 'procesar'])->name('pedido.procesar');
    Route::get('/pedido/confirmacion', function () {
        return view('pedidos.confirmacion');
    })->name('pedido.confirmacion');
});

