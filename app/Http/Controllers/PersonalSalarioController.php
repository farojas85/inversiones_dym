<?php

namespace App\Http\Controllers;

use App\PersonalSalario;
use App\PersonalAdelanto;
use App\personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

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
        $meses = $this->mes;
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
        $personalSalario = new PersonalSalario;
        $personalSalario->personal_id = $request->personal_id;
        $personalSalario->fecha= $request->fecha;
        $personalSalario->sueldo = $request->sueldo;
        $personalSalario->adelantos = $request->adelantos;
        $personalSalario->mes_pago =$request->mes_pago;

        $personalSalario->save();

        /*$condicion = array(
            array('personal_id','=',$request->personal_id),
            array('fecha','=',$request->fecha),
            array('mes_pago','=',$request->mes_pago)
        );
        $personals = PersonalSalario::where($condicion)->get();*/
        return $personalSalario;        
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

    public function sueldoPersonal(Request $request){
        $personal = personal::findOrFail($request->personal_id);

        return $personal->toJson(JSON_PRETTY_PRINT);
    }

    public function adelantosPersonal(Request $request){
        $condicion = array(
            array('personal_id',$request->personal_id),
            array('mes_adelanto',$request->mes_pago)
        );

        $adelantos = DB::table('personal_adelantos')
                            ->select(DB::raw('SUM(monto) as adelantos'))
                            ->where($condicion)
                            ->get();
        return $adelantos->toJson(JSON_PRETTY_PRINT);
    }

    public function tableAdelantosPersonal(Request $request){
        $condicion = array(
            array('personal_id',$request->personal_id),
            array('mes_adelanto',$request->mes_pago)
        );

        $adelantos =PersonalAdelanto::select('fecha','motivo','monto')
                            ->where($condicion)
                            ->get();
        return view('personal.salario.form_adelantos',compact('adelantos'));
    }
    public function pdf() 
    {
        $personalSalario = PersonalSalario::latest()->first();
        return view('personal.salario.pagos_pdf',compact('personalSalario'));
    }

}
