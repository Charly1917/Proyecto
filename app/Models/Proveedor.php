<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'proveedores';

    // app/Models/Proveedor.php
protected $fillable = [
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'email',
    'password',
    'role_id',
];




    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }

    public function role()
{
    return $this->belongsTo(Role::class, 'role_id');
}

}
