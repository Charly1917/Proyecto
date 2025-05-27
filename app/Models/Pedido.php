<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'estado',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }

    // Relación con los productos a través de los detalles
    public function productos()
    {
        return $this->hasManyThrough(
            Producto::class,          // Modelo destino
            PedidoDetalle::class,    // Modelo intermedio
            'id',             // Foreign key en PedidoDetalle
            'producto_id',                    // Foreign key en Producto
            'pedido_id',                    // Local key en Pedido
            'producto_id'            // Local key en PedidoDetalle
        );
    }
}
