<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Deportiva</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/Logo.jpg" alt="=Logo de Tienda Deportiva" />
        </div>
        <h1>Sports Store</h1>
        <nav>
    <ul>
        <li><a href="#home" class="nav-link">Inicio</a></li>
        <li><a href="#productos" class="nav-link">Productos</a></li>
        <li><a href="#contacto" class="nav-link">Contacto</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link logout-btn">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
</nav>

    </header>

    <section id="home">
        <h2>Bienvenido a nuestra tienda</h2>
        <p> En Sport Store, vivimos y respiramos deporte. 
            Somos una tienda especializada en ofrecerte la mejor selección de ropa
            calzado y equipamiento deportivo para que alcances tu máximo rendimiento.
        </p>
    </section>

    <section id="productos">
    <h2>Productos Destacados</h2>

    @foreach ($productos as $producto)
        <div class="producto" onclick="agregarAlCarrito('{{ $producto->nombre }}', {{ $producto->precio }})">
            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
            <h3>{{ $producto->nombre }}</h3>
            <p>Precio: ${{ number_format($producto->precio, 2) }}</p>
        </div>
    @endforeach
</section>


    <section id="contacto">
        <h2>Contacto</h2>
        <form id="contactForm">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" required>
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Tienda Deportiva. Todos los derechos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>