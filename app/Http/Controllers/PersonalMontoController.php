<?php

namespace App\Http\Controllers;

use App\personalMonto;
use App\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonalMontoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:personalmontos.create')->only(['create','store']);
        $this->middleware('permission:personalmontos.index')->only('index');
        $this->middleware('permission:personalmontos.edit')->only(['edit','update']);
        $this->middleware('permission:personalmontos.show')->only('show');
        $this->middleware('permission:personalmontos.destroy')->only('destroy');
    }

    public function index()
    {
        $condicion = array(
            array('ru.role_id','=',4)
        );

        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
 
        foreach($roles as $role){
            $role_name = $role->name;
        }

        $personal = personal::all();
        
        if($personal->count() >0){
            $personalMontos = DB::table('personals as p')
            ->join('personal_montos as pm','p.id','=','pm.personal_id')
            ->join('role_user as ru','p.user_id','=','ru.user_id')
            ->select('p.id',DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS nombres"),
                    DB::raw('SUM(monto_asignado) as total_asignado'),
                    DB::raw('SUM(monto_saldo) as total_saldo'))
            ->where($condicion)
            ->groupBy('p.id','p.apellidos','p.nombres')
            ->get();
        }
       else{
        $personalMontos = null;
       }

        // = personalMonto::all();

        return view('prestamo.personalMonto.index',compact('personalMontos','personal','role_name'));
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

        return view('prestamo.personalMonto.create', compact('estadoform','personals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $personal = new personalMonto();
        $personal->personal_id = $request->personal_id;
        $personal->monto_asignado = $request->monto_asignado;
        $personal->monto_saldo = $request->monto_asignado;
        $personal->fecha = Carbon::now();
        $personal->consumido = 0;
        $personal->orden = 1;
        $personal->asignado_por = Auth::id();

        $personal->save();
    }

    public function show($id)
    {
        $personal = personal::findOrFail($id);
        $personalmontos = personalMonto::where('personal_id','=',$personal->id)
                                        ->orderBy('fecha','DESC')
                                        ->get();
        return view('prestamo.personalMonto.show',compact('personal','personalmontos'));
    }

    public function edit($id)
    {
        $personal = personal::findOrFail($id);
        $personalmontos = personalMonto::where('personal_id','=',$personal->id)
                                        ->orderBy('fecha','DESC')
                                        ->get();
        return view('prestamo.personalMonto.edit',compact('personal','personalmontos'));
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
        $personalMonto = personalMonto::findOrFail($request->id);

        $personalMonto->personal_id = $request->personal_id;
        $personalMonto->monto_asignado = $request->monto_asignado;
        $personalMonto->monto_saldo = $request->monto_saldo;
        $personalMonto->fecha = $request->fecha;
        $personalMonto->consumido = $request->consumido;
        $personalMonto->save();

        return $personalMonto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\personalMonto  $personalMonto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personalMonto = personalMonto::findOrFail($id);
        $personalMonto->delete();
        return $personalMonto;
    }

    public function table()
    {
        //
    }

    public function editarMontos($id){

        $estadoform = "edit";
        
        $personalmonto = personalMonto::where('id','=',$id)->first();

        $personal = Personal::where('id','=',$personalmonto->personal_id)->first();
        
        $estados = [
            '0' => 'Disponible',
            '1' => 'Consumido'
        ];
        //print_r($personalmontos);
        return view('prestamo.personalMonto.editarmonto',compact('personalmonto','personal','estadoform','estados'));
    }

    public function updateMonto(Request $request,$id){

       
    }
}
