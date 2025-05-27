<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="{{ asset('style3.css') }}">
</head>
<body>
    <header>
        <h1>Editar Producto</h1>
        <a href="{{ route('proveedor.dashboard') }}" class="button cancel-button">Volver</a>
    </header>

    <div class="form-container">
        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proveedor.producto.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>

            <label>Descripción:</label>
            <textarea name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required>

            <label>URL de la imagen:</label>
            <input type="url" name="imagen" value="{{ old('imagen', $producto->imagen) }}">

            @if($producto->imagen)
                <img src="{{ $producto->imagen }}" alt="Imagen actual" style="max-width: 100px;">
            @endif

            <label>Stock:</label>
            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" min="0" required>

            <div>
                <a href="{{ route('proveedor.dashboard') }}" class="button cancel-button">Cancelar</a>
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>
</html>
