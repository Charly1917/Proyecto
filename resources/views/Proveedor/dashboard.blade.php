<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Proveedor</title>
    <link rel="stylesheet" href="{{ asset('style3.css') }}">
</head>
<body>
    <header>
        <h1>Panel del Proveedor</h1>
        <form id="logout-form" action="{{ route('proveedor.logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <div class="container">
        <h2>Mis Productos</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($productos->count())
            @foreach ($productos as $producto)
                <div class="producto">
                    <strong>{{ $producto->nombre }}</strong><br>
                    Precio: ${{ $producto->precio }}<br>
                    @if ($producto->imagen)
                        <img src="{{ $producto->imagen }}" alt="Imagen del producto">
                    @endif
                    <br>
                    <a href="{{ route('proveedor.producto.edit', $producto->id) }}" class="button">Editar</a>
                </div>
            @endforeach
        @else
            <p>No has agregado productos aún.</p>
        @endif

        <a href="{{ route('proveedor.producto.create') }}" class="button" style="margin-top: 20px;">Agregar nuevo producto</a>
    </div>
</body>
</html>
