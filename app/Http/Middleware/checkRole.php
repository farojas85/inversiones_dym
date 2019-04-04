<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;


class checkRole
{
    
    public function handle($request, Closure $next,$role)
    {
        $hora_actual = Carbon::now()->format('H:i:s'); 
        
        if($request->user()->hasRole($role) == true){
            $count_horario =  $request->user()->countHorarios(Auth::user()->id);            
            if($count_horario > 0 && $role == 'cobrador')
            {
                $horario = $request->user()->getHorarios(Auth::user()->id);

                $pos_dia = strpos($horario->dias, date('N'));

                if(($hora_actual< $horario->hora_inicio || $hora_actual > $horario->hora_fin)
                    || $pos_dia === false  ){
                    Session()->put('horario',$horario);
                    auth()->logout();
                    return redirect()->route('noaccesonew');
                }
            }
            else if($count_horario == 0 && $role == 'cobrador'){
                auth()->logout();
                return redirect()->route('noaccesonothing');
            }
        }
        return $next($request);
    }
}
