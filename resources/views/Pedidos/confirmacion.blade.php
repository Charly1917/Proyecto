@extends('layouts.simple')


@section('content')
    <div class="confirmacion-pedido">
        <h2>¡Gracias por tu pedido!</h2>
        <p>Tu pedido ha sido procesado correctamente.</p>
        <a href="{{ route('inicio') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
