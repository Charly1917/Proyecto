<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Tienda Deportiva</title>
    <link rel="stylesheet" href="{{ asset('style_registro.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('img/Logo.jpg') }}" alt="Logo de Tienda Deportiva" />
        </div>
        <h1>Sports Store</h1>
    </header>

    <section id="register">
        <h2>Crear Cuenta</h2>

        {{-- Mensajes de error generales --}}
        @if ($errors->any())
            <div class="errores">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($estatus) && isset($mensaje))
            <div class="mensaje {{ $estatus }}">
                {{ $mensaje }}
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre') <div class="campo-error">{{ $message }}</div> @enderror

            <label for="apellido_paterno">Apellido Paterno:</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
            @error('apellido_paterno') <div class="campo-error">{{ $message }}</div> @enderror

            <label for="apellido_materno">Apellido Materno:</label>
            <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}">
            @error('apellido_materno') <div class="campo-error">{{ $message }}</div> @enderror

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="campo-error">{{ $message }}</div> @enderror

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password') <div class="campo-error">{{ $message }}</div> @enderror

            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Registrar</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="{{ route('login.form') }}">Inicia sesión</a></p>
    </section>

    <footer>
        <p>&copy; 2023 Tienda Deportiva. Todos los derechos reservados.</p>
    </footer>

    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
