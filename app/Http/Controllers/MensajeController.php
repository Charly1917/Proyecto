<?php
// app/Http/Controllers/ContactoController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
        'mensaje' => 'required|string',
    ]);

    Mensaje::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'mensaje' => $request->mensaje,
    ]);

    return redirect()->back()->with('success', 'Mensaje enviado correctamente');
}
}
