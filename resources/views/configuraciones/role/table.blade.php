@can('roles.create')
<button class="btn btn-info btn-rounded" id="btn-agregar"
        title="Agregar Role">
    <i class="fa fa-plus"></i> Agregar Role
</button>
@endcan
<table id="role-datatable" class="table table-striped table-bordered border-t0 text-nowrap w-100" >
    <thead>
        <tr>
            <th >ID</th>
            <th >Rol</th>
            <th >Descripción</th>
            <th >Special</th>
            <th >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $rol)
        @php
            switch ($rol->special) {
                case '': case null: 
                    $alert = "badge badge-dark";
                    $text ="--";break;
                case 'all-access': 
                    $alert = "badge badge-info";
                    $text ="All-access";break;
                case 'no-access': 
                    $alert = "badge badge-secondary";
                    $text ="No-access";break;
            }
        @endphp
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $rol->name }}</td>
            <td>{{ $rol->description }}</td>
            <td>
                <div class="{{ $alert }}">
                    {{ $text }}
                </div>
            </td>
            <td>
                @can('roles.edit')
                <a class="btn btn-social-icon btn-warning modal-edit" 
                    title="Editar Role"
                    href="{{ route('roles.edit',$rol->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                @endcan
                @can('roles.destroy')
                <a class="btn btn-social-icon btn-danger modal-destroy" title="Eliminar Role"
                    href="{{ route('roles.destroy',$rol->id)}}">
                    <i class="fa fa-trash-o"></i>
                </a>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
        $('#role-datatable').DataTable({
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
