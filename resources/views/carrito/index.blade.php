
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
                @foreach ($carrito as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->producto->precio, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
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