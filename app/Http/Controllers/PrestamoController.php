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
                '0.10' =>'10%',
                '0.15' => '15%',
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
                                    'fecha_prestamo',
                                    DB::raw('(p.monto + p.monto*p.tasa_interes) as monto'),
                                    'p.estado',
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
                                    'fecha_prestamo',
                                    DB::raw('(p.monto + p.monto*p.tasa_interes) as monto'),
                                    'p.estado',
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
        $prestamo->delete();

        return $prestamo;
    }

    public function mostrarCobranza($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $contarCobranza = Cobranza::where('prestamo_id',$id)->count();

        $minSaldo = ($prestamo->monto + $prestamo->monto*$prestamo->tasa_interes);
        if($contarCobranza >0){
            $minSaldo = Cobranza::where('prestamo_id',$id)->min('saldo');
        }
                
        $cobranzas = Cobranza::where('prestamo_id',$prestamo->id)
                            ->orderBy('created_at','DESC')->get();

        return view('prestamo.deuda.mostrarCobranza',compact('prestamo','minSaldo','cobranzas'));
    }

    public function rangoFechas($tipo_busqueda){
        $meses = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Setiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );
        return view('prestamo.deuda.rangofechas',compact('tipo_busqueda','meses'));
    }
    public function reporte()
    {
         //Obtenemos Id del Usuatio
         $user_id = Auth::user()->id;
         $roles = Auth::user()->roles;
 
         foreach($roles as $role){
             $role_name = $role->name;
         }

        $tipos = array(
            "01" => 'Diaria',
            "02" => 'Mensual',
            "03" => 'Anual'
        );
         //Obteneos los clientes de acuerdo al rol
        if($role_name == 'admin' || $role_name == 'master'){
            $personals = DB::table('personals as p')
                            ->join('role_user as ru' ,'p.user_id','=','ru.user_id')
                            ->join('roles as r','ru.role_id','=','r.id')
                            ->select(
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS nombres"),
                                    'p.id')
                            ->where('r.name','cobrador')
                            ->pluck('nombres','p.id');
            $prestamo_count = Prestamo::count();
        }
        else{
            $personals = personal::select(DB::raw("CONCAT(nombres,' ',apellidos) AS nombres"),
                                        'id')
                                ->where('user_id','=',$user_id)
                                ->pluck('nombres','id');

            $prestamo_count = DB::table('prestamos as pr')
                                    ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                    ->join('personals as p','cp.personal_id','=','p.id')
                                    ->where('p.user_id',$user_id)
                                    ->count('pr.id');
                                
        }

        if($prestamo_count == 0){
            return 0;
        }
        else {
            return view('prestamo.deuda.reporte',compact('tipos','personals','role_name'));            
        }
    }

    public function prestamoDia(Request $request){

        if($request->personal_id == "%"){
            $personals = DB::table('prestamos as pr')
                            ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                            ->join('personals as p','cp.personal_id','=','p.id')
                            ->select(
                                DB::raw('DISTINCT(p.id)'),
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) as nombres"))
                            ->where('fecha_prestamo','>=',$request->fecha_ini)
                            ->where('fecha_prestamo','<=',$request->fecha_fin)
                            ->orderBy('p.id','ASC')
                            ->get();
            $like_condicion = $request->personal_id;
        }
        else{
            $personals = personal::where('id',$request->personal_id)
                                    ->orderBy('id','asc')->get();
            $like_condicion = '%'.$request->personal_id.'%';
        }
        $prestamos = null;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        $prestamos = DB::table('prestamos as pr')
                        ->join('cliente_personal  as cp','pr.cliente_id', '=', 'cp.cliente_id')
                        ->join('personals as p','cp.personal_id','=','p.id')
                        ->join('clientes as c','cp.cliente_id','=','c.id')
                        ->select('pr.id','fecha_prestamo',
                                DB::raw("CONCAT(c.nombres,' ',c.apellidos) as cliente"),
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) as personal"),
                                'monto',
                                DB::raw('(monto*tasa_interes) as interes'),
                                DB::raw('(monto + monto*tasa_interes) as total'))
                        ->where('fecha_prestamo','>=',$fecha_ini)
                        ->where('fecha_prestamo','<=',$fecha_fin)
                        ->where('p.id','like',$like_condicion)
                        ->get();

        return view('prestamo.deuda.resultado',compact('personals','prestamos','request'));
    }

    public function prestamoMes(Request $request){

        $prestamos = null;
        $mes_ini = $request->mes_ini;
        $mes_fin = $request->mes_fin;

        if($request->personal_id == "%"){            
            $prestamos = DB::table('prestamos as pr')
                            ->join('cliente_personal  as cp','pr.cliente_id', '=', 'cp.cliente_id')
                            ->join('personals as p','cp.personal_id','=','p.id')
                            ->join('clientes as c','cp.cliente_id','=','c.id')
                            ->select(
                                    DB::raw("MONTH(fecha_prestamo) as mes"),
                                    DB::raw("CONCAT(p.nombres,' ',p.apellidos) as personal"),
                                    DB::raw('SUM(monto + monto*tasa_interes) as total'))
                            ->where(DB::raw("MONTH(fecha_prestamo)"),'>=',$mes_ini)
                            ->where(DB::raw("MONTH(fecha_prestamo)"),'<=',$mes_fin)
                            ->groupBy(DB::raw('MONTH(fecha_prestamo)'),'p.nombres','p.apellidos')
                            ->orderByRaw('mes ASC, personal ASC')
                            ->get();            
        }
        else{
            $prestamos = DB::table('prestamos as pr')
                            ->join('cliente_personal  as cp','pr.cliente_id', '=', 'cp.cliente_id')
                            ->join('personals as p','cp.personal_id','=','p.id')
                            ->join('clientes as c','cp.cliente_id','=','c.id')
                            ->select(
                                    DB::raw("MONTH(fecha_prestamo) as mes"),
                                    DB::raw("CONCAT(p.nombres,' ',p.apellidos) as personal"),
                                    DB::raw('SUM(monto + monto*tasa_interes) as total'))
                            ->where(DB::raw("MONTH(fecha_prestamo)"),'>=',$mes_ini)
                            ->where(DB::raw("MONTH(fecha_prestamo)"),'<=',$mes_fin)
                            ->where('p.id',$request->personal_id)
                            ->groupBy(DB::raw('MONTH(fecha_prestamo)'),'p.nombres','p.apellidos')
                            ->orderByRaw('mes ASC, personal ASC')
                            ->get();
        }       

        return view('prestamo.deuda.resultado',compact('prestamos','request'));
    }

    public function reporteCobranza()
    {
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        $tipos = array(
            "01" => 'Diaria',
            "02" => 'Mensual',
            "03" => 'Anual'
        );
       
         //Obteneos los clientes de acuerdo al rol
         if($role_name == 'admin' || $role_name == 'master'){
            $personals = DB::table('personals as p')
                            ->join('role_user as ru' ,'p.user_id','=','ru.user_id')
                            ->join('roles as r','ru.role_id','=','r.id')
                            ->select(
                                DB::raw("CONCAT(p.nombres,' ',p.apellidos) AS nombres"),
                                    'p.id')
                            ->where('r.name','cobrador')
                            ->pluck('nombres','p.id');
            $prestamo_count = Prestamo::count();
        }
        else{
            $personals = personal::select(DB::raw("CONCAT(nombres,' ',apellidos) AS nombres"),
                                        'id')
                                ->where('user_id','=',$user_id)
                                ->pluck('nombres','id');

            $prestamo_count = DB::table('prestamos as pr')
                                    ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                                    ->join('personals as p','cp.personal_id','=','p.id')
                                    ->where('p.user_id',$user_id)
                                    ->count('pr.id');
                                
        }

        if($prestamo_count == 0){
            return 0;
        }
        else {
            return view('prestamo.deuda.busquedaCobranza',compact('tipos','personals','role_name'));
        }
    }

    public function cobranzaDia(Request $request){
        if($request->personal_id == "%"){
            $like_condicion = $request->personal_id;
        }
        else{
            $like_condicion = '%'.$request->personal_id.'%';
        }

        $cobranzas = null;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        $cobranzas = DB::table('cobranzas as co')
                        ->join('prestamos as pr','co.prestamo_id','=','pr.id')
                        ->join('cliente_personal as cp', 'pr.cliente_id', '=', 'cp.cliente_id')
                        ->join('personals as p','cp.personal_id','=','p.id')
                        ->join('clientes as c','cp.cliente_id', '=', 'c.id')
                        ->select('co.id','co.fecha',
                            DB::raw("concat(p.nombres,' ',p.apellidos) as personal"),
                            DB::raw("concat(c.nombres,' ',c.apellidos) as cliente"),
                            'cantidad_cuotas','co.monto')
                        ->where('co.fecha','>=',$fecha_ini)
                        ->where('co.fecha','<=',$fecha_fin)
                        ->where('p.id','like',$like_condicion)
                        ->get();

        return view('prestamo.deuda.resultadoCobranza',compact('request','cobranzas'));
    }

    public function cobranzaMes(Request $request){
        $cobranzas = null;
        $mes_ini = $request->mes_ini;
        $mes_fin = $request->mes_fin;

        if($request->personal_id == "%"){
            $like_condicion = $request->personal_id;
            $cobranzas = DB::table('cobranzas as co') 
                        ->join('prestamos as pr','co.prestamo_id','=','pr.id')
                        ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                        ->join('personals as p','cp.personal_id','=','p.id')
                        ->select(
                            DB::raw("MONTH(co.fecha) as mes"),
                            DB::raw("concat(p.nombres,' ',p.apellidos) as personal"),
                            DB::raw("sum(co.monto) as total"))
                        ->where(DB::raw('MONTH(co.fecha)'),'>=',$mes_ini)
                        ->where(DB::raw("MONTH(co.fecha)"),'<=',$mes_fin)
                        ->groupBy(DB::raw('MONTH(co.fecha)'),'personal')
                        ->get();
        }
        else{
            $like_condicion = '%'.$request->personal_id.'%';
            $cobranzas = DB::table('cobranzas as co') 
                        ->join('prestamos as pr','co.prestamo_id','=','pr.id')
                        ->join('cliente_personal as cp','pr.cliente_id','=','cp.cliente_id')
                        ->join('personals as p','cp.personal_id','=','p.id')
                        ->select(
                            DB::raw("MONTH(co.fecha) as mes"),
                            DB::raw("concat(p.nombres,' ',p.apellidos) as personal"),
                            DB::raw("sum(co.monto) as total"))
                        ->where(DB::raw('MONTH(co.fecha)'),'>=',$mes_ini)
                        ->where(DB::raw("MONTH(co.fecha)"),'<=',$mes_fin)
                        ->where('p.id','=',$request->personal_id)
                        ->groupBy(DB::raw('MONTH(co.fecha)'),'personal')
                        ->get();
        }

        
        return view('prestamo.deuda.resultadoCobranza',compact('request','cobranzas'));
    }
}
