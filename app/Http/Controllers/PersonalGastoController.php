<?php

namespace App\Http\Controllers;

use App\PersonalGasto;
use App\personal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Exports\PersonalGastosExport;
use Maatwebsite\Excel\Facades\Excel;

class PersonalGastoController extends Controller
{
    var $personalgastos_array;
    public function __construct()
    {
        $this->middleware('permission:personalgastos.create')->only(['create','store']);
        $this->middleware('permission:personalgastos.index')->only('index');
        $this->middleware('permission:personalgastos.edit')->only(['edit','update']);
        $this->middleware('permission:personalgastos.show')->only('show');
        $this->middleware('permission:personalgastos.destroy')->only('destroy');
    }

    public function index()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        //Obteneos los clientes de acuerdo al rol
        $persona=null;
        $personalgastos = null;
        if($role_name == 'admin' || $role_name == 'master'){
            //Gastos de Todo el personal de Hoy
            $personalgastos = DB::table('personal_gastos as pg')
                            ->join('personals as p','pg.personal_id','=','p.id')
                            ->select('pg.id','pg.fecha',
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) as personal"),
                                'pg.fecha','pg.descripcion','pg.monto')
                            ->orderBy('personal','ASC')
                            ->orderBy('pg.fecha','ASC')
                            ->get();
        }
        else{

            $persona = personal::where('user_id','=',$user_id)->first();

            $personalgastos = PersonalGasto::where('personal_id','=',$persona->id)
                                    ->whereYear('fecha','=',date('Y'))
                                    ->orderBy('fecha','ASC')
                                    ->get();
        }

        return view('personal.gasto.index',compact('personalgastos','role_name'));
    }

    public function create()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        $personal = null;
        if($role_name == 'admin' || $role_name == 'master'){
             //El Personal
            $personal = DB::table('personals as p')
                        ->join('role_user as ru' ,'p.user_id','=','ru.user_id')
                        ->join('roles as r','ru.role_id','=','r.id')
                        ->select(
                            DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS nombres"),
                                'p.id')
                        ->where('r.name','cobrador')
                        ->pluck('nombres','p.id');
        }
        else{
            $personal = personal::where('user_id','=',$user_id)->get()->first();
        }

        $estadoform='create';
        return view('personal.gasto.create',compact('personal','role_name','estadoform'));
    }

    public function store(Request $request)
    {
        $PersonalGasto = new PersonalGasto();
        $PersonalGasto->personal_id = $request->personal_id;
        $PersonalGasto->fecha = $request->fecha;
        $PersonalGasto->descripcion = $request->descripcion;
        $PersonalGasto->monto = $request->monto;

        $PersonalGasto->save();

        return "Datos Registrados Satisfactoriamente";
    }


    public function show(PersonalGasto $personalGasto)
    {
        return view('personal.gasto.show',compact('personalGasto'));
    }

    public function edit(PersonalGasto $personalGasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalGasto  $personalGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalGasto $personalGasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalGasto  $personalGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personalGasto = PersonalGasto::findorFail($id);
        $personalGasto->delete();
        return "Registro Eliminado Satisfactoriamente";
    }

    public function busqueda_modal()
    {
        $personals = DB::table('personals as p')
                        ->join('role_user as ru' ,'p.user_id','=','ru.user_id')
                        ->join('roles as r','ru.role_id','=','r.id')
                        ->select(
                            DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS personal"),
                                'p.id')
                        ->where('r.name','cobrador')
                        ->where('p.estado','=','activo')
                        ->get();
        return view('personal.gasto.busqueda_modal',compact('personals'));
    }

    public function table()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        //Obteneos los clientes de acuerdo al rol
        $persona=null;
        $personalgastos = null;
        if($role_name == 'admin' || $role_name == 'master'){
            //Gastos de Todo el personal de Hoy
            $personalgastos = DB::table('personal_gastos as pg')
                            ->join('personals as p','pg.personal_id','=','p.id')
                            ->select('pg.id','pg.fecha',
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) as personal"),
                                'pg.fecha','pg.descripcion','pg.monto')
                            ->whereMonth('pg.fecha','=',date('m'))
                            ->orderBy('personal','ASC')
                            ->orderBy('pg.fecha','ASC')
                            ->get();
        }
        else{

            $persona = personal::where('user_id','=',$user_id)->first();

            $personalgastos = PersonalGasto::where('personal_id','=',$persona->id)
                                    ->whereYear('pg.fecha','=',date('Y'))
                                    ->orderBy('fecha','ASC')
                                    ->get();
        }

        return view('personal.gasto.table',compact('personalgastos','role_name'));
    }

    public function reporte(Request $request)
    {
        //obtenemos los gatos del personal seleccionado en un rango de fecha seleccionado
        $personalgastos = DB::table('personal_gastos as pg')
                                ->join('personals as p','pg.personal_id','=','p.id')
                            ->select(
                                DB::raw("CONCAT(p.apellidos,' ',p.nombres) as personal"),
                                'pg.fecha','pg.descripcion','pg.monto'
                                )
                            ->where('pg.personal_id','LIKE',$request->personal_id)
                            ->where('pg.fecha','>=',$request->fecha_inicio)
                            ->where('pg.fecha','<=',$request->fecha_final)
                            ->orderBy('personal','ASC')
                            ->get();

        //guardamos la Colección en una variable tipo arreglo
        Session::put('personalgastos',$personalgastos->toArray());

        return view('personal.gasto.reporte',compact('personalgastos'));
    }

    public function excel()
    {
        $datos = Session::get('personalgastos');
        return Excel::download(new PersonalGastosExport($datos),'Reporte_Gastos_Personal.xlsx');
    }
}
