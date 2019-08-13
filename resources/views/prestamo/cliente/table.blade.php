<table id="cliente-datatable-2" class="table table-striped dt-responsive table-sm nowrap" >
    <thead>
        <tr>
            <th style="width: 100px;">Acciones</th>
            <th >ID</th>
            <th >Cliente</th>
            <th >Personal</th>
            <th >Estado</th>
            <th>Tipo Cliente</th>
        </tr>
    </thead>
    <tbody>
    @if ($todo == 1)
        @foreach ($clientes as $cliente)
        @php
            switch($cliente->estado)
            {
                case 'activo':$alert = "badge badge-success";break;
                case 'inactivo':$alert = "badge badge-dark";break;
                case 'suspendido':$alert = "badge badge-secondary";break;
                case 'eliminado':$alert = "badge badge-danger";break;
            }
        @endphp
        <tr>
            <td>
                @if($cliente->direccion !='' || $cliente->direccion != null)
                    @can('clientes.gmap')
                    <a href="{{ route('clientes.gmap',$cliente->id)}}"
                        class="btn btn-success btn-xs modal-cliente-gmap"
                        title="Ubicación Cliente"
                        >
                        <i class="mdi mdi-map-marker"></i>
                    </a>
                    @endcan
                @endif
                @can('clientes.show')
                <a class="btn btn-blue btn-xs modal-cliente-show" title="Ver Cliente"
                    href="{{ route('clientes.show',$cliente->id)}}">
                    <i class="far fa-eye"></i>
                </a>
                @endcan
                @can('clientes.edit')
                <a class="btn btn-warning btn-xs modal-cliente-edit" 
                    title="Editar Cliente"
                    href="{{ route('clientes.edit',$cliente->id)}}">
                    <i class="fas fa-edit"></i>
                </a>
                @endcan
                @can('clientes.destroy')
                <a class="btn btn-danger btn-xs modal-cliente-destroy" title="Eliminar Cliente"
                    href="{{ route('clientes.destroy',$cliente->id)}}">
                    <i class="fe-trash-2"></i>
                </a>
                @endcan
            </td>
            <td>{{ $loop->iteration }}</td>
            <td> {{ $cliente->cli_apellidos." ".$cliente->cli_nombres }}</td>
            <td>
                {{  $cliente->per_apellidos." ".$cliente->per_nombres  }}
            </td>
            <td> <span class="{{ $alert }}">{{ $cliente->estado }}</span> </td>
            <td>
                @php
                    $fecha_cobranza = \Carbon\Carbon::parse($cliente->fecha_cobranza);
                    $ahora = \Carbon\Carbon::now();
                    $dias = 0;
                    if($cliente->fecha_cobranza == '' || $cliente->fecha_cobranza == null)
                    {
                        $tipo_cliente = "Regular";
                        $alertipo = "badge badge-warning";
                    }
                    else{
                        $dias = $fecha_cobranza->diffInDays($ahora);
                        if($dias == 0 || $dias == 1){
                            $tipo_cliente = "Bueno";
                            $alertipo = "badge badge-success";
                        }
                        else if($dias >=2 && $dias <=5){
                            $tipo_cliente = "Regular";
                            $alertipo = "badge badge-warning";
                        }
                        else if( $dias > 5){
                            $tipo_cliente = "Moroso";
                            $alertipo = "badge badge-danger";
                        }
                    }
                @endphp
                <span class="{{ $alertipo }}">{{ $tipo_cliente }}</span>
            </td>
        </tr>
        @endforeach
    @else
        @foreach ($clientes as $cliente)
            @php
                switch($cliente->estado)
                {
                    case 'activo':$alert = "badge badge-success";break;
                    case 'inactivo':$alert = "badge badge-dark";break;
                    case 'suspendido':$alert = "badge badge-secondary";break;
                    case 'eliminado':$alert = "badge badge-danger";break;
                }
            @endphp
            <tr>
                <td>
                    @can('clientes.show')
                    <a class="btn btn-blue btn-xs modal-cliente-show" title="Ver Cliente"
                        href="{{ route('clientes.show',$cliente->id)}}">
                        <i class="far fa-eye"></i>
                    </a>
                    @endcan
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cliente->cli_apel." ".$cliente->cli_nombre }}</td>
                <td>{{ $cliente->per_apel." ".$cliente->per_nombre }}</td>
                <td> <span class="{{ $alert }}">{{ $cliente->estado }}</span> </td>
                <td>
                    @php
                        $fecha_cobranza = \Carbon\Carbon::parse($cliente->fecha_cobranza);
                        $ahora = \Carbon\Carbon::now();
                        $dias = 0;
                        if($cliente->fecha_cobranza == '' || $cliente->fecha_cobranza == null)
                        {
                            $tipo_cliente = "Regular";
                            $alertipo = "badge badge-warning";
                        }
                        else{
                            $dias = $fecha_cobranza->diffInDays($ahora);
                            if($dias == 0 || $dias == 1){
                                $tipo_cliente = "Bueno";
                                $alertipo = "badge badge-success";
                            }
                            else if($dias >=2 && $dias <=5){
                                $tipo_cliente = "Regular";
                                $alertipo = "badge badge-warning";
                            }
                            else if( $dias > 5){
                                $tipo_cliente = "Moroso";
                                $alertipo = "badge badge-danger";
                            }
                        }
                    @endphp
                <span class="{{ $alertipo }}"
                    title="Ultimo día de Cobranza {{  $fecha_cobranza->format('d-m-Y') }}">
                    {{ $tipo_cliente }}
                </span>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#cliente-datatable-2').DataTable({
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
            "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            dom: 'Bfrtip',
            "buttons":
                [
                    {
                        extend: 'colvis',
                        text:'Mostrar',
                        className:"btn btn-warning",
                    },
                    {
                        extend:'excelHtml5',
                        text: "<i class='far fa-file-excel'></i> Excel",
                        className:"btn btn-success",
                        exportOptions:{
                            columns : ':visible:not(.not-export-col)',
                        }
                    },
                    {
                        extend:'pdf',
                        text: "<i class='far fa-file-pdf'></i> PDF",
                        className:"btn btn-danger",
                        title:"Listado de Usuarios",
                        exportOptions:{
                            columns : ':visible:not(.not-export-col)',
                        }
                    }
                    ,{
                        extend:'print',
                        text: "<i class='fas fa-print'></i> Imprimir",
                        className:"btn btn-primary",
                        exportOptions:{
                            columns : ':visible:not(.not-export-col)',
                        }
                    },
                ]
        });
    });
</script>