<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Asegúrate que este modelo existe y está configurado

class ProductoController extends Controller
{
    public function index()
    {
        // Obtener todos los productos para mostrar
        $productos = Producto::all();

        // Retornar la vista 'inicio' con los productos
        return view('inicio', compact('productos'));
    }
}
