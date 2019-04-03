<table id="model-datatables" class="table table-striped table-bordered table-sm dt-responsive nowrap" >
    <thead>
        <tr>
            <th  width="10px">Acciones</th>
            <th  width="10px">ID</th>
            <th>Personal</th> 
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Dias</th>                                          
        </tr>
    </thead>
    <tbody>
        @foreach ($horarios as $horario)
        <tr>
            <td>
               <!-- @can('horarios.show')
                <a class="btn btn-info btn-xs modal-show" 
                    title="Ver Permiso"
                    href="{{ route('horarios.show',$horario->id)}}">
                    <i class="fa fa-eye"></i>
                </a>
                @endcan-->
                @can('horarios.edit')
                <a class="btn btn-warning btn-xs modal-edit" 
                    title="Editar Permiso"
                    href="{{ route('horarios.edit',$horario->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                @endcan
                @can('horarios.destroy')
                <a class="btn btn-danger btn-xs modal-destroy" 
                    title="Eliminar Permiso"
                    href="{{ route('horarios.destroy',$horario->id)}}">
                    <i class="fe-trash-2"></i>
                </a>
                @endcan
            </td>
            <td>{{ $loop->iteration}}</td>
            <td>
                {{ 
                    $horario->personal($horario->user_id)->nombres." ".
                    $horario->personal($horario->user_id)->apellidos }}
            </td>
            <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format("h:i a")}}</td>
            <td>{{ \Carbon\Carbon::parse($horario->hora_fin)->format("h:i a")}}</td>
            <td>
                @php
                    $dias = explode("-",$horario->dias);
                    for($i=0;$i<count($dias);$i++)
                    {
                        switch($dias[$i]){
                            case 1: $clase ="badge badge-primary";$nombredia="Lunes";break;
                            case 2: $clase ="badge badge-success";$nombredia="Martes";break;
                            case 3: $clase ="badge badge-info";$nombredia="Miércoles";break;
                            case 4: $clase ="badge badge-warning";$nombredia="Jueves";break;
                            case 5: $clase ="badge badge-danger";$nombredia="Viernes";break;
                            case 6: $clase ="badge badge-blue";$nombredia="Sábado";break;
                            case 7: $clase ="badge badge-pink";$nombredia="Domingo";break;
                        }
                        echo "<span class='".$clase."'>".$nombredia."</span>";
                    }
                @endphp
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    var tabla;
$(document).ready(function() {
    // Default Datatable
    tabla = $('#model-datatables').DataTable({
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
});

</script>