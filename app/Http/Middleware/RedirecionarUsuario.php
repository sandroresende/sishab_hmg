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
        if(Auth::user()->isEntePublico()){
            if($usuario->status_usuario_id < 3){
                if($usuario->modulo_sistema_id == 2)
                    return redirect('/selecao_beneficiarios');
                else
                    return redirect('/prototipo');    
            }else{
                Auth::logout();
                return redirect('/login');
            }        
        }else {
            return $next($request);
        }    
    }
}
