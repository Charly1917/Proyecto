<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    // Campos permitidos para asignación masiva
    protected $fillable = [
    'nombre',
    'descripcion',
    'precio',
    'stock',
    'imagen',
    'proveedor_id',
    ];


    // Activa timestamps
    public $timestamps = true;

    // Relación con proveedor
   public function proveedor()
    {
    return $this->belongsTo(Proveedor::class);
    }

}
