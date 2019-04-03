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

        //OBtenemos la Fecha actual
        $hora_actual = Carbon::now()->format('H:i:s');
        //Obtenemos el HORARIO DEL USUARIO
        
        //OBTENEMOS EL NRO. DEL DÍA DE LA SEMANA
        $dia_semana = date('N');   
        //VERIFICAMOS QUE EL DÍA DE HOY SE ENCUENTRA EN LOS
        //HABILITADOS AL USUARIO        
        
        if($request->user()->hasRole($role) == true){
            $horario = $request->user()->getHorarios(Auth::user()->id);
            $pos_dia = strpos($horario->dias, $dia_semana);
            if(($hora_actual< $horario->hora_ini || $hora_actual > $horario->hora_fin)
                && $pos_dia !==false && $role == 'cobrador' ){
                Session()->put('horario',$horario);
                auth()->logout();
                return redirect()->route('noaccesonew');
            }
        }
        return $next($request);
    }
}
