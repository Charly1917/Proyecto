<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerificarProveedor
{
    public function handle(Request $request, Closure $next)
    { 
        if(!Session::has('proveedor'))
            return redirect()->route('login',['r'=>encrypt($request->getRequestUri())]);

        return $next($request);
    }
}
