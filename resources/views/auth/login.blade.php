<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tienda Deportiva</title>
    <link rel="stylesheet" href="{{ asset('style_login.css') }}">

</head>
<body>
    <header>
        <div class="logo">
            <img src="img/Logo.jpg" alt="Logo de Tienda Deportiva" />
        </div>
        <h1>Sports Store</h1>
        <nav>
            <ul>
                <li><a href="#home">Inicio</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <section id="login" class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Iniciar Sesión</button>
    </form>

    <p>¿No tienes cuenta? <a href="{{ route('register.form') }}">Regístrate</a></p>

    @if(isset($estatus) && isset($mensaje))
        <div class="mensaje {{ $estatus }}">
            {{ $mensaje }}
        </div>
    @endif
</section>


    <footer>
        <p>&copy; 2023 Tienda Deportiva. Todos los derechos reservados.</p>
    </footer>

</body>
</html>