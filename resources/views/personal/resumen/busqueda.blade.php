<table id="cliente-datatable" class="table table-striped dt-responsive table-sm nowrap" >
    <thead class="thead-dark">
        <tr>
            <th class="text-white">ID</th>
            <th class="text-white">Personal</th>
            <th class="text-white">Total Recibido</th>
            <th class="text-white">Fecha</th>
            <th class="text-white">Total Pr&eacute;stamo</th>
            <th class="text-white">Total Cobro</th>
            <th class="text-white">Total Gasto</th>
            <th class="text-white">Total Entregado</th>
            <th class="text-white">Saldo Actual</th>
        </tr>
    </thead>
    <tbody>
    @php
        $saldo=0;
    @endphp
    @forelse ($resumen as $res)
        @if ($loop->iteration==1)
            @php
                $saldo = $res['total_recibido'];
            @endphp
        @endif        
        <tr>
            <td>{{ $res['id'] }}</td>
            <td>{{ $res['personal'] }}</td>
            <td>{{ number_format($res['total_recibido'],2) }}</td>
            <td>{{ $res['fecha'] }}</td>
            <td>{{ number_format($res['total_prestamo'],2) }}</td>
            <td>{{ number_format($res['total_cobro'],2) }}</td>
            <td>{{ number_format($res['total_gasto'],2) }}</td>
            <td>{{ number_format($res['total_entregado'],2) }}</td>
            <td>{{ number_format($res['saldo'],2) }}</td>
        </tr>
    @empty
        
    @endforelse
    </tbody>
</table>