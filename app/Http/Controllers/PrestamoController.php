<?php

namespace App\Http\Controllers;

use App\Prestamo;
use App\Cliente;
use App\personal;
use App\personalMonto;
use App\Cobranza;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    var $tasas;
    var $personal_id;
    public function __construct()
    {
        $this->middleware('permission:prestamos.create')->only(['create','store']);
        $this->middleware('permission:prestamos.index')->only('index');
        $this->middleware('permission:prestamos.edit')->only(['edit','update']);
        $this->middleware('permission:prestamos.show')->only('show');
        $this->middleware('permission:prestamos.destroy')->only('destroy');
        $this->middleware('permission:clienteprestamoTable')->only('table');
        $this->tasas = array(
                '0.20' => '20%',
                '0.25' => '25%');

        ini_set('max_execution_time', 0);

    }
    public function index()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        //Obteneos los clientes de acuerdo al rol
        if($role_name == 'admin' || $role_name == 'master'){
            $prestamos = DB::table('prestamos as p')
                            ->leftJoin('cobranzas as c','p.id','=','c.prestamo_id')
                            ->join('clientes as cli','p.cliente_id','=','cli.id')
                            ->select(
                                    'p.id','p.cliente_id',
                                    DB::raw("CONCAT(cli.nombres,' ',cli.apellidos) as nombres"),
                                    'fecha_prestamo','p.monto','p.estado',
                                    DB::raw('MIN(c.saldo) as saldo')
                                )
                            ->groupBy('p.id','p.cliente_id','cli.apellidos','cli.nombres','fecha_prestamo',
                                    'p.monto','p.estado')
                            ->get();
        }
        else{

            $persona = personal::where('user_id','=',$user_id)->get()->first();

            $prestamos = DB::table('prestamos as p')
                            ->leftJoin('cobranzas as c','p.id','=','c.prestamo_id')
                            ->join('clientes as cli','p.cliente_id','=','cli.id')
                            ->join('cliente_personal as pc', 'cli.id','=','pc.cliente_id')
                            ->select(
                                    'p.id','p.cliente_id',
                                    DB::raw("CONCAT(cli.nombres,' ',cli.apellidos) as nombres"),
                                    'fecha_prestamo','p.monto','p.estado',
                                    DB::raw('MIN(c.saldo) as saldo')
                                )
                            ->where('pc.personal_id','=',$persona->id)
                            ->groupBy('p.id','p.cliente_id','cli.apellidos','cli.nombres','fecha_prestamo',
                                    'p.monto','p.estado')
                            ->get();
        }


        //
       
        //$prestamos = Prestamo::all();
        return view('prestamo.deuda.index',compact('prestamos','role_name'));

    }

    public function create()
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
            $clientes = Cliente::select( 
                            DB::raw("CONCAT(nombres,' ',apellidos) AS nombres"),'id')
                            ->pluck('nombres','id');
            $todo=1;
            $personal = null;
        }
        else{
            $personal = personal::where('user_id','=',$user_id)->get()->first();

            $clientes = DB::table('cliente_personal as cp')
                            ->join('personals as p','cp.personal_id', '=', 'p.id')
                            ->join('clientes as c' ,'cp.cliente_id','=', 'c.id')
                            ->select(
                                DB::raw("CONCAT(c.nombres,' ',c.apellidos) AS nombres"),
                                    'c.id'
                            )
                            ->where('cp.personal_id','=',$personal->id)
                            ->pluck('nombres','id');

            $personalmontos = PersonalMonto::where('personal_id','=',$personal->id)
                                            ->where('consumido','=',0)
                                            ->select(
                                                DB::raw('SUM(monto_asignado) as total_asignado'),
                                                DB::raw('SUM(monto_saldo) as total_saldo'))
                                            ->get()->first();
            $personmontos = PersonalMonto::where('personal_id','=',$personal->id)
                                        ->where('consumido','=',0)
                                        ->select('monto_saldo')
                                        ->get()->first();   
        }    

        $tasas = $this->tasas;
        $estadoform = 'create';

        return view('prestamo.deuda.create',compact('clientes','personal','role_name',
                                                    'personalmontos','tasas',
                                                'estadoform'));
    }

    public function store(Request $request)
    {
    
        $prestamo = new Prestamo;
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->tasa_interes = $request->tasa_interes;
        $prestamo->monto = $request->monto;
        $prestamo->dias = $request->dias;
        $prestamo->cuota = $request->cuota;
        $prestamo->estado = 'Generado';
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->fecha_vencimiento = \Carbon\Carbon::now();
        
       

        $condicion = array(
            array('personal_id','=',$request->personal_id),
            array('consumido','=',0)
        );

        $personalmonto = personalMonto::where($condicion)->get();

        $tempo = null;
        $i=0;
        foreach($personalmonto as $persmon){
            $tempo[$i] = array(
                'id' => $persmon->id,
                'monto_saldo' => $persmon->monto_saldo,
                'consumido' => $persmon->consumido
            );
            $i+=1; 
        }
        
        for($x=0;$x<count($tempo);$x++){
            if( $request->monto <= $tempo[$x]['monto_saldo'] ){
                $condicion2 = array(
                    array('id','=',$tempo[$x]['id']),
                    array('consumido','=',0)
                );
                $personalmonto2 = personalMonto::where($condicion2)->get()->first();
                $personalmonto2->monto_saldo = $personalmonto2->monto_saldo- $request->monto;

                if($personalmonto2->monto_saldo == 0)
                {   
                    $personalmonto2->consumido = 1;
                }

                $personalmonto2->save();

                break;
            }
            else if($request->monto > $tempo[$x]['monto_saldo']){
                $temp1 =  $request->monto - $tempo[$x]['monto_saldo'];
                $temp2 = $request->monto - $temp1;

                $condicion3 = array(
                    array('id','=',$tempo[$x]['id']),
                    array('consumido','=',0)
                );
                $personalmonto3 = personalMonto::where($condicion3)->get()->first();

                $personalmonto3->monto_saldo =  $personalmonto3->monto_saldo - $temp2;

                if($personalmonto3->monto_saldo == 0 )
                {
                    $personalmonto3->consumido = 1;
                }

                $personalmonto3->save();


                $condicion4 = array(
                    array('id','=',$tempo[$x+1]['id']),
                    array('consumido','=',0)
                );
                $personalmonto4 = personalMonto::where($condicion4)->get()->first();

                $personalmonto4->monto_saldo =  $personalmonto4->monto_saldo - $temp1;

                if($personalmonto4->monto_saldo == 0 )
                {
                    $personalmonto4->consumido = 1;
                }

                $personalmonto4->save();

                break;

            }
        }
        //Actualizamos el Saldo Disponible      
        

        //Guardamos el Préstamo
        $prestamo->save();

        return $personalmonto;
    
    }

    public function show(Prestamo $prestamo)
    {
        //
    }

    public function edit(Prestamo $prestamo)
    {
        //
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        //
    }

    public function destroy(Prestamo $prestamo)
    {
        //
    }

    public function mostrarCobranza($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $contarCobranza = Cobranza::where('prestamo_id',$id)->count();

        $minSaldo = $prestamo->monto;
        if($contarCobranza >0){
            $minSaldo = Cobranza::where('prestamo_id',$id)->min('saldo');
        }
                
        $cobranzas = Cobranza::where('prestamo_id',$prestamo->id)
                            ->orderBy('created_at','DESC')->get();

        return view('prestamo.deuda.mostrarCobranza',compact('prestamo','minSaldo','cobranzas'));
    }
}
