<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'telefono',
        'rfc',
        'role_id',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELACIONES
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function carrito()
    {
        return $this->hasMany(CarritoDetalle::class, 'user_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'user_id');
    }

    public function direcciones() {
        return $this->hasMany(Direccion::class, 'user_id');
    }

    public function tarjetasCredito() {
        return $this->hasMany(TarjetaCredito::class, 'user_id');
    }
}
