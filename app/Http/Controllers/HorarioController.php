<?php

namespace App\Http\Controllers;

use App\Horario;
use App\User;
use App\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:horarios.create')->only(['create','store']);
        $this->middleware('permission:horarios.index')->only('index');
        $this->middleware('permission:horarios.edit')->only(['edit','update']);
        $this->middleware('permission:horarios.show')->only('show');
        $this->middleware('permission:horarios.destroy')->only('destroy');
    }


    public function index()
    {
        $horarios = Horario::all();
        return view('configuraciones.horario.index',compact('horarios'));
    }

    public function create()
    {
        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.user_id')
                                ->pluck('nombres','personals.user_id');
        $estadoform = "create";
        return view('configuraciones.horario.create',compact('estadoform','personals'));
    }

    public function store(Request $request)
    {
        $horario = new Horario();
        $horario->user_id = $request->user_id;
        $horario->hora_inicio = $request->hora_inicio;
        $horario->hora_fin = $request->hora_fin;
        $horario->dias = $request->dias;

        $horario->save();

        return $horario;
        
    }

    public function show(Horario $horario)
    {
        //
    }

    public function edit(Horario $horario)
    {
        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.user_id')
                                ->pluck('nombres','personals.user_id');
        $estadoform = "edit";
        return view('configuraciones.horario.edit',compact('estadoform','personals','horario'));
    }

    public function update(Request $request,$id)
    {
        $horario = Horario::findOrFail($id);

        $horario->user_id = $request->user_id;
        $horario->hora_inicio = $request->hora_inicio;
        $horario->hora_fin = $request->hora_fin;
        $horario->dias = $request->dias;

        $horario->save();

        return $horario;
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return $horario;
    }

    public function table()
    {
        $horarios = Horario::all();
        return  view('configuraciones.horario.table',compact('horarios'));
    }
}
