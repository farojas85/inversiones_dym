<?php

namespace App\Http\Controllers;

use App\personal;
use App\user;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Peru\Jne\Dni;
use Peru\Http\ContextClient;

class PersonalController extends Controller
{
    var $cs;
    public function __construct()
    {
        $this->middleware('permission:personals.create')->only(['create','store']);
        $this->middleware('permission:personals.index')->only('index');
        $this->middleware('permission:personals.edit')->only(['edit','update']);
        $this->middleware('permission:personals.show')->only('show');
        $this->middleware('permission:personals.destroy')->only('destroy');

        $this->cs = new Dni();
        $this->cs->setClient(new ContextClient());

    }
    public function index()
    {
        $personals = Personal::all();

        return view('personal.index',compact('personals'));
    }

    public function create()
    {
        $estadoform="create";
        $users = User::pluck('name','id');
        $tipodocumentos = TipoDocumento::pluck('descripcion','id');

        return view('personal.create', compact('estadoform','users','tipodocumentos'));
    }

    public function store(Request $request)
    {
        $personal = new Personal();
        $personal->tipo_documento_id = $request->tipo_documento_id;
        $personal->dni = $request->dni;
        $personal->apellidos = $request->apellidos;
        $personal->nombres = $request->nombres;
        $personal->telefono_fijo = $request->telefono_fijo;
        $personal->celular = $request->celular;
        $personal->licencia = $request->licencia;
        $personal->direccion = $request->direccion;
        $personal->user_id = $request->user_id;
        $personal->sueldo = $request->sueldo;
        $personal->estado = 'activo';

        $personal->save();

        return $personal;
    }

    public function show(personal $personal)
    {
        //
    }

    public function edit(personal $personal)
    {
        $estadoform="edit";
        $users = User::pluck('name','id');
        $tipodocumentos = TipoDocumento::pluck('descripcion','id');
        return view('personal.edit', compact('estadoform','personal','users','tipodocumentos'));
    }

    public function update(Request $request, personal $personal)
    {
        $personal->tipo_documento_id = $request->tipo_documento_id;
        $personal->dni = $request->dni;
        $personal->apellidos = $request->apellidos;
        $personal->nombres = $request->nombres;
        $personal->telefono_fijo = $request->telefono_fijo;
        $personal->celular = $request->celular;
        $personal->licencia = $request->licencia;
        $personal->direccion = $request->direccion;
        $personal->user_id = $request->user_id;
        $personal->sueldo = $request->sueldo;
        $personal->estado = $request->estado;

        $personal->save();

        return $personal;
    }

    public function destroy(personal $personal)
    {
        $personal->estado="eliminado";
        $personal->save();

        return $personal;
    }

    public function validarDni($dni){
        $person = $this->cs->get($dni);
        if ($person === false) {
            echo $cs->getError();
            exit();
        }

        return json_encode($person);
    }
}
