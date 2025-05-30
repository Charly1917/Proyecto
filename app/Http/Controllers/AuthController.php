<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
   public function login(Request $request)
{
    if (!$request->email || !$request->password) {
        return view('auth.login', ['estatus' => 'error', 'mensaje' => '¡Completa los campos!']);
    }

    $usuario = User::where('email', $request->email)->first();

    if (!$usuario) {
        return view('auth.login', ['estatus' => 'error', 'mensaje' => '¡El correo no está registrado!']);
    }

    if (!Hash::check($request->password, $usuario->password)) {
        return view('auth.login', ['estatus' => 'error', 'mensaje' => '¡La contraseña es incorrecta!']);
    }

    // Guardar el usuario en la sesión
    Session::put('usuario', $usuario);

    if ($request->has('r')) {
        try {
            $ruta = Crypt::decrypt($request->r);
            return redirect($ruta);
        } catch (\Exception $e) {
            // Si falla el decrypt, redirige al inicio normal
        }
    }

    return redirect()->route('inicio');
}


    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe tener un formato válido.',
            'email.unique' => '¡El correo ya está registrado!',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);


        $usuarioExistente = User::where('email', $request->email)->first();

        if ($usuarioExistente) {
            return view("auth.register", ['estatus' => 'error', 'mensaje' => '¡El correo ya está registrado!']);
        }

        $rol = Role::where('nombre', 'cliente')->first();

        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->role_id = $rol ? $rol->id : null;
        $usuario->save();

        return view('auth.login', ['estatus' => 'success', 'mensaje' => '¡Cuenta creada! Inicia sesión.']);
    }

    // Cerrar sesión
        public function logout()
    {
        Session::flush(); // Elimina toda la sesión
        return redirect()->route('login.form');
    }


}
