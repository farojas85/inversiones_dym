<?php

namespace App\Http\Controllers;

use App\Cobranza;
use App\Prestamo;
use Illuminate\Http\Request;

class CobranzaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:cobranzas.create')->only(['create','store']);
        $this->middleware('permission:cobranzas.index')->only('index');
        $this->middleware('permission:cobranzas.edit')->only(['edit','update']);
        $this->middleware('permission:cobranzas.show')->only('show');
        $this->middleware('permission:cobranzas.destroy')->only('destroy');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        //Guardamos la Cobranza

            $cobranza = new Cobranza;
            $cobranza->fecha = $request->fecha;
            $cobranza->prestamo_id = $request->prestamo_id;
            $cobranza->cantidad_cuotas = $request->cantidad_cuotas;
            $cobranza->monto = $request->monto;
            $cobranza->saldo = $request->saldo_nuevo;
            $cobranza->save();

        //Actualizamos el Estado del Préstamo
        $prestamo = Prestamo::findOrFail($request->prestamo_id);

        $prestamo->estado = ($request->saldo_nuevo == 0) ? 'Cancelado' : 'Pendiente';
        
        $prestamo->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cobranza  $cobranza
     * @return \Illuminate\Http\Response
     */
    public function show(Cobranza $cobranza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cobranza  $cobranza
     * @return \Illuminate\Http\Response
     */
    public function edit(Cobranza $cobranza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cobranza  $cobranza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cobranza $cobranza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cobranza  $cobranza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cobranza $cobranza)
    {
        //
    }
    public function nuevaCobranza($id,$minsaldo){
        $estadoform="create";
        return view('cobranza.create',compact('estadoform','id','minsaldo'));
    }

    public function tabla($prestamo_id){
        $cobranzas = Cobranza::where('prestamo_id',$prestamo_id)
                                ->orderBy('fecha','DESC')->get();
        return view('cobranza.tabla',compact('cobranzas'));
    }
}
