<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Nombre de la tabla (opcional si sigue convención)
    protected $table = 'productos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'precio',
        'imagen',
    ];

    // Si no usas timestamps (created_at y updated_at), agrega esto:
    public $timestamps = false;
}
