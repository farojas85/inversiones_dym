<?php

namespace App\Http\Controllers;

use App\Cobranza;
use App\Prestamo;
use App\Cliente;
use App\personal;
use App\personalMonto;
use Fpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


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
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }
        //Guardamos la Cobranza

            $cobranza = new Cobranza;
            $cobranza->fecha = ($role_name == 'cobrador') ? Carbon::now()->format('Y-m-d'):  $request->fecha;
            //$cobranza->fecha = $request->fecha;
            //$cobranza->fecha = Carbon::now()->format('Y-m-d');
            $cobranza->prestamo_id = $request->prestamo_id;
            $cobranza->cantidad_cuotas = $request->cantidad_cuotas;
            $cobranza->monto = $request->monto;
            $cobranza->saldo = $request->saldo_nuevo;
            $cobranza->serie = $request->serie;
            $cobranza->numero = $request->numero;
            $cobranza->pagado = $request->pagado;
            $cobranza->vuelto = $request->vuelto;
            $cobranza->save();

        $prestamo = Prestamo::where('id','=',$request->prestamo_id)->first();
        $cliente_id = $prestamo->cliente_id;

        $personal_cliente = DB::table('cliente_personal')
                                ->where('cliente_id','=',$cliente_id)
                                ->first();
        $personal_id = $personal_cliente->personal_id;

        $personaMontos = personalMonto::where('personal_id','=',$personal_id)
                                        ->orderBy('created_at','DESC')
                                        ->get();

        //guardamos los montos saldos del personal
        $tempo = null;
        $i=0;
        foreach($personaMontos as $persmonto)
        {
            $tempo[$i] = array(
                'id' => $persmonto->id,
                'monto_asignado' => $persmonto->monto_asignado,
                'monto_saldo' => $persmonto->monto_saldo,
                'consumido' => $persmonto->consumido
            );
            $i+=1;
        }

        //RECORREMOS LOS MONTOS SALDOS
        for($x=0;$x<count($tempo);$x++){
            if($tempo[$x]['monto_saldo'] == 0) {
                $condicion2 = array(
                    array('id','=',$tempo[$x]['id']),
                    array('consumido','=',1)
                );
                $permonto2 = personalMonto::where($condicion2)->first();
                $permonto2->monto_saldo += $request->monto;
                $permonto2->consumido = 0;
                $permonto2->save();
                break;
            }
            if($tempo[$x]['monto_saldo'] >0 && $tempo[$x]['monto_saldo'] <= $tempo[$x]['monto_asignado'])
            {
                $condicion2 = array(
                    array('id','=',$tempo[$x]['id']),
                    array('consumido','=',0)
                );
                $permonto2 = personalMonto::where($condicion2)->first();
                $permonto2->monto_saldo += $request->monto;

                if($permonto2->monto_saldo > $permonto2->monto_asignado)
                {
                    $monto1 =  $permonto2->monto_saldo - $permonto2->monto_asignado;
                    //$monto2 = $permonto2->monto_asignado;
                    $permonto2->monto_saldo =  $permonto2->monto_asignado;
                    $permonto2->save();

                    $permonto3 = personalMonto::where('id','=',$tempo[$x+1]['id'])->first();
                    if($permonto3->monto_saldo == 0){
                        $permonto3->consumido = 0;
                    }
                    $permonto3->monto_saldo += $monto1;

                    $permonto3->save();
                }
                else{
                    $permonto2->save();
                }
                break;
            }
            else if($tempo[$x]['monto_saldo'] > $tempo[$x]['monto_asignado'])
            {
                $permonto3 = personalMonto::where('id','=',$tempo[$x]['id'])->first();
                if($permonto3->monto_saldo == 0){
                    $permonto3->consumido = 0;
                }
                $permonto3->monto_saldo += $request->monto;

                $permonto3->save();

                break;
            }
        }
        //$personalMonto =  personalMonto::where
        //Actualizamos el Estado del Préstamo
        $prestamo = Prestamo::findOrFail($request->prestamo_id);

        $prestamo->estado = ($request->saldo_nuevo == 0) ? 'Cancelado' : 'Pendiente';

        $prestamo->save();

        return $cobranza;

    }

    public function show(Cobranza $cobranza)
    {
        return view('cobranza.show', compact('cobranza'));
    }

    public function edit(Cobranza $cobranza)
    {
        //
    }


    public function update(Request $request, Cobranza $cobranza)
    {
        //Guardamos la Cobranza
        //$cobranza->fecha = Carbon::now()->format('Y-m-d');
        //$cobranza->fecha = $request->fecha;
        $monto_actual = $cobranza->monto;
        $cobranza->fecha = ($role_name == 'cobrador') ? Carbon::now()->format('Y-m-d'):  $request->fecha;
        $cobranza->prestamo_id = $request->prestamo_id;
        $cobranza->cantidad_cuotas = $request->cantidad_cuotas;
        $cobranza->monto = $request->monto;
        $cobranza->saldo = $request->saldo_nuevo;
        $cobranza->serie = $request->serie;
        $cobranza->numero = $request->numero;
        $cobranza->pagado = $request->pagado;
        $cobranza->vuelto = $request->vuelto;
        $cobranza->save();

        //Actualizamos el Estado del Préstamo
        $prestamo = Prestamo::findOrFail($request->prestamo_id);

        $prestamo->estado = ($request->saldo_nuevo == 0) ? 'Cancelado' : 'Pendiente';

        $prestamo->save();


        return $cobranza;
    }


    public function destroy(Cobranza $cobranza)
    {
        //OBTENEMOS DATOS DEL PRÉSTAMO DE LA COBRANZA
        $cobro_hoy = new Cobranza;
        $cobro_hoy = $cobranza;
        $cobro_hoy_monto = $cobranza->monto;
        $prestamo = Prestamo::findOrFail($cobranza->prestamo_id);
        //ELIMINAMOS LA COBRANZA
        $cobranza->delete();
        //OBTENEMOS LA CANTIDAD DE COBRANZAS
        $contar_cobranza_prestamo = Cobranza::where('prestamo_id',$prestamo->id)->count();  
        //OBTENEMOS LA ÚLTIMA COBRANZA
        $ultima_cobranza = Cobranza::where('prestamo_id',$prestamo->id)
                                        ->orderBy('created_at','DESC')
                                        ->first();
        //MODIFICAMOS LOS CAMPOS DEL PRESTAMO
        if($prestamo->estado == 'Cancelado' && $contar_cobranza_prestamo >0){
            $prestamo->estado = 'Pendiente';
        }
        else if($prestamo->estado == 'Pendiente' && $contar_cobranza_prestamo == 0 ){
            $prestamo->estado = "Generado";
        }
        //----------------
        $prestamo->save();

        //Actualizamos el monto Asignado
        $cliente_id = $prestamo->cliente_id;

        $personal_cliente = DB::table('cliente_personal')
                                ->where('cliente_id','=',$cliente_id)
                                ->first();
        $personal_id = $personal_cliente->personal_id;

        $condicion = array(
            array('personal_id','=',$personal_id),
            array('consumido','=',0)
        );

        $personalmonto = personalMonto::where($condicion)->get();

        $personalmontos = PersonalMonto::where('personal_id','=',$personal_id)
                                            ->where('consumido','=',0)
                                            ->select(
                                                DB::raw('SUM(monto_asignado) as total_asignado'),
                                                DB::raw('SUM(monto_saldo) as total_saldo'))
                                            ->get()->first();
        $monto_saldo = $personalmontos->total_saldo ;

        if( $monto_saldo === 0 || $monto_saldo === '' || $monto_saldo === null)
        {
            return 0;
        }
        else{
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
                if( $cobro_hoy_monto <= $tempo[$x]['monto_saldo'] ){
                    $condicion2 = array(
                        array('id','=',$tempo[$x]['id']),
                        array('consumido','=',0)
                    );
                    $personalmonto2 = personalMonto::where($condicion2)->get()->first();
                    $personalmonto2->monto_saldo = $personalmonto2->monto_saldo- $cobro_hoy_monto;

                    if($personalmonto2->monto_saldo == 0)
                    {
                        $personalmonto2->consumido = 1;
                    }

                    $personalmonto2->save();

                    break;
                }
                else if($cobro_hoy_monto > $tempo[$x]['monto_saldo']){
                    $temp1 =  $cobro_hoy_monto - $tempo[$x]['monto_saldo'];
                    $temp2 = $cobro_hoy_monto - $temp1;

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
        }
        return $cobranza;
    }

    public function nuevaCobranza($id,$minsaldo,$cuota){
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;

        foreach($roles as $role){
            $role_name = $role->name;
        }

        $estadoform="create";

        //Obtenemos el máximo según la serie
        $max_id = Cobranza::where('serie','=','B001')->max('numero');

        if($max_id == null || $max_id == ''){
            $max_num = 1;
        }
        else{
            $max_num = $max_id + 1;
        }
        return view('cobranza.create',compact('estadoform','id','minsaldo','cuota','max_num','max_id','role_name'));
    }

    public function editarCobranza(Request $request){

        $estadoform="edit";
        $prestamo_id =$request->prestamo_id;
        $minsaldo = $request->minsaldo;
        $cuota = $request->cuota;
 
        $cobranza = Cobranza::findOrFail($request->cobranza_id);
        return view('cobranza.edit',compact('estadoform','prestamo_id','minsaldo','cuota','cobranza'));
    }

    public function obtenerCobranzas(Request $request){
        //Obtenemos Id del Usuatio
        $user_id = Auth::user()->id;
        $roles = Auth::user()->roles;
        $role_name="";
        foreach($roles as $role){
            $role_name = $role->name;
        }

        $condiciones = [
            array('prestamo_id','=',$request->prestamo_id),
            array('fecha','=',Carbon::now()->format('Y-m-d'))
        ];
        $nrocobros = Cobranza::where($condiciones)->count();

        $data = [
            'role_name'=>$role_name,
            'nrocobros'=>$nrocobros
        ];
        return response()->json($data);
    }
    public function tabla($prestamo_id){

        $cobranzas = Cobranza::where('prestamo_id',$prestamo_id)
                                ->orderBy('created_at','DESC')->get();


        return view('cobranza.tabla',compact('cobranzas'));
    }

    public function generaPdf(Cobranza $cobranza)
    {
        Fpdf::AddPage('P','A7');
        Fpdf::SetTitle('Boleta Cobranza');
        Fpdf::Image('assets/images/logo_dark.png',5,4,30);
        //Establecemos el Encabezado  de la serie y Número
        Fpdf::SetFont('Courier', 'B', 7);
        Fpdf::setXY(40,3);
        Fpdf::setFillColor(220,220,220);
        Fpdf::Cell(30, 5, 'BOLETA DE COBRANZA',1,1,'C',1);
        Fpdf::setFillColor(255,255,255);
        Fpdf::setXY(40,8);
        Fpdf::Cell(30, 5, $cobranza->serie."-".$cobranza->numero,1,1,'C',1);

        Fpdf::SetFont('Courier', '', 7);
        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,15,70,15);
        Fpdf::setXY(4,16);
        Fpdf::setDash(0,0);

        //FECHA COBRANZA
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,16);
        Fpdf::Cell(20, 4, "Fecha     : ",0,1,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(24,16);
        Fpdf::Cell(48, 4, date('d/m/Y', strtotime($cobranza->fecha)),0,0,'L',0);

        $cliente = $cobranza->prestamo->cliente->nombres;
        $cliente .= " ".$cobranza->prestamo->cliente->apellidos;
        $cli_direc = $cobranza->prestamo->cliente->direccion;
        $cli_dni = $cobranza->prestamo->cliente->dni;

        //NOMBRES DEL CLIENTE
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,20);
        Fpdf::Cell(18, 4, "Cliente   : ",0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(4,24);
        Fpdf::Cell(66, 4, utf8_decode($cliente),0,0,'L',0);

        //DNI CLIENTE
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,28);
        Fpdf::Cell(20, 4, "DNI       : ",0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(24,28);
        Fpdf::Cell(48, 4, utf8_decode($cli_dni),0,0,'L',0);

        //DIRECCIÓN CLIENTE
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,32);
        Fpdf::Cell(20, 4, utf8_decode("Dirección : "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 6);
        Fpdf::setXY(4,36);
        Fpdf::Cell(66, 4, utf8_decode($cli_direc),0,0,'L',0);

        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,41,70,41);

        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', 'B', 9);
        Fpdf::setXY(4,41);
        Fpdf::Cell(66, 4, utf8_decode("DETALLE COBRANZA"),0,0,'C',0);

        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,45,70,45);

        //NRO DE CUOTAS
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,47);
        Fpdf::Cell(24, 4, utf8_decode("Nro. Cuotas : "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(28,47);
        Fpdf::Cell(42, 4, $cobranza->cantidad_cuotas,0,0,'L',0);

        //MONTO
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::setXY(4,52);
        Fpdf::Cell(24, 4, utf8_decode("Cuota       : "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(28,52);
        Fpdf::Cell(42, 4, number_format($cobranza->prestamo->cuota,2),0,0,'L',0);

        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,59,48,59);
        //IMPORTES
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', 'B', 9);
        Fpdf::setXY(4,60);
        Fpdf::Cell(24, 4, utf8_decode("Importe   S/: "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 9);
        Fpdf::setXY(30,60);
        Fpdf::Cell(48, 4, number_format($cobranza->monto,2),0,0,'L',0);

        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,65,48,65);

        
        //MONTO PAGADO
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(4,67);
        Fpdf::Cell(24, 4, utf8_decode("Efectivo    S/: "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(32,67);
        Fpdf::Cell(38, 4, number_format($cobranza->pagado,2),0,0,'L',0);

        //MONTO VUELTO
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(4,71);
        Fpdf::Cell(24, 4, utf8_decode("Vuelto      S/: "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 8);
        Fpdf::setXY(32,71);
        Fpdf::Cell(38, 4, number_format($cobranza->vuelto,2),0,0,'L',0);

        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,79,48,79);

        //MONTO PRÉSTAMO
        $monto_total = $cobranza->prestamo->monto ;
        $monto_total += ($cobranza->prestamo->monto*$cobranza->prestamo->tasa_interes);
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', 'B', 9);
        Fpdf::setXY(4,80);
        Fpdf::Cell(24, 4, utf8_decode("Préstamo  S/: "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 9);
        Fpdf::setXY(30,80);
        Fpdf::Cell(48, 4, number_format($monto_total,2),0,0,'L',0);

        //SALDO
        Fpdf::setDash(0,0);
        Fpdf::SetFont('Courier', 'B', 9);
        Fpdf::setXY(4,84);
        Fpdf::Cell(24, 4, utf8_decode("Saldo     S/: "),0,0,'L',0);
        Fpdf::SetFont('Courier', '', 9);
        Fpdf::setXY(30,84);
        Fpdf::Cell(48, 4, number_format($cobranza->saldo,2),0,0,'L',0);
        
        Fpdf::setDash(0.5,1);
        Fpdf::Line(4,90,48,90);
        Fpdf::SetFont('Courier', '', 9);
        Fpdf::setXY(4,10);
        Fpdf::Cell(48, 4,  Auth::user()->name,0,0,'L',0);

        Fpdf::Output();
        exit;
    }
}
