<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Proveedor - Sports Store</title>
    <link rel="stylesheet" href="{{ asset('registro_proveedor.css') }}">

</head>
<body>
    <header>
        <h1>Registro de Proveedor</h1>
    </header>

    <div class="form-container">
        <h2>Crear cuenta</h2>
        <form action="{{ route('proveedor.register.store') }}" method="POST">
            @csrf
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="error-text">{{ $message }}</div>
            @enderror

                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
            @error('apellido_paterno')
                <div class="error-text">{{ $message }}</div>
            @enderror

                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
            @error('apellido_materno')
                <div class="error-text">{{ $message }}</div>
            @enderror

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror

                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Registrarse</button>
        </form>

          <p class="login-link">¿Ya tienes cuenta? <a href="{{ route('proveedor.login') }}">Inicia sesión aquí</a></p>

        @if ($errors->any())
            <div class="error-list">
                <strong>Errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <footer>
        &copy; 2025 Sports Store - Todos los derechos reservados
    </footer>
</body>
</html>
