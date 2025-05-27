<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodigoPostal;

class CodigoPostalController extends Controller
{
    public function buscar($codigo_postal)
    {
        $registro = CodigoPostal::where('codigo_postal', $codigo_postal)->first();

        if (!$registro) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json([
            'estado' => $registro->estado,
            'ciudad' => $registro->ciudad,
            'colonia' => $registro->colonia,
            'pais' => $registro->pais,
        ]);
    }
}

