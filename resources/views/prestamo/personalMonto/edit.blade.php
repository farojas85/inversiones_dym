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

                    <th >Fecha</th>
                    <th >Monto Asignado</th>
                    <th >Monto Saldo</th>
                    <th >Estado</th>                                 
                </tr>
            </thead>
            <tbody>
                @foreach ($personalmontos as $personalmonto)
                @php
                switch ($personalmonto->consumido) {
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
                        
                        {!! Form::hidden('hdd_id_'.$personalmonto->id, $personalmonto->id, ['id' => 'hdd_id_'.$personalmonto->id]) !!}
                        
                        <button type="button" class="btn btn-warning btn-xs" onclick="editar_monto_asiganado({{ $personalmonto->id}})">
                            <i class="fas fa-edit"></i>
                        </button>                            
                        <button class="btn btn-danger btn-xs modal-monto-destroy"
                            title="Eliminar Monto Asignado" onclick="eliminar_monto_asignado( {{ $personalmonto->id }} )">
                            <i class="far fa-trash-alt"></i>
                        </button >
                    </td>
                    <td>
                        {{ date('d/m/Y',strtotime($personalmonto->fecha)) }}
                    </td>
                    <td>{{ "S/ ".number_format($personalmonto->monto_asignado,2) }}</td>
                    <td>{{ "S/ ".number_format($personalmonto->monto_saldo,2) }}</td>
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

function editar_monto_asiganado(id)
{
    $.ajax({
        url: 'editarMontos/'+id,
        type: 'GET',
        data:{
            id : id,
        },
        success: function (response) {   
            $('#modal-default-title').text('Editar Monto Personal');
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        },
        error: function (xhr) {
            swal({
                type: 'error',
                title: 'Advertencia',
                text: xhr.responseText
            });          
        },
    });    
}

function eliminar_monto_asignado(id){

    url ="personalmontos/"+id;

    csrf_token = $('meta[name="csrf-token"]').attr('content');
    
    swal({
        title: 'Eliminar Monto Asignado',
        text: '¿Seguro de Eliminar El Registro? No podrá revertirlo',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if(result.value){
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    id:id,
                    '_token':csrf_token,
                    '_method':'DELETE'
                },
                success:function(response){
                    swal({
                        type: 'success',
                        title: 'Personal Montos',
                        text: 'Registro Eliminado Satisfactoriamente'
                    }).then(function(){
                        window.location="personalmontos";
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Cliente',
                        text: xhr.responseText
                    });
                },
            });
        } 
    })
}
$('body').on('click', '.modal-monto-destroy', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

   
});
</script>
@section('scripties')
    <script src="js/prestamo/personal_monto.js"></script>
@endsection