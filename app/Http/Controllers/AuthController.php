<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Asegúrate de que el modelo User esté correctamente configurado
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
        $credentials = $request->only('email', 'password');

        // Intentar iniciar sesión con las credenciales
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('inicio'); // Redirige al inicio
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
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
        'password' => 'required|confirmed|min:6',
    ]);

    // Obtener el rol de "cliente" o "usuario"
    $rol = Role::where('nombre', 'cliente')->first(); // o 'usuario' según el nombre que tengas

    // Crear nuevo usuario con rol
    User::create([
        'nombre' => $request->nombre,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $rol ? $rol->id : null, // asignar ID de rol
    ]);

    return redirect()->route('login.form')->with('success', 'Usuario registrado. Inicia sesión.');
}

    // Cerrar sesión
   public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login.form'); // Redirige por nombre de ruta
}

}