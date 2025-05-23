<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded-xl p-8">
        <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">Editar Producto</h1>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proveedor.producto.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Descripción:</label>
                <textarea name="descripcion" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">URL de la imagen:</label>
                <input type="url" name="imagen" value="{{ old('imagen', $producto->imagen) }}" placeholder="https://ejemplo.com/imagen.jpg"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Vista previa:</label>
                @if($producto->imagen)
                    <img src="{{ $producto->imagen }}" alt="Imagen actual" class="w-32 h-32 object-cover rounded">
                @else
                    <p class="text-sm text-gray-500">No hay imagen registrada.</p>
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Stock:</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" min="0" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('proveedor.dashboard') }}"
                   class="inline-block px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                   Cancelar
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>

</body>
</html>
