<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['pedido_id', 'monto', 'metodo_pago', 'estado'];

    // Relación con el pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
