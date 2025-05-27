<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = CarritoDetalle::with('producto')
                    ->where('user_id', Auth::id())->get();

        return view('carrito.index', compact('carrito'));
    }

   public function agregar($id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
    }

    $producto = Producto::findOrFail($id);

    $item = CarritoDetalle::firstOrCreate(
        ['user_id' => Auth::id(), 'producto_id' => $id],
        [
            'user_id'     => Auth::id(),   // 👈 AÑADIDO AQUÍ
            'producto_id' => $id,          // 👈 AÑADIDO AQUÍ
            'cantidad'    => 0,
            'subtotal'    => 0
        ]
    );

    $item->cantidad += 1;
    $item->subtotal = $item->cantidad * $producto->precio;
    $item->save();

    return redirect()->back()->with('success', 'Producto agregado al carrito');
}



    public function vaciar()
    {
        CarritoDetalle::where('user_id', Auth::id())->delete();
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado');
    }
}

