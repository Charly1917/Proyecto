@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section id="home">
    <h2>Bienvenido a nuestra tienda</h2>
    <p>
        En Sport Store, vivimos y respiramos deporte.
        Somos una tienda especializada en ofrecerte la mejor selección de ropa,
        calzado y equipamiento deportivo para que alcances tu máximo rendimiento.
    </p>
</section>

<section id="productos">
    <h2>Productos Destacados</h2>

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
        <a href="{{ route('pedido.checkout') }}" class="btn-finalizar">Finalizar Pedido</a>
    </div>
</section>

<section id="contacto">
  <h2>Contáctanos</h2>
  @if(session('success'))
    <p style="color: #00ff00;">{{ session('success') }}</p>
  @endif

  <form action="{{ route('mensajes.store') }}" method="POST">
    @csrf

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" required>

    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" rows="5" required></textarea>

    <button type="submit">Enviar mensaje</button>
  </form>
</section>


@endsection
