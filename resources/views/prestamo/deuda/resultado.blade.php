<div class="card-body">
<h4 class="header-title">Reporte de Pr&eacute;stamos 
    <a href="prestamos" class="btn btn-danger btn-xs d-print-none">
        <i class="fas fa-times"></i> Cerrar
    </a>
    <button class="btn btn-blue btn-xs btn-imprimir d-print-none">
            <i class="fas fa-print"></i> Imprimir
        </button>
</h4>
<hr>

<div class="row">
    <div class="table-responsive" id="tabla-detalle">
@if ($request->tipo_busqueda == '01')
        <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
            <thead>
                <tr>
                    <th >ID</th>
                    <th >fecha</th>
                    <th>Personal</th>
                    <th >Cliente</th>
                    <th>Monto Pr&eacute;stamo</th>
                    <th>Inter&eacute;s</th>
                    <th>Total Pr&eacute;stamo</th>
                </tr>
            </thead> 
            <tbody>
                @php
                    $total_prestamo=0;
                @endphp
                @forelse ($prestamos as $prestamo)
                @php
                    $total_prestamo += $prestamo->total;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prestamo->fecha_prestamo }}</td>
                    <td>{{ $prestamo->personal }}</td>
                    <td>{{ $prestamo->cliente }}</td>
                    <td>S/ {{ number_format($prestamo->monto,2) }}</td>
                    <td>S/ {{ number_format($prestamo->interes,2) }}</td>
                    <td>S/ {{ number_format($prestamo->total,2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">-- DATOS NO REGISTRADOS --</td>
                </tr>
                @endforelse
            </tbody> 
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total Pr&eacute;stamo S/</th>
                    <th>{{ number_format($total_prestamo,2) }}</th>
                </tr>
            </tfoot>
        </table>
@elseif($request->tipo_busqueda == '02')
        <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
            <thead>
                <tr>
                    <th >ID</th>
                    <th >Mes</th>
                    <th>Personal</th>
                    <th>Total Pr&eacute;stamo</th>
                </tr>
            </thead> 
            <tbody>
            @php
                $total_prestamo=0;
            @endphp
        @forelse ($prestamos as $prestamo)
            @php
                $total_prestamo += $prestamo->total;
            @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
            @php
                switch($prestamo->mes){
                    case 1: echo "Enero";break;
                    case 2:  echo "Febrero";break;
                    case 3: echo "Marzo";break;
                    case 4: echo "Abril";break;
                    case 5: echo "Mayo";break;
                    case 6: echo "Junio";break;
                    case 7: echo "Julio";break;
                    case 8: echo "Agosto";break;
                    case 9: echo "Setiembre";break;
                    case 10: echo "Octubre";break;
                    case 11: echo "Noviembre";break;
                    case 12: echo "Diciembre";break;
                }
            @endphp
                    </td>
                    <td>{{ $prestamo->personal }}</td>
                    <td>S/ {{ number_format($prestamo->total,2) }}</td>
                </tr>
        @empty
                <tr>
                    <td colspan="4" class="text-center">-- DATOS NO REGISTRADOS --</td>
                </tr>
        @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Pr&eacute;stamo S/</th>
                    <th>{{ number_format($total_prestamo,2) }}</th>
                </tr>
            </tfoot>
        </table>
@endif        
    </div>
</div>
</div>
<script>
    $('body').on('click', '.btn-imprimir', function (event) {
        event.preventDefault();
        window.print();
    });
</script>