<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProveedorAuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('proveedor.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('proveedor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('proveedor.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // Mostrar dashboard del proveedor con productos
   public function dashboard()
{
    // Obtiene al proveedor autenticado usando el guard 'proveedor'
    $proveedor = Auth::guard('proveedor')->user();

    // Si por alguna razón no está autenticado, redirige
    if (!$proveedor) {
        return redirect()->route('proveedor.login')->withErrors(['error' => 'No has iniciado sesión.']);
    }

    // Obtiene los productos del proveedor autenticado
    $productos = Producto::where('proveedor_id', $proveedor->id)->get();

    return view('proveedor.dashboard', compact('productos'));
}

    // Mostrar formulario para crear producto
    public function crearProducto()
    {
        return view('proveedor.crear_producto');
    }

    // Guardar producto en la base de datos
    public function guardarProducto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|string',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'imagen' => $request->imagen ?? 'sin-imagen.jpg',
            'proveedor_id' => Auth::guard('proveedor')->id(),
        ]);

        return redirect()->route('proveedor.dashboard')->with('success', 'Producto creado correctamente');
    }

    // Mostrar formulario de registro de proveedor
    public function showRegisterForm()
    {
        return view('proveedor.register');
    }

    // Procesar registro del proveedor
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $rol = Role::where('nombre', 'proveedor')->first();

        $proveedor = Proveedor::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $rol ? $rol->id : null,
        ]);

        Auth::guard('proveedor')->login($proveedor);

        return redirect()->route('proveedor.dashboard');
    }

    // Cerrar sesión del proveedor
    public function logout(Request $request)
    {
        Auth::guard('proveedor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('proveedor.login');
    }
    public function editarProducto($id)
    {
    $producto = Producto::findOrFail($id);

    // Verifica que el proveedor sea el dueño del producto
    if ($producto->proveedor_id !== auth()->guard('proveedor')->id()) {
        abort(403, 'No autorizado.');
    }

    return view('proveedor.editar_producto', compact('producto'));
    }

    public function actualizarProducto(Request $request, $id)
    {
    $producto = Producto::findOrFail($id);

    if ($producto->proveedor_id !== auth()->guard('proveedor')->id()) {
        abort(403, 'No autorizado.');
    }

    $producto->nombre = $request->nombre;
    $producto->precio = $request->precio;
    $producto->imagen = $request->input('imagen_url');


    $producto->save();

    return redirect()->route('proveedor.dashboard')->with('success', 'Producto actualizado correctamente');
    }


}
