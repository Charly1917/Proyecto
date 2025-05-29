
@extends('layouts.app')


@section('head')
    <link rel="stylesheet" href="{{ asset('estilo_tienda.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Carrito de Compras</h2>

  <a href="{{ route('inicio') }}" class="btn-regresar">Regresar al Inicio</a>

    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($carrito->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carrito as $item)
                    <tr>
                        <td>{{ $item->producto->nombre ?? 'Producto no encontrado' }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->producto->precio ?? 0, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay productos en el carrito.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="botones-centro">
            <a href="{{ route('pedido.checkout') }}" class="btn btn-success">Finalizar Pedido</a>
            <a href="{{ route('carrito.vaciar') }}" class="btn btn-danger">Vaciar Carrito</a>
        </div>
    @else
        <p>Tu carrito está vacío.</p>
    @endif
</div>
@endsection