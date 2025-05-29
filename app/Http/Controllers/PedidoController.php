<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\CarritoDetalle;
use App\Models\Direccion;
use App\Models\TarjetaCredito;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    public function checkout()
    {
        $user = Session::get('usuario');
        $userId = is_object($user) ? $user->id : ($user['id'] ?? null);

        if (!$userId) {
            return redirect()->route('login');
        }

        $carrito = CarritoDetalle::where('user_id', $userId)->with('producto')->get();
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

        $user = Session::get('usuario');
        $userId = is_object($user) ? $user->id : ($user['id'] ?? null);

        if (!$userId) {
            return redirect()->route('login');
        }

        // Obtener carrito desde base de datos
        $carrito = CarritoDetalle::where('user_id', $userId)->with('producto')->get();

        if ($carrito->isEmpty()) {
            return back()->withErrors('El carrito está vacío.');
        }

        // Calcular total
        $total = $carrito->sum('subtotal');

        // Crear el pedido
        $pedido = Pedido::create([
            'user_id' => $userId,
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
        Direccion::create([
            'user_id' => $userId,
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
            TarjetaCredito::create([
                'user_id' => $userId,
                'numero_tarjeta' => $request->numero_tarjeta,
                'nombre_titular' => $request->nombre_titular,
                'fecha_expiracion' => $request->fecha_expiracion,
                'cvv' => $request->cvv,
            ]);
        }

        // Vaciar carrito
        CarritoDetalle::where('user_id', $userId)->delete();

        return redirect()->route('pedido.confirmacion')->with('success', 'Pedido realizado correctamente');
    }
}
