<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'role_id');
    }

    // Relación con proveedores
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'role_id');
    }
}
