<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerificarUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('usuario')) {
            // Encriptar la URI completa (ruta con query)
            $rutaEncriptada = encrypt($request->getRequestUri());

            // Redirigir al login con la ruta encriptada en parámetro 'r'
            return redirect()->route('login', ['r' => $rutaEncriptada]);
        }

        return $next($request);
    }
}
