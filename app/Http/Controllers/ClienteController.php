<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\personal;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clientes.create')->only(['create','store']);
        $this->middleware('permission:clientes.index')->only('index');
        $this->middleware('permission:clientes.edit')->only(['edit','update']);
        $this->middleware('permission:clientes.show')->only('show');
        $this->middleware('permission:clientes.destroy')->only('destroy');
    }

    public function index()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
        foreach($roles as $role){
            $role_name = $role->name;
        }

        $todo = 0;
        //Obteneos los clientes de acuerdo al rol
        if($role_name == 'admin' || $role_name == 'master'){
            $clientes = DB::table('clientes as c')
                            ->leftJoin('prestamos as p','c.id','=','p.cliente_id')
                            ->leftJoin('cobranzas as co','p.id','=','co.prestamo_id')
                            ->join('cliente_personal as cp','c.id','=','cp.cliente_id')
                            ->join('personals as ps','cp.personal_id','=','ps.id')
                            ->select('c.id','c.apellidos as cli_apellidos','c.nombres as cli_nombres','c.direccion','c.estado',
                                'ps.apellidos as per_apellidos','ps.nombres as per_nombres',
                                DB::raw("MAX(co.fecha) as fecha_cobranza"))
                            ->where('p.estado', '<>','Cancelado')
                            ->groupBy('c.id','c.apellidos','c.nombres','c.direccion','c.estado',
                                        'ps.apellidos','ps.nombres')
                            ->orderBy('c.apellidos','ASC')
                            ->orderBy('c.nombres','ASC')
                            ->get();
            $todo=1;
        }
        else{
            $personal = personal::where('user_id','=',$user_id)->get();

            foreach($personal as $per)
            {
                $personal_id = $per->id;
            }
            $clientes = DB::table('cliente_personal as cp')
                            ->join('personals as ps','cp.personal_id', '=', 'ps.id')
                            ->join('clientes as c' ,'cp.cliente_id','=', 'c.id')
                            ->leftJoin('prestamos as p','c.id','=','p.cliente_id')
                            ->leftJoin('cobranzas as co','p.id','=','co.prestamo_id')
                            ->select('c.id','c.nombres as cli_nombre','c.apellidos as cli_apel','c.direccion',
                                        'ps.nombres as per_nombre','ps.apellidos as per_apel','c.estado',
                                        DB::raw("MAX(co.fecha) as fecha_cobranza")
                                )
                            ->where('cp.personal_id','=',$personal_id)
                            ->where('p.estado','<>','Cancelado' )
                            ->groupBy('c.id','c.apellidos','c.nombres','c.direccion',
                                        'ps.apellidos','ps.nombres','c.estado')
                            ->orderBy('c.apellidos','ASC')
                            ->orderBy('c.nombres','ASC')
                            ->get();
        }        

        return view('prestamo.cliente.index',compact('clientes','todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoform="create";


        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->where('role_user.role_id','=',4)
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.id')
                                ->pluck('nombres','id');

        $tipodocumentos = TipoDocumento::pluck('descripcion','id');

        return view('prestamo.cliente.create', compact('estadoform','personals','tipodocumentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->tipo_documento_id = $request->tipo_documento_id;
        $cliente->dni = $request->dni;
        $cliente->ruc = $request->ruc;
        $cliente->apellidos = $request->apellidos;
        $cliente->nombres = $request->nombres;
        $cliente->razon_social = $request->razon_social;
        $cliente->telefono_fijo = $request->telefono_fijo;
        $cliente->celular = $request->celular;
        $cliente->correo = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->nro_referencia = $request->nro_referencia;
        $cliente->tipo ='bueno';
        $cliente->estado = 'activo';

        $cliente->save();

        $cliente->personals()->attach($request->personal_id);

        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {   
        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                            ->where('role_user.role_id','=',4)
                            ->select(
                                DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                'personals.id')
                            ->pluck('nombres','id');
        return view('prestamo.cliente.show', compact('estadoform','cliente','personals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $estadoform="create";

        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->where('role_user.role_id','=',4)
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.id')
                                ->pluck('nombres','id');

        $tipodocumentos = TipoDocumento::pluck('descripcion','id');


        return view('prestamo.cliente.edit', compact('estadoform','cliente','personals','tipodocumentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->tipo_documento_id = $request->tipo_documento_id;
        $cliente->dni = $request->dni;
        $cliente->ruc = $request->ruc;
        $cliente->apellidos = $request->apellidos;
        $cliente->nombres = $request->nombres;
        $cliente->razon_social = $request->razon_social;
        $cliente->telefono_fijo = $request->telefono_fijo;
        $cliente->celular = $request->celular;
        $cliente->correo = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->nro_referencia = $request->nro_referencia;
        $cliente->estado = $request->estado;

        $cliente->save();

        if($request->personal_actual != 0){
            if($request->personal_actual != $request->personal_id){
                $cliente->personals()->detach($request->personal_actual);
                $cliente->personals()->attach($request->personal_id);
            }
        }
        else if($request->personal_actual == 0)
        {
            $cliente->personals()->attach($request->personal_id);
        }

        return $cliente;
    }

    public function destroy(Cliente $cliente)
    {
        $personal = DB::table('cliente_personal')
                        ->where('cliente_id',$cliente->id)
                        ->first();
                        
        $cliente->personals()->detach($personal->id);

        $cliente->delete();

        return $cliente;
    }

    public function gmap(Cliente $cliente){
        return view('prestamo.cliente.gmap',compact('cliente'));
    }
}
