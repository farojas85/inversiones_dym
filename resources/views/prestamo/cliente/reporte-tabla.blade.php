<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white">Cliente</th>
                <th class="bg-dark text-white">Personal</th>
                <th class="bg-dark text-white">Fecha Préstamo</th>
                <th class="bg-dark text-white">Préstamo</th>
                <th class="bg-dark text-white">Interes</th>
                <th class="bg-dark text-white">Total Préstamo</th>
                <th class="bg-dark text-white">Saldo</th>
                <th class="bg-dark text-white">Estado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $suma_prestamo=0;
                $suma_interes =0;
                $suma_total = 0;
                $suma_saldo = 0;
            @endphp
           @foreach ($clientes as $cli)
           @php
                $suma_prestamo += $cli->prestamo;
                $suma_interes +=$cli->interes;
                $suma_total += $cli->total_prestamo;
                $suma_saldo += $cli->total_prestamo - $cli->monto_cobrado;
           @endphp
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $cli->cliente }}</td>
                <td>{{ $cli->personal }}</td>
                <td class="text-center">
                    {{ $cli->fecha_prestamo }}
                </td>
                <td>
                    {{ number_format($cli->prestamo,2) }}
                </td>
                <td>
                    {{ number_format($cli->interes,2) }}
                </td>
                <td>
                    {{ number_format($cli->total_prestamo,2) }}
                </td>
                <td>
                    {{ number_format( $cli->total_prestamo - $cli->monto_cobrado,2) }}
                </td>
                <td class="text-center">
                @switch($cli->estado_prestamo)
                    @case('')
                    {{ 'No Generado' }}
                        @break
                    @default
                    {{ $cli->estado_prestamo }}
                @endswitch
                </td>
            </tr>
           @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right bg-primary text-white">Totales S/</th>
                <th class="font-weight-bold">{{ number_format($suma_prestamo,2) }}</th>
                <th>{{ number_format($suma_interes,2) }}</th>
                <th>{{ number_format($suma_total,2) }}</th>
                <th>{{ number_format($suma_saldo,2) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>