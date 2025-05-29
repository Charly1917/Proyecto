<!DOCTYPE html>
<html lang="es">
<head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Deportiva</title>
    
    @yield('head')
    <link rel="stylesheet" href="style2.css">
    {{-- Si quieres usar Bootstrap, puedes descomentar esto --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="{{ asset('img/Logo.jpg') }}" alt="Logo de Tienda Deportiva" />
                <h1>Sports Store</h1>
            </div>
            <div class="menu-toggle" id="menu-toggle" aria-label="Menú navegación" role="button" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="navbar" id="navbar">
            <ul>
                <li><a href="{{ route('inicio') }}" class="nav-link">Inicio</a></li>
                <li><a href="{{ route('inicio') }}#productos" class="nav-link">Productos</a></li>
                <li><a href="{{ route('inicio') }}#contacto" class="nav-link">Contacto</a></li>



                <li>
                    <a href="{{ route('carrito.index') }}" class="nav-link">
                        🛒 Carrito ({{ $carritoCount ?? 0 }})
                    </a>
                </li>


                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                         @csrf
                        <button type="submit" class="nav-link logout-btn">
                            Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Tienda Deportiva. Todos los derechos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
