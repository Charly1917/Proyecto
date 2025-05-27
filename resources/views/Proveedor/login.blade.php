<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Proveedor</title>
    <link rel="stylesheet" href="{{ asset('login_provedor.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="{{ asset('img/Logo.jpg') }}" alt="Logo de Tienda Deportiva" />
            </div>
            <h1>Sports Store</h1>
        </header>

        <section class="login-form">
            <h2>Iniciar Sesión</h2>
            <form action="{{ route('proveedor.login.submit') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group password-toggle">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="toggle-btn" onclick="togglePassword()">👁️</button>
                </div>

                <button type="submit">Iniciar Sesión</button>
            </form>

            <p>¿No tienes cuenta? <a href="{{ route('proveedor.register.form') }}">Regístrate</a></p>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                 <div class="alert alert-success">
             {{ session('success') }}
                </div>
            @endif

        </section>

        <footer>
            <p>&copy; 2023 Tienda Deportiva. Todos los derechos reservados.</p>
        </footer>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleBtn = document.querySelector(".toggle-btn");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleBtn.textContent = "🙈";
            } else {
                passwordInput.type = "password";
                toggleBtn.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
