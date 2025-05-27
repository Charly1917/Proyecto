<?php

// app/Models/TarjetaCredito.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarjetaCredito extends Model
{
    protected $table = 'tarjetas_credito'; // Esto corrige el nombre real

    protected $fillable = [
        'usuario_id',
        'numero_tarjeta',
        'nombre_titular',
        'fecha_expiracion',
        'cvv',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}

