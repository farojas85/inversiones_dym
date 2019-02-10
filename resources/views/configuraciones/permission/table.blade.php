<table id="table-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100 table-sm" >
    <thead>
        <tr>
            <th  width="10px">Acciones</th>
            <th  width="10px">ID</th>
            <th >Nombre</th>
            <th >Slug</th>
            <th >Descripción</th>                                            
        </tr>
    </thead>
    <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>
                    @can('permissions.show')
                    <a class="btn btn-info btn-xs modal-show" 
                        title="Ver Permiso"
                        href="{{ route('permissions.show',$permission->id)}}">
                        <i class="fa fa-eye"></i>
                    </a>
                    @endcan
                    @can('permissions.edit')
                    <a class="btn btn-warning btn-xs modal-edit" 
                        title="Editar Permiso"
                        href="{{ route('permissions.edit',$permission->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('permissions.destroy')
                    <a class="btn btn-danger btn-xs modal-destroy" 
                        title="Eliminar Permiso"
                        href="{{ route('permissions.destroy',$permission->id)}}">
                        <i class="fe-trash-2"></i>
                    </a>
                    @endcan
                </td>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $permission->name}} </td>
                <td> {{ $permission->slug }}</td>
                <td> {{ $permission->description}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</table>
<script>
    var tabla2;
    $(document).ready(function() {        
        tabla2 = $('#table-datatable').DataTable({
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