<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function index()
{
    $usuario = Session::get('usuario');

    if (!$usuario) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver el carrito.');
    }

    $carrito = CarritoDetalle::with('producto')
                ->where('user_id', $usuario->id)
                ->get();

    $total = $carrito->sum('subtotal');

    return view('carrito.index', compact('carrito', 'total'));
}

    public function agregar($id)
    {
        $usuario = Session::get('usuario');

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        $producto = Producto::findOrFail($id);

        $item = CarritoDetalle::firstOrCreate(
            ['user_id' => $usuario->id, 'producto_id' => $id],
            [
                'user_id'     => $usuario->id,
                'producto_id' => $id,
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
        $usuario = Session::get('usuario');

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para vaciar el carrito.');
        }

        CarritoDetalle::where('user_id', $usuario->id)->delete();

        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado');
    }
}
