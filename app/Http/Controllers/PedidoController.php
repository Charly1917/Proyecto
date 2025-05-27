<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\CarritoDetalle;
use App\Models\Direccion;
use App\Models\TarjetaCredito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function checkout()
    {
        $carrito = CarritoDetalle::where('user_id', Auth::id())->with('producto')->get();
        $total = $carrito->sum('subtotal');

        return view('pedidos.checkout', compact('carrito', 'total'));
    }
 public function procesar(Request $request)
{
    $request->validate([
        'metodo_pago' => 'required|in:efectivo,tarjeta',
        'calle' => 'required|string',
        'numero' => 'required|string',
        'codigo_postal' => 'required|string',
        'numero_tarjeta' => 'required_if:metodo_pago,tarjeta',
        'nombre_titular' => 'required_if:metodo_pago,tarjeta',
        'fecha_expiracion' => 'required_if:metodo_pago,tarjeta',
        'cvv' => 'required_if:metodo_pago,tarjeta',
    ]);

    $user = auth()->user();

    // Obtener carrito desde base de datos
    $carrito = CarritoDetalle::where('user_id', $user->id)->with('producto')->get();

    if ($carrito->isEmpty()) {
        return back()->withErrors('El carrito está vacío.');
    }

    // Calcular total
    $total = $carrito->sum('subtotal');

    // Crear el pedido
    $pedido = Pedido::create([
        'user_id' => $user->id,
        'total' => $total,
        'estado' => 'Pendiente',
    ]);

    // Guardar detalles del pedido
    foreach ($carrito as $item) {
        PedidoDetalle::create([
            'pedido_id' => $pedido->id,
            'producto_id' => $item->producto_id,
            'cantidad' => $item->cantidad,
            'precio_unitario' => $item->producto->precio,
        ]);
    }

    // Buscar código postal
    $codigoPostal = \App\Models\CodigoPostal::where('codigo_postal', $request->codigo_postal)->first();
    if (!$codigoPostal) {
        return back()->withErrors('Código postal inválido.');
    }

    // Guardar dirección
    $user->direcciones()->create([
    'codigo_postal_id' => $codigoPostal->id,
    'calle' => $request->calle,
    'numero' => $request->numero,
    'referencias' => $request->referencias,
    'colonia' => $request->colonia,
    'ciudad' => $request->ciudad,
    'estado' => $request->estado,
    'pais' => $request->pais,
    ]);


    // Guardar tarjeta si corresponde
    if ($request->metodo_pago === 'tarjeta') {
        $user->tarjetasCredito()->create([
            'numero_tarjeta' => $request->numero_tarjeta,
            'nombre_titular' => $request->nombre_titular,
            'fecha_expiracion' => $request->fecha_expiracion,
            'cvv' => $request->cvv,
        ]);
    }

    // Vaciar carrito
    CarritoDetalle::where('user_id', $user->id)->delete();

    return redirect()->route('pedido.confirmacion')->with('success', 'Pedido realizado correctamente');
}

}

