<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="{{ asset('style3.css') }}">
</head>
<body>
    <header>
        <h1>Agregar Producto</h1>
        <form action="{{ route('proveedor.logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <div class="form-container">
        <form action="{{ route('proveedor.producto.store') }}" method="POST">
            @csrf
            <label>Nombre del producto:</label>
            <input type="text" name="nombre" required>

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required>

            <label>Imagen (opcional):</label>
            <input type="text" name="imagen" placeholder="ruta/imagen.jpg">

            <label>Stock disponible:</label>
            <input type="number" name="stock" min="0" required>

            <div>
                <a href="{{ route('proveedor.dashboard') }}" class="button cancel-button">Cancelar</a>
                <button type="submit">Guardar Producto</button>
            </div>
        </form>
    </div>
</body>
</html>
