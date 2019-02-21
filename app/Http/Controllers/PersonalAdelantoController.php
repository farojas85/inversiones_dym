<?php

namespace App\Http\Controllers;

use App\PersonalAdelanto;
use App\personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalAdelantoController extends Controller
{
    
    var $mes;
    public function __construct()
    {
        $this->middleware('permission:personaladelantos.create')->only(['create','store']);
        $this->middleware('permission:personaladelantos.index')->only('index');
        $this->middleware('permission:personaladelantos.edit')->only(['edit','update']);
        $this->middleware('permission:personaladelantos.show')->only('show');
        $this->middleware('permission:personaladelantos.destroy')->only('destroy');

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
        $personaladelantos = PersonalAdelanto::all();
        $meses = $this->mes;
        return view('personal.adelanto.index',compact('personaladelantos','meses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('personal.adelanto.create',compact('estadoform','personals','meses'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personal = new PersonalAdelanto();
        $personal->personal_id = $request->personal_id;
        $personal->motivo = $request->motivo;
        $personal->fecha = Carbon::now();
        $personal->monto = $request->monto;
        $personal->mes_adelanto = $request->mes_adelanto;
        $personal->save();

        return $personal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalAdelanto  $personalAdelanto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('personal.adelanto.show',compact('personalAdelanto'));
    }

    public function edit($id)
    {
        $estadoform="edit";
        $meses = $this->mes;

        $personals =  Personal::join('role_user','personals.user_id','=','role_user.user_id')
                                ->where('role_user.role_id','=',4)
                                ->select(
                                    DB::raw("CONCAT(personals.nombres,' ',personals.apellidos) AS nombres"),
                                    'personals.id')
                                ->pluck('nombres','id');
        
        $personalAdelanto = PersonalAdelanto::findOrFail($id);

        return view('personal.adelanto.edit',compact('estadoform','personalAdelanto','personals','meses'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalAdelanto  $personalAdelanto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personalAdelanto = PersonalAdelanto::findOrFail($id);
        $personalAdelanto->personal_id = $request->personal_id;
        $personalAdelanto->motivo = $request->motivo;
        $personalAdelanto->fecha = $request->fecha;
        $personalAdelanto->monto = $request->monto;
        $personalAdelanto->mes_adelanto = $request->mes_adelanto;
        $personalAdelanto->save();

        return $personalAdelanto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalAdelanto  $personalAdelanto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personalAdelanto = PersonalAdelanto::findOrFail($id);
        $personalAdelanto->delete();

        return $personalAdelanto;
    }
}
