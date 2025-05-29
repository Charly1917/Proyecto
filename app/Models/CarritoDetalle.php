<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    use HasFactory;

    protected $table = 'carrito_detalles'; 

    protected $fillable = ['user_id', 'producto_id', 'cantidad', 'subtotal'];

    // Relación con el carrito
    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    // Relación con el producto
    public function producto()
{
    return $this->belongsTo(Producto::class);
}

}
