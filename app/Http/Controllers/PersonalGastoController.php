<?php

namespace App\Http\Controllers;

use App\PersonalGasto;
use App\personal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalGastoController extends Controller
{
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
                            ->whereMonth('pg.fecha','=',date('m'))
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalGasto  $personalGasto
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalGasto $personalGasto)
    {
        return view('personal.gasto.show',compact('personalGasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalGasto  $personalGasto
     * @return \Illuminate\Http\Response
     */
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
         //El Personal
         $personals = personal::select('id',
                                    DB::raw("CONCAT(nombres,' ',apellidos) as personal"))
                                ->where('estado','=','activo')
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
}
