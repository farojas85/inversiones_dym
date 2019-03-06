<?php

namespace App\Http\Controllers;

use App\Cobranza;
use App\Prestamo;
use Illuminate\Http\Request;
use Fpdf;
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
        //Guardamos la Cobranza

            $cobranza = new Cobranza;
            $cobranza->fecha = $request->fecha;
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
        //
    }


    public function destroy(Cobranza $cobranza)
    {
        //
    }

    public function nuevaCobranza($id,$minsaldo,$cuota){
        $estadoform="create";

        //Obtenemos el máximo según la serie
        $max_id = Cobranza::where('serie','=','B001')->max('numero');

        if($max_id == null || $max_id == ''){
            $max_num = 1;
        }
        else{
            $max_num = $max_id + 1;
        }
        return view('cobranza.create',compact('estadoform','id','minsaldo','cuota','max_num','max_id'));
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
        Fpdf::Cell(48, 4, $cobranza->created_at,0,0,'L',0);

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
