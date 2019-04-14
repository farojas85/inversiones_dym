<h4 class="header-title">Cobranzas&nbsp;
    <a href="prestamos" class="btn btn-danger btn-rounded btn-sm"><i class="fas fa-undo"></i> Volver</a>
</h4>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-blue py-2 text-white">
                <h5 class="card-title mb-0 text-white">DATOS PRESTAMO</h5>
            </div>
            <div id="cardCollpase4" class="collapse show">
                <input type="hidden" id="prestamo_id" name="prestamo_id" value="{{ $prestamo->id }}" />
                <input type="hidden" id="min_saldo" name="min_saldo" value="{{ $minSaldo }}" />
                <input type="hidden" id="cuota" name="cuota" value="{{ $prestamo->cuota }}" />
                <div class="card-body" style="border:1px solid #4a81d4">
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-1" >
                            <strong>Cliente</strong>
                        </label>
                        <div class="col-md-11">
                            <input type="text" class="form-control"  readonly
                                value="{{ $prestamo->cliente->nombres." ".$prestamo->cliente->apellidos}}" >
                        </div>                                                
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-5">
                                        <strong>Pr&eacute;stamo</strong>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control"  readonly
                                        value="{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y')}}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-3">
                                    <strong>Monto</strong>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  readonly
                                        value="S/ {{ number_format($prestamo->monto,2) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-5">
                                        <strong>Tasa Inter&eacute;s</strong>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control"  readonly
                                        value="{{ ( $prestamo->tasa_interes)*100}} %" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-5">
                                    <strong> Nro. D&iacute;as</strong>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control"  readonly
                                        value="{{ $prestamo->dias  }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-3">
                                    <strong>Cuota</strong>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  readonly
                                        value="S/ {{number_format($prestamo->cuota,2) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="" class="col-form-label col-md-5">
                                    <strong>Estado</strong>
                                </label>
                                <div class="col-md-7 align-self-center">
                                    @php
                                        switch($prestamo->estado){
                                            case 'Generado':$clase="badge badge-danger";break;
                                            case 'Pendiente':$clase="badge badge-warning";break;
                                            case 'Cancelado':$clase="badge badge-succsess";break;
                                            case 'Anulado': $clase="badge badge-dark";break;
                                        }
                                    @endphp
                                    <span class="">{{ $prestamo->estado }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header  bg-success py-2 ">
                <h5 class="card-title mb-0 text-white">
                    Listado de Cobranza   
                </h5>
            </div>
            <div id="cardCollpase4" class="collapse show">
                <div class="card-body" style="border:1px solid #1abc9c">
                    <div class="row form-group">
                        @if($prestamo->estado != 'Cancelado')
                            @can('cobranzas.create')
                            <button type="button"
                                class="btn btn-warning btn-sm btn-rounded modal-create-cobro"
                                title="Nuevo Cobro">
                                <i class="fas fa-plus"></i> Nuevo Cobro
                            </button>
                            @endcan
                        @endif
                    </div>
                    <div class="row table-responsive">
                        <table class="table table-hover table-striped table-sm" id="cobranza-table">
                                <thead>
                                    <tr>
                                        <th width="10%">Acciones</th>
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
                                        @if ($role_name == 'admin' || $role_name == 'master')
                                        <button type="button" 
                                                title="Editar Cobranza"
                                                class="btn btn-warning btn-xs edit-cobranza"
                                                onclick="editar_cobranza({{ $cobranza->id }})">
                                                <i class=" far fa-edit"></i>
                                        </button> 
                                        @endif
                                        <a href="{{ route('cobranzas.pdf',$cobranza->id) }}" 
                                            title="Mostrar Cobranza"
                                            class="btn btn-blue btn-xs show-cobranza"
                                            target="_blank">
                                            <i class=" far fa-file-pdf"></i>
                                        </a>
                                        @can('cobranzas.destroy')
                                        <a href="{{ route('cobranzas.destroy',$cobranza->id) }}"
                                            title="Eliminar Cobranza"
                                            class="btn btn-danger btn-xs destroy-cobranza"
                                            >
                                            <i class="fe-trash-2"></i>
                                        </a>
                                        @endcan
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($cobranza->fecha)) }}</td>
                                    <td>{{ $cobranza->cantidad_cuotas }}</td>
                                    <td>{{ "S/ ".number_format($cobranza->monto,2) }}</td>
                                    <td>{{ "S/ ".number_format($cobranza->saldo,2) }}</td>        
                                </tr>
                            @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

     //AGREGAR ROLE
$('body').on('click', '.modal-create-cobro', function (event) {
    event.preventDefault();

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    id=$('#prestamo_id').val();
    minsaldo = $('#min_saldo').val();
    cuota = $('#cuota').val();
    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'obtenerCobranzas',
        type: 'POST',
        data:{
            prestamo_id:id,
            _token: CSRF_TOKEN,
            '_method':'POST'
        },
        success: function(response){
            if(datos.role_name == 'admin' || datos.role_name == 'master')
            {
                $.ajax({
                    url: 'nuevaCobranza/'+id+'/'+minsaldo+'/'+cuota,
                    type:"GET",
                    success: function (response) {
                        $('#modal-default-title').text(title);
                        $('#modal-default-body').html(response);
                        $('#modal-default').modal('show');
                    }
                });
            }
            else{
                if(datos.nrocobros == 1){
                    swal({
                        type : 'warning',
                        title : 'Cobranzas',
                        text : '¡HOY ya ha registrado un Cobro del Préstamo, no puede añadir otro !,',
                        confirmButtonText: 'Aceptar'
                    });
                }
                else{
                    $.ajax({
                        url: 'nuevaCobranza/'+id+'/'+minsaldo+'/'+cuota,
                        type:"GET",
                        success: function (response) {
                            $('#modal-default-title').text(title);
                            $('#modal-default-body').html(response);
                            $('#modal-default').modal('show');
                        }
                    });
                }
            }
        },
    });
});


function editar_cobranza(cobranza_id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'editarCobranza',
        type:"GET",
        data:{
            _token: CSRF_TOKEN,
            prestamo_id : $('#prestamo_id').val(),
            minsaldo: $('#min_saldo').val(),
            cuota: $('#cuota').val(),
            cobranza_id: cobranza_id
        },
        success: function (response) {
            $('#modal-default-title').text('Editar Cobranza');
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });   
}

</script>