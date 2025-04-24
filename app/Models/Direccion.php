<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'direccion', 'ciudad', 'estado', 'codigo_postal'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
