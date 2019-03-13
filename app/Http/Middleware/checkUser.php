<?php

namespace App\Http\Middleware;

use Closure;

class checkUser
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
        $hora_ini = "08:00:00";
        $hora_fin = "23:59:00";
        $hora_actual = date('H:i:s');

        if($request->user()->name == 'jcalzarte'){
            if($hora_actual< $hora_ini || $hora_actual >$hora_fin){
                auth()->logout();
                return redirect('/noacceso');
            }
        }

        return $next($request);
    }
}
