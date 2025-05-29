<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarProveedor
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('proveedor')->check()) {
        return redirect()->route('proveedor.login')->withErrors(['Acceso denegado. Por favor inicia sesión.']);
        }   


        return $next($request);
    }
}
