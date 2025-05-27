<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    protected $table = 'codigos_postales'; // o 'codigo_postals' si tu tabla se llama así

    protected $fillable = [
        'codigo_postal', 'estado', 'ciudad', 'colonia', 'pais'
    ];
}
