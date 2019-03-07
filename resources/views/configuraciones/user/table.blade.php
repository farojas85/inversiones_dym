@can('users.create')
<a href="{{route('users.create')}}" 
    title="Nuevo Usuario"
    class="btn btn-info btn-rounded btn-agregar-usuario">
    <i class="fa fa-plus"></i> Agregar Usuario
</a>
@endcan
<table id="user-datatable" class="table table-striped dt-responsive table-sm nowrap" >
    <thead>
        <tr>
            <th>Acciones</th>
            <th >ID</th>
            <th >Usuario</th>
            <th >Correo</th>
            <th >Rol</th>                                    
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                @can('users.edit')
                <a class="btn btn-warning btn-xs modal-user-edit" 
                    title="Editar Usuario"
                    href="{{ route('users.edit',$user->id)}}">
                    <i class="fas fa-edit"></i>
                </a>
                @endcan
                @can('users.reset')
                <a class="btn btn-blue btn-xs modal-reset-password"
                    title="Modificar Contraseña"
                    href="{{route('users.reset',$user->id)}}"
                >
                    <i class="mdi mdi-key"></i>
                </a>
                @endcan
                @can('users.destroy')
                <a class="btn btn-danger btn-xs modal-destroy" title="Eliminar Usuario"
                    href="{{ route('users.destroy',$user->id)}}">
                    <i class="fe-trash-2"></i>
                </a>
                @endcan
                
            </td>
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
            },
            buttons :{
                copyTitle: 'Registros Copiados',
                copySuccess: {
                    1: "one registro copiado al Portapapeles",
                    _: "%d registros copiados al portapapeles"
                },
            }
        },
        "pageLength": 5,
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        dom: 'Bfrtip',
        "buttons":
            [   
                {
                    extend: 'copy',
                    text: "<i class='far fa-copy'></i> Copiar",
                    className:"btn btn-blue",
    
                }, 
                {
                    extend:'csv',
                    text: "<i class='far fa-file-code'></i> CSV",
                    className:"btn btn-success"
                },
                {
                    extend:'pdf',
                    text: "<i class='far fa-file-pdf'></i> PDF",
                    className:"btn btn-danger",
                    title:"Listado de Usuarios"
                }
                ,{
                    extend:'print',
                    text: "<i class='fas fa-print'></i> Imprimir",
                    className:"btn btn-pink"
                },
            ]
    });
</script>