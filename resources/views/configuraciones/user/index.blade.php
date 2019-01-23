@can('users.create')
<button class="btn btn-info btn-rounded" id="btn-agregar-usuario"
        title="Agregar Usuario">
    <i class="fa fa-plus"></i> Agregar Usuario
</button>
@endcan
<table id="user-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
    <thead>
        <tr>
            <th >ID</th>
            <th >Usuario</th>
            <th >Correo</th>
            <th >Rol</th>
            <th >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td> {{ $loop->iteration }}</td>
            <td> {{ $user->name }}</td>
            <td> {{ $user->email }}</td>
            <td>
                @foreach ($user->getRoles() as $role)
                    @php
                        switch ($role) {
                            case 'admin': $colorbadge = "badge-primary";break;
                            case 'master': $colorbadge='badge-info';break;
                            case 'analista': $colorbadge='badge-warning';break;
                            case 'cobrador': $colorbadge='badge-danger';break;
                        }
                    @endphp
                    <span class="badge {{ $colorbadge }}">{{ $role }}</span>&nbsp;
                @endforeach                                    
            </td>
            <td>
                @can('users.edit')
                <a class="btn btn-social-icon btn-warning modal-edit" 
                    title="Editar Usuario"
                    href="{{ route('users.edit',$user->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                @endcan
                @can('users.destroy')
                <a class="btn btn-social-icon btn-danger modal-destroy" title="Eliminar Usuario"
                    href="{{ route('users.destroy',$user->id)}}">
                    <i class="fa fa-trash-o"></i>
                </a>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
        $('#user-datatable').DataTable({
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
<script src="js/configuraciones/role.js"></script>
