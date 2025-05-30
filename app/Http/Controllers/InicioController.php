<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Producto; 
use App\Models\CarritoDetalle;

class InicioController extends Controller
{
        public function inicio()
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login.form');
        }

        $usuario = Session::get('usuario');
        $productos = Producto::all(); 

        $carritoCount = CarritoDetalle::where('user_id', $usuario->id)->count();

        return view('inicio', compact('usuario', 'productos', 'carritoCount'));
    }

}
