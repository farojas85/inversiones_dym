<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $hora_ini = "08:00:00";
        $hora_fin = "23:59:00";
        $hora_actual = date('H:i:s');
        
        $nom_usu = Auth::user()->name;
        
        if($request->user()->hasRole($role) == true){
        	if($nom_usu == 'jcalzarte'){
        		if($hora_actual< $hora_ini || $hora_actual >'23:59:00' )
        		{
    				auth()->logout();
    				return redirect('/noacceso');
        		}
        	}
        	else{
        	    if($hora_actual< $hora_ini || $hora_actual >$hora_fin){
                    auth()->logout();
                    return redirect('/noacceso');
                }    
        	}
        	
            
        }
        return $next($request);
    }
}
