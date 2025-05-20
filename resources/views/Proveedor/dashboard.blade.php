<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Proveedor</title>
    <link rel="stylesheet" href="{{ asset('style2.css') }}">
    <style>
        .btn-agregar {
            background-color: #ffcc00;
            padding: 10px 16px;
            border-radius: 5px;
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-btn {
            background-color: #cc0000;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .producto {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            max-width: 300px;
        }

        .producto img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">
            <h1 style="margin: 0;">Panel del Proveedor</h1>

            {{-- Formulario invisible para cerrar sesión --}}
            <form id="logout-form" action="{{ route('proveedor.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            {{-- Botón visible para cerrar sesión --}}
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                Cerrar Sesión
            </button>
        </div>
    </header>

    <div style="padding: 20px;">
        <h2 style="color: #0033cc;">Mis Productos</h2>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div style="color: green; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista de productos --}}
        @if ($productos->count())
            @foreach ($productos as $producto)
                <div class="producto">
                    <strong>{{ $producto->nombre }}</strong><br>
                    Precio: ${{ $producto->precio }}<br>
                    @if ($producto->imagen)
                        <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto">
                    @endif
                    <br>
                    <a href="{{ route('proveedor.producto.edit', $producto->id) }}" class="btn-agregar" style="background-color:#3399ff; color: white; margin-top: 8px; display:inline-block;">
                        Editar
                    </a>
                </div>
            @endforeach
        @else
            <p>No has agregado productos aún.</p>
        @endif

        <br>
        <a href="{{ route('proveedor.producto.create') }}" class="btn-agregar">Agregar nuevo producto</a>
    </div>
</body>
</html>
