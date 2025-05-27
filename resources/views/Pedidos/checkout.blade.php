@extends('layouts.app')



@section('head')
    <link rel="stylesheet" href="{{ asset('estilo_tienda.css') }}">
@endsection



@section('content')
<div class="container">
    <h2>Resumen del Carrito</h2>

    <a href="{{ route('inicio') }}" class="btn-regresar">Regresar al Inicio</a>

   <table class="table table-bordered resumen-table mt-3">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carrito as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->producto->precio, 2) }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end">Total:</th>
            <th>${{ number_format($total, 2) }}</th>
        </tr>
    </tfoot>
</table>


    <h3>Método de pago</h3>
   <form method="POST" action="{{ route('pedido.procesar') }}">
        @csrf
            <div class="opciones-pago">
                <label>
                    <input type="radio" name="metodo_pago" value="efectivo"> Efectivo
                </label>
                <label>
                    <input type="radio" name="metodo_pago" value="tarjeta"> Tarjeta
                </label>
            </div>


        <div id="datos_tarjeta" style="display:none; margin-top:20px;">
            <h4>Datos de la tarjeta</h4>
            <input type="text" name="numero_tarjeta" placeholder="Número de tarjeta">
            <input type="text" name="nombre_titular" placeholder="Nombre del titular">
            <input type="text" name="fecha_expiracion" placeholder="MM/AA">
            <input type="text" name="cvv" placeholder="CVV">
        <h4>Dirección</h4>

            <input type="text" name="calle" placeholder="Calle" required>
            <input type="text" name="numero" placeholder="Número" required>
            <input type="text" name="referencias" placeholder="Referencias (opcional)">

            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código Postal" required>

            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" value="{{ old('estado') }}">

            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}">
            <label for="colonia">Colonia:</label>
            <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}">
            <label for="pais">País:</label>
            <input type="text" name="pais" id="pais" value="{{ old('pais') }}">

        </div>

        <br>
        <div class="botones-centro">
    <button type="submit" class="btn btn-primary">Finalizar pedido</button>
</div>

    </form>
</div>

<script>
    const metodoRadios = document.querySelectorAll('input[name="metodo_pago"]');
    const datosTarjeta = document.getElementById('datos_tarjeta');

    metodoRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            datosTarjeta.style.display = (this.value === 'tarjeta') ? 'block' : 'none';
        });
    });
</script>

<script>
document.getElementById('codigo_postal').addEventListener('blur', function () {
    const cp = this.value;

    fetch(`/buscar-cp/${cp}`)
        .then(response => {
            if (!response.ok) throw new Error("Código no encontrado");
            return response.json();
        })
        .then(data => {
            document.getElementById('estado').value = data.estado || '';
            document.getElementById('ciudad').value = data.ciudad || '';
            document.getElementById('colonia').value = data.colonia || '';
            document.getElementById('pais').value = data.pais || '';
        })
        .catch(error => {
            alert('No se encontró el código postal');
            document.getElementById('estado').value = '';
            document.getElementById('ciudad').value = '';
            document.getElementById('colonia').value = '';
            document.getElementById('pais').value = '';
        });
});
</script>

@endsection
