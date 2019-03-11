<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

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
        $hora_ini = "07:00:00";
        $hora_fin = "21:00:00";
        $hora_actual = date('H:i:s');

        if($request->user()->hasRole($role) == true){
            if($hora_actual< $hora_ini || $hora_actual >$hora_fin){
                auth()->logout();
                return redirect('/noacceso');
            }
        }
        return $next($request);
    }
}
