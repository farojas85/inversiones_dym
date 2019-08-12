<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\personal;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResumensExport;
use Session;

class ResumenController extends Controller
{
    public $resumenes;

    public function index()
    {
        
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
 
        foreach($roles as $role){
            $role_name = $role->name;
        }

        //Obteneos los clientes de acuerdo al rol
        $personals=null;
        $fecha_final=Date('Y-m-d');
        $fecha_ini = strtotime ( '-6 day' , strtotime ( $fecha_final ) );
        $fecha_ini = Date('Y-m-d',$fecha_ini);
        if($role_name == 'admin' || $role_name == 'master'){

            $personals = DB::table('personals as p')
                            ->join('users as u','p.user_id','=','u.id')
                            ->join('role_user as ru','u.id','=','ru.user_id')
                            ->join('roles as ro','ru.role_id','=','ro.id')
                            ->select('p.id','p.nombres','p.apellidos')
                            ->where('ro.id','=',4)
                            ->orderBy('p.apellidos','ASC')
                            ->orderBy('p.nombres','ASC')
                            ->get();

           

        }
        else{
            $personals = personal::where('user_id','=',$user_id)->get();
        }

        $resumen = array();     
        $x=0;
        foreach($personals as $pe){
            $f_ini = $fecha_ini;
            $f_fin = $fecha_final;
            $t=0;
            $total_recibido = 0;
            while($f_ini <= $f_fin)
            {
                $x+=1;
                $condicion_recibido =[
                    [ 'personal_id','=',$pe->id],
                    [ 'consumido','=',0]
                ];
                //Obtenemos el Total recibido del personal
                if($t==0){
                    $total_recibido = DB::table('personal_montos')
                                        ->where($condicion_recibido)
                                        ->sum('personal_montos.monto_asignado');
                }              
                
                //Obtenemos el Total de Préstamos del Personal
                $total_prestamo = DB::table('prestamos as pr')
                                        ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                        ->where('cp.personal_id','=',$pe->id)
                                        ->where('pr.fecha_prestamo','=',$f_ini)
                                        ->sum('pr.monto');
                
                //OBTENER TOTAL DE COBROS DEL DÍA
                $total_cobro = DB::table('cobranzas as co')
                                    ->join('prestamos as pr','co.prestamo_id','=','pr.id')
                                    ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                    ->where('cp.personal_id','=',$pe->id)
                                    ->where('co.fecha','=',$f_ini)
                                    ->sum('co.monto');

                //OBTENER TOTAL DE GASTOS DEL DIA
                $total_gasto = DB::table('personal_gastos as pg')
                                    ->where('pg.personal_id','=',$pe->id)
                                    ->where('pg.fecha','=',$f_ini)
                                    ->sum('pg.monto');

                $saldo = $total_recibido + $total_cobro - ($total_prestamo + $total_gasto);

                $res = array(
                    'id' => $x,
                    'personal' => $pe->apellidos." ".$pe->nombres,
                    'total_recibido' =>$total_recibido,
                    'fecha' => $f_ini,
                    'total_prestamo' => $total_prestamo,
                    'total_cobro' => $total_cobro,
                    'total_gasto' => $total_gasto,
                    'total_entregado' =>($total_cobro - $total_prestamo - $total_gasto),
                    'saldo' => $saldo
                );
                array_push($resumen,$res);
                $total_recibido = $saldo;
                $f_ini = strtotime ( '+1 day' , strtotime ( $f_ini ) );
                $f_ini = Date('Y-m-d',$f_ini);
                $t+=1;
            }
        }          
        return view('personal.resumen.index',compact('role_name','personals','resumen'));
    }

    public function busqueda_resumen(Request $request)
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
 
        foreach($roles as $role){
            $role_name = $role->name;
        }

        //Obteneos los clientes de acuerdo al rol
        $personals=null;

        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        if($request->personal_id == '%') {
            $personals = DB::table('personals as p')
                            ->join('users as u','p.user_id','=','u.id')
                            ->join('role_user as ru','u.id','=','ru.user_id')
                            ->join('roles as ro','ru.role_id','=','ro.id')
                            ->select('p.id','p.nombres','p.apellidos')
                            ->where('ro.id','=',4)
                            ->orderBy('p.apellidos','ASC')
                            ->orderBy('p.nombres','ASC')
                            ->get();
        }
        else {
            $personals = personal::where('id','=',$request->personal_id)->get();
        }

        $resumen = array();     
        $x=0;
        foreach($personals as $pe){
            $f_ini = $request->fecha_ini;
            $f_fin = $request->fecha_fin;
            $t=0;
            $total_recibido = 0;
            while($f_ini <= $f_fin)
            {
                $x+=1;
                $condicion_recibido =[
                    [ 'personal_id','=',$pe->id],
                    [ 'consumido','=',0]
                ];
                //Obtenemos el Total recibido del personal
                if($t==0){
                    $total_recibido = DB::table('personal_montos')
                                        ->where($condicion_recibido)
                                        ->sum('personal_montos.monto_asignado');
                }              
                
                //Obtenemos el Total de Préstamos del Personal
                $total_prestamo = DB::table('prestamos as pr')
                                        ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                        ->where('cp.personal_id','=',$pe->id)
                                        ->where('pr.fecha_prestamo','=',$f_ini)
                                        ->sum('pr.monto');
                
                //OBTENER TOTAL DE COBROS DEL DÍA
                $total_cobro = DB::table('cobranzas as co')
                                    ->join('prestamos as pr','co.prestamo_id','=','pr.id')
                                    ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                    ->where('cp.personal_id','=',$pe->id)
                                    ->where('co.fecha','=',$f_ini)
                                    ->sum('co.monto');

                //OBTENER TOTAL DE GASTOS DEL DIA
                $total_gasto = DB::table('personal_gastos as pg')
                                    ->where('pg.personal_id','=',$pe->id)
                                    ->where('pg.fecha','=',$f_ini)
                                    ->sum('pg.monto');

                $saldo = $total_recibido + $total_cobro - ($total_prestamo + $total_gasto);

                $res = array(
                    'id' => $x,
                    'personal' => $pe->apellidos." ".$pe->nombres,
                    'total_recibido' =>$total_recibido,
                    'fecha' => $f_ini,
                    'total_prestamo' => $total_prestamo,
                    'total_cobro' => $total_cobro,
                    'total_gasto' => $total_gasto,
                    'total_entregado' =>($total_cobro - $total_prestamo - $total_gasto),
                    'saldo' => $saldo
                );
                array_push($resumen,$res);
                $total_recibido = $saldo;
                $f_ini = strtotime ( '+1 day' , strtotime ( $f_ini ) );
                $f_ini = Date('Y-m-d',$f_ini);
                $t+=1;
            }
        }        
         
        Session::put('resumenes',$resumen);

        return view('personal.resumen.busqueda',compact('role_name','personals','resumen'));
    }

    public function exportar_excel()
    { 
        //return Session::get('resumenes');
        $resumenes = Session::get('resumenes');
        $export = new ResumensExport(Session::get('resumenes'));
        return Excel::download($export, 'Resumen.xlsx');
    }

}
