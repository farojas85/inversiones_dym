<div id="table-responsive">
    <table id="adelantos-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm">
        <thead class="thead-dark">
            <tr>
                <th class="text-white">N&deg;</th>
                <th class="text-white">Fecha</th>
                <th class="text-white">Motivo</th>
                <th class="text-white">Monto</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($adelantos as $adelanto)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ date('d-m-Y', strtotime($adelanto->fecha)) }}</td>
                <td>{{ $adelanto->motivo }}</td>
                <td>{{ $adelanto->monto }}</td>
            </tr>
    @endforeach
        </tbody>
    </table>
</div>
<script>
    $('#adelantos-datatable').DataTable({
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
        "pageLength": 2,
        "lengthMenu": [[2,5,10, -1], [2,5,10, "All"]],
        "searching": false
    });
</script>
