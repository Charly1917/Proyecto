<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Role;

class ProveedorAuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('proveedor.login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('proveedor.register');
    }

    // Registrar nuevo proveedor
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $rol = Role::where('nombre', 'proveedor')->first();

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->apellido_paterno = $request->apellido_paterno;
        $proveedor->apellido_materno = $request->apellido_materno;
        $proveedor->email = $request->email;
        $proveedor->password = Hash::make($request->password);
        $proveedor->role_id = $rol ? $rol->id : null;
        $proveedor->save();

        return redirect()->route('proveedor.login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    // Validar inicio de sesión
    public function verificarLogin(Request $request)
    {
        // Limpia otras sesiones de proveedor
        Session::forget('proveedor');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $proveedor = Proveedor::where('email', $request->email)->first();

        if (!$proveedor) {
            return back()->withErrors(['email' => 'Este correo no está registrado.'])->withInput();
        }

        if (!Hash::check($request->password, $proveedor->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.'])->withInput();
        }
        Session::put('proveedor', $proveedor);
        // Guardar sesión del proveedor
            if ($request->has('r')) {
                try {
                    $ruta = Crypt::decrypt($request->r);
                    return redirect($ruta);
                } catch (\Exception $e) {
                }
            }

            return redirect()->route('proveedor.dashboard');

    }

    // Cerrar sesión

        public function logout()
    {
        Session::flush(); // Elimina toda la sesión
        return redirect()->route('proveedor.login'); // Redirige a login del proveedor
    }

    

    // Mostrar dashboard con productos del proveedor logueado
    public function dashboard()
    {
        if (!Session::has('proveedor')) {
            return redirect()->route('proveedor.login')->withErrors(['error' => 'Debes iniciar sesión.']);
        }

        $proveedor = Session::get('proveedor');

        // Asegúrate que tu modelo Proveedor tiene la relación productos()
        $productos = Producto::where('proveedor_id', $proveedor->id)->get();

        return view('proveedor.dashboard', compact('productos', 'proveedor'));
    }

    // Mostrar formulario para crear nuevo producto
    public function crearProducto()
    {
        if (!Session::has('proveedor')) {
            return redirect()->route('proveedor.login');
        }

        return view('proveedor.crear_producto');
    }

    // Guardar nuevo producto
    public function guardarProducto(Request $request)
    {
        if (!Session::has('proveedor')) {
            return redirect()->route('proveedor.login');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|string',
            'stock'  => 'required|integer|min:0',
        ]);

        $proveedor = Session::get('proveedor');

        Producto::create([
            'nombre'       => $request->nombre,
            'precio'       => $request->precio,
            'imagen'       => $request->imagen ?? 'sin-imagen.jpg',
            'stock'        => $request->stock,
            'proveedor_id' => $proveedor->id,
        ]);

        return redirect()->route('proveedor.dashboard')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario de edición de producto
    public function editarProducto($id)
    {
        if (!Session::has('proveedor')) {
            return redirect()->route('proveedor.login');
        }

        $producto = Producto::findOrFail($id);
        $proveedor = Session::get('proveedor');

        if ($producto->proveedor_id !== $proveedor->id) {
            abort(403, 'No autorizado.');
        }

        return view('proveedor.editar_producto', compact('producto'));
    }

    // Actualizar producto
    public function actualizarProducto(Request $request, $id)
    {
        if (!Session::has('proveedor')) {
            return redirect()->route('proveedor.login');
        }

        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric',
            'imagen'      => 'nullable|string',
            'stock'       => 'required|integer|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $proveedor = Session::get('proveedor');

        if ($producto->proveedor_id !== $proveedor->id) {
            abort(403, 'No autorizado.');
        }

        $producto->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion ?? 'Sin descripción',
            'precio'      => $request->precio,
            'imagen'      => $request->imagen ?? 'sin-imagen.jpg',
            'stock'       => $request->stock,
        ]);

        return redirect()->route('proveedor.dashboard')->with('success', 'Producto actualizado correctamente.');
    }
}
