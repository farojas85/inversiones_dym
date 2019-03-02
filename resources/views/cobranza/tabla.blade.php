<table class="table table-hover table-striped table-sm" id="cobranza-table">
    <thead>
        <tr>
            <th width="10px">Acciones</th>
            <th width="5px">#</th>
            <th>fecha</th>
            <th>Nro. Cuotas</th>
            <th>Monto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
@foreach ($cobranzas as $cobranza)
    <tr>
        <td></td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $cobranza->fecha }}</td>
        <td>{{ $cobranza->cantidad_cuotas }}</td>
        <td>{{ "S/ ".number_format($cobranza->monto,2) }}</td>
        <td>{{ "S/ ".number_format($cobranza->saldo,2) }}</td>        
    </tr>
@endforeach
    </tbody>
</table>