<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones'; // 👈 Esto soluciona el error

    protected $fillable = [
        'user_id',
        'codigo_postal_id',
        'calle',
        'numero',
        'referencias',
        'colonia',
        'ciudad',
        'estado',
        'pais',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function codigoPostal()
    {
        return $this->belongsTo(CodigoPostal::class);
    }
}
