<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="{{ asset('style2.css') }}">
</head>
<body>
    <header>
        <div>
            <h1>Agregar Producto</h1>
            <form action="{{ route('proveedor.logout') }}" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>

        </div>
    </header>

    <div class="container">
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

            <button type="submit" class="btn-guardar">Guardar Producto</button>
        </form>
    </div>
</body>
</html>
