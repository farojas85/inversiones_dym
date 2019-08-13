<h4 class="header-title">Reporte de Cobranzas
    <a href="prestamos" class="btn btn-danger d-print-none">
        <i class="fas fa-times"></i> Cerrar
    </a>
    <button class="btn btn-blue btn-imprimir d-print-none">
        <i class="fas fa-print"></i> Imprimir
    </button>
    <a href="/cobranza/exportar/{{ $request->tipo_busqueda }}" class="btn btn-success btn">
        <i class="fas fa-file-excel"></i> Descargar
    </a>
</h4>
<div class="table-responsive" id="tabla-detalle">
@if ($request->tipo_busqueda=='01')
    <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
        <thead>
            <tr>
                <th >ID</th>
                <th >fecha</th>
                <th>Personal</th>
                <th >Cliente</th>
                <th>Total Cobranza S/</th>
            </tr>
        </thead> 
        <tbody>
            @php($total_cobranza = 0)
            @forelse ($cobrianza as $cobro)
            @php($total_cobranza += $cobro['monto'])
            <tr>
                <td>{{ $cobro['id_cobranza'] }}</td>
                <td>{{ $cobro['fecha'] }}</td>
                <td>{{ $cobro['personal'] }}</td>
                <td>{{ $cobro['cliente'] }}</td>
                <td>{{ number_format($cobro['monto'],2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">-- DATOS NO REGISTRADOS --</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Cobranza S/</th>
                <th>{{ number_format($total_cobranza,2) }}</th>
            </tr>
        </tfoot>
    </table>
@elseif($request->tipo_busqueda =='02')
    <table id="model-datatable" class="table table-striped dt-responsive table-sm" >
        <thead>
            <tr>
                <th >ID</th>
                <th >Mes</th>
                <th>Personal</th>
                <th>Total Cobranza</th>
            </tr>
        </thead>
        <tbody>
                @php($total_cobranza = 0)
            @forelse ($cobranzas as $cobro)
                @php($total_cobranza += $cobro->total)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @switch($cobro->mes)
                            @case(1) {{ "Enero" }} @break
                            @case(2) {{ "Febrero" }} @break
                            @case(3) {{ "Marzo" }} @break
                            @case(4) {{ "Abril" }} @break
                            @case(5) {{ "Mayo" }} @break
                            @case(6) {{ "Junio" }} @break
                            @case(7) {{ "Julio" }} @break
                            @case(8) {{ "Agosto" }} @break
                            @case(9) {{ "Setiembre" }} @break
                            @case(10) {{ "Octubre" }} @break
                            @case(11) {{ "Noviembre" }} @break
                            @case(12) {{ "Diciembre" }} @break
                        @endswitch
                    </td>
                    <td>{{ $cobro->personal }}</td>
                    <td>{{ number_format($cobro->total,2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">-- DATOS NO REGISTRADOS --</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total Cobranza S/</th>
                <th>{{ number_format($total_cobranza,2) }}</th>
            </tr>
        </tfoot>
    </table> 
@endif
    </div>
</div>

<script>
    $('body').on('click', '.btn-imprimir', function (event) {
        event.preventDefault();
        window.print();
    });
</script>