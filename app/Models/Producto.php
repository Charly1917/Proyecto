<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'proveedor_id',
    ];

    public $timestamps = true;

    // Relación: un producto pertenece a un proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    // Relación: un producto puede estar en muchos carritos
    public function carritoDetalles()
    {
        return $this->hasMany(CarritoDetalle::class);
    }

    // Relación: un producto puede estar en muchos pedidos
    public function pedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
}
