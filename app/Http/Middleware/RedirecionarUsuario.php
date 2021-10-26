<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirecionarUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario = Auth::user();        
        if(Auth::user()->isEntePublico())
            if($usuario->modulo_sistema_id == 2)
                return redirect('/entePublico');
            else
                return redirect('/prototipo');    
        else 
            return $next($request);
    }
}
