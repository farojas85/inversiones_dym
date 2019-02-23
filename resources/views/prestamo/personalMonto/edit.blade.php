<h4 class="header-title">Editar Montos del Personal
    <a href="personalmontos" class="btn btn-danger btn-xs">
        <i class="fas fa-times"></i> Cerrar
    </a>
</h4> 

<hr>
{!! Form::model($personal, 
    [
        'route' => ['personalmontos.update',$personal->id],'method' => 'PUT',
        'id' => 'form'
    ]) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            {!! Form::label('nombres','Nombres',['class' =>'col-md-3 col-form-label text-right']) !!}
            <div class="col-md-9">
                {!!
                    Form::text('nombres', null,
                                [   'class' => 'form-control', 'id' => 'nombres',
                                    'placeholder' => 'Ingrese Nombres','disabled'=>''])
                !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            {!! Form::label('apellidos','Apellidos',['class' =>'col-md-3 col-form-label text-right']) !!}
            <div class="col-md-9">
                {!!
                    Form::text('apellidos', null,
                                [   'class' => 'form-control', 'id' => 'apellidos',
                                    'placeholder' => 'Ingrese Apellidos','disabled'=>''])
                !!}
            </div>
        </div>
    </div>
</div>
<hr>
<div class="col-md-12">
    <div class="table-responsive" id="tabla-detalle">
        <table id="edit-datatable" class="table dt-responsive table-sm table-bordered" >
            <thead>
                <tr>
                    <th width="10px">Acciones</th>
                    <th width="5px">#</th>
                    <th >Fecha</th>
                    <th >Monto Asignado</th>
                    <th >Monto Saldo</th>
                    <th >Estado</th>                                 
                </tr>
            </thead>
            <tbody>
                @foreach ($personalmontos as $pm)
                @php
                switch ($pm->consumido) {
                    case 0: case null: 
                        $alert = "badge badge-success";
                        $text ="disponible";break;
                    case 1: 
                        $alert = "badge badge-dark";
                        $text ="consumido";break;
                }
            @endphp
                <tr>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs" onclick="editar_monto_asiganado({{ $pm->id}})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="" class="btn btn-danger btn-xs">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                    <td>{{ $pm->id }}</td>
                    <td class="tabledit-view-mode">{{ $pm->fecha }}</td>
                    <td>{{ "S/ ".number_format($pm->monto_asignado,2) }}</td>
                    <td>{{ "S/ ".number_format($pm->monto_saldo,2) }}</td>
                    <td>
                        <div class="{{ $alert }}">{{ $text }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! Form::close() !!}
<script>
$(document).ready(function() {
    tabla = $('#edit-datatable').DataTable({
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
@section('scripties')
    <script src="js/prestamo/personal_monto.js"></script>
@endsection