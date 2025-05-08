<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Especificamos que la tabla se llama 'usuarios'
    protected $table = 'usuarios';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'email', 'password',
    ];

    // Para la autenticación, la clave primaria
    protected $primaryKey = 'id';

    // Columnas protegidas al serializar
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Columnas tratadas como fechas
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
