<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Crypt;
>>>>>>> 789716f (Descripción de los cambios)

class VerificarProveedor
{
    public function handle(Request $request, Closure $next)
<<<<<<< HEAD
    { 
        if(!Session::has('proveedor'))
            return redirect()->route('login',['r'=>encrypt($request->getRequestUri())]);
=======
    {
        if (!Session::has('proveedor')) {
            $rutaEncriptada = Crypt::encrypt($request->getRequestUri());
            return redirect()->route('proveedor.login', ['r' => $rutaEncriptada]);
        }
>>>>>>> 789716f (Descripción de los cambios)

        return $next($request);
    }
}
