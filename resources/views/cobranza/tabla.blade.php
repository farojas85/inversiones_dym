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
        <td>
            <a href="{{ route('cobranzas.pdf',$cobranza->id) }}" 
                title="Mostrar Cobranza"
                class="btn btn-danger btn-xs show-cobranza"
                target="_blank">
                <i class=" far fa-file-pdf"></i>
            </a>
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $cobranza->fecha }}</td>
        <td>{{ $cobranza->cantidad_cuotas }}</td>
        <td>{{ "S/ ".number_format($cobranza->monto,2) }}</td>
        <td>{{ "S/ ".number_format($cobranza->saldo,2) }}</td>        
    </tr>
@endforeach
    </tbody>
</table>
<script>
    $('#cobranza-table').DataTable({
        "language":
            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
        "pageLength": 5,
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
    </script>