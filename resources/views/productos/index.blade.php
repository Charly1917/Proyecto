@extends('layouts.app')


@section('head')
    <link rel="stylesheet" href="{{ asset('estilo_tienda.css') }}">
@endsection

@section('content')
<section id="productos">
    <h2>Productos Destacados</h2>

    <a href="{{ route('inicio') }}" class="btn-regresar">Regresar al Inicio</a>


    @foreach ($productos as $producto)
        <a href="{{ route('carrito.agregar', $producto->id) }}">
            <div class="producto">
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" />
                <h3>{{ $producto->nombre }}</h3>
                <p>Precio: ${{ number_format($producto->precio, 2) }}</p>
            </div>
        </a>
    @endforeach

    <div style="margin-top: 20px;">
        <a href="{{ route('pedido.checkout') }}" class="btn btn-primary">Finalizar Pedido</a>
    </div>
</section>
@endsection