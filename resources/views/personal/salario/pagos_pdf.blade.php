@php
    switch($personalSalario->mes_pago){
        case '01' : $mes = "ENERO";break;
        case '02' : $mes = "FEBRERO";break;
        case '03' : $mes = "MARZO";break;
        case '04' : $mes = "ABRIL";break;
        case '05' : $mes = "MAYO";break;
        case '06' : $mes = "JUNIO";break;
        case '07' : $mes = "JULIO";break;
        case '08' : $mes = "AGOSTO";break;
        case '09' : $mes = "SETIEMBRE";break;
        case '10' : $mes = "OCTUBRE";break;
        case '11' : $mes = "NOVIEMBRE";break;
        case '12' : $mes = "DICIEMBRE";break;
    }
@endphp
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <!-- Logo & title -->
            <div class="row">
                <div class="col-6">
                    <img src="assets/images/Logo_Inversiones.png" alt="" height="40"><br>
                    <small>Direcci&oacute;n</small>
                </div>
                <div class="col-6 text-right">
                        <h4 class="m-0">BOLETA DE PAGO</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-8">
                        <strong>Apellidos y Nombres:&nbsp;</strong>{{ $personalSalario->personal->apellidos.", ".
                        $personalSalario->personal->nombres }}
                    <address>
                        <strong>DNI:&nbsp;</strong>{{ $personalSalario->personal->dni }}<br>
                        <strong>Direcci&oacute;n:&nbsp;</strong>{{ $personalSalario->personal->direccion }}<br>
                        <strong>Celular:&nbsp;</strong>{{ $personalSalario->personal->celular }}
                    </address>
                </div>
                <div class="col-4">
                        <span class="m-b-5"><strong>Fecha: </strong>{{ date('d-m-Y')}}</span><br>
                        <span class="m-b-5"><strong>Mes Pago : </strong>{{ $mes }}</span><br>
                        <span class="m-b-5"><strong>Tipo Pago : </strong>MENSUAL</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table mt-2 table-centered nowrap table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th width="33%">REMUNERACIONES</th>
                                    <th width="33%">DESCUENTOS</th>
                                    <th width="33%">APORTACIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td>Remuneción Básica:</td>
                                                <td>{{ $personalSalario->sueldo}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td>Adelantos:</td>
                                                <td>{{ $personalSalario->adelantos}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td>EsSalud:</td>
                                                <td>{{ number_format(0,2) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right"><strong>REMUN. BRUTA:</strong> {{ $personalSalario->sueldo}}</td>
                                    <td class="text-right"><strong>TOTAL DESCUENTOS:</strong> {{ $personalSalario->adelantos}}</td>
                                    <td class="text-right"><strong>TOTAL APORTE:</strong> {{ number_format(0,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan='2'><strong>NETO PAGAR: </strong>
                                    <td class="text-center"> {{ number_format($personalSalario->sueldo - $personalSalario->adelantos,2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row ">
                <div class="col-6 text-center">
                    _____________________________<br>
                    Empleador
                </div>
                <div class="col-6 text-center">
                    _____________________________<br>
                    Recibí Conforme
                </div>
            </div>
            <div class="mt-3 mb-1">
                <div class="text-right d-print-none">
                    <button class="btn btn-primary waves-effect waves-light"
                        onclick="imprimir_boleta()">
                            <i class="mdi mdi-printer mr-1"></i> imprimir</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>