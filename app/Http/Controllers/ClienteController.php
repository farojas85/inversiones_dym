<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\personal;
use Illuminate\Http\Request;

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
        $clientes = Cliente::all();

        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->where('role_user.role_id','=',4)
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.id')
                                ->pluck('nombres','id');

        return view('prestamo.cliente.index',compact('clientes','personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadoform="create";
        return view('prestamo.cliente.create', compact('estadoform'));
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
        $cliente->estado = 'activo';

        $cliente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
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
        return view('prestamo.cliente.edit', compact('estadoform','cliente'));
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
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->estado = 'eliminado';

        $cliente->save();
    }
}
