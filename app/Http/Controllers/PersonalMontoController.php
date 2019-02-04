<?php

namespace App\Http\Controllers;

use App\personalMonto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalMontoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:personalmontos.create')->only(['create','store']);
        $this->middleware('permission:personalmontos.index')->only('index');
        $this->middleware('permission:personalmontos.edit')->only(['edit','update']);
        $this->middleware('permission:personalmontos.show')->only('show');
        $this->middleware('permission:personalmontos.destroy')->only('destroy');
        $this->middleware('permission:personalmontoTable')->only('table');
    }

    public function index()
    {
        $condicion = array(
            array('ru.role_id','=',4),
            array('pm.consumido','<>',1)
        );
        $personalMontos = DB::table('personals as p')
                            ->join('personal_montos as pm','p.id','=','pm.personal_id')
                            ->join('role_user as ru','p.user_id','=','ru.user_id')
                            ->select('p.id',DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS nombres"),
                                    DB::raw('SUM(monto_asignado) as total_asignado'),
                                    DB::raw('SUM(monto_saldo) as total_saldo'))
                            ->where($condicion)
                            ->groupBy('p.id','nombres')
                            ->get();

        //$personalMontos = personalMonto::all();

        return view('prestamo.personalMonto.index',compact('personalMontos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\personalMonto  $personalMonto
     * @return \Illuminate\Http\Response
     */
    public function show(personalMonto $personalMonto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\personalMonto  $personalMonto
     * @return \Illuminate\Http\Response
     */
    public function edit(personalMonto $personalMonto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\personalMonto  $personalMonto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, personalMonto $personalMonto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\personalMonto  $personalMonto
     * @return \Illuminate\Http\Response
     */
    public function destroy(personalMonto $personalMonto)
    {
        //
    }

    public function table()
    {
        //
    }
}
