<?php

namespace App\Http\Controllers;

use App\PersonalSalario;
use App\personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalSalarioController extends Controller
{
    var $mes;
    public function __construct()
    {
        $this->middleware('permission:personalsalarios.create')->only(['create','store']);
        $this->middleware('permission:personalsalarios.index')->only('index');
        $this->middleware('permission:personalsalarios.edit')->only(['edit','update']);
        $this->middleware('permission:personalsalarios.show')->only('show');
        $this->middleware('permission:personalsalarios.destroy')->only('destroy');
        $this->middleware('permission:salariosTable')->only('table');

       $this->mes = array(
           '01' =>'Enero',
           '02' =>'Febrero',
           '03' =>'Marzo',
           '04' =>'Abril',
           '05' =>'Mayo',
           '06' =>'Junio',
           '07' =>'Julio',
           '08' =>'Agosto',
           '09' =>'Setiembre',
           '10' =>'Octubre',
           '11' =>'Noviembre',
           '12' =>'Diciembre'    
       );

    }

    public function index()
    {
        $personalSalarios = PersonalSalario::all();
        return view('personal.salario.index',compact('personalSalarios'));
    }

    public function create()
    {
        $estadoform="create";
        $meses = $this->mes;

        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->where('role_user.role_id','=',4)
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.id')
                                ->pluck('nombres','id');

        return view('personal.salario.create',compact('estadoform','personals','meses'));
    }

    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalSalario  $personalSalario
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalSalario $personalSalario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalSalario  $personalSalario
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalSalario $personalSalario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalSalario  $personalSalario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalSalario $personalSalario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalSalario  $personalSalario
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalSalario $personalSalario)
    {
        //
    }

    public function table()
    {

    }

    public function sueldoPersonal($id)
    {
        $personal = personal::findOrFail($id);

        $sueldo = $personal->sueldo;

        return view('personal.salario.form_sueldo',compact('sueldo'));
    }
}
