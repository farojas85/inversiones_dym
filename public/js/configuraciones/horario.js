var tabla;
$(document).ready(function() {
    // Default Datatable
    tabla = $('#model-datatable').DataTable({
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

//AGREGAR ROLE
$('body').on('click', '#btn-agregar', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'horarios/create',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text(title);
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });
});

$('body').on('click', '#btn-guardar', function (event) {
    event.preventDefault();

    estado = $(this).val();

    var form = $('#form'),
                url = form.attr('action'),
                method =form.attr('method');


    $('#form').parsley().validate();

    user_id = $('#user_id').val();
    hora_inicio = $('#hora_inicio').val();
    hora_fin = $('#hora_fin').val();
    
    dias = "";
    if($("#lunes").is(':checked'))
    {
        dias = dias + '1';
    }
    if($("#martes").is(':checked'))
    {
        dias = dias +"-2";
    }
    if($("#miercoles").is(':checked'))
    {
        dias = dias +"-3";
    }
    if($("#jueves").is(':checked'))
    {
        dias = dias +"-4";
    }
    if($("#viernes").is(':checked'))
    {
        dias = dias +"-5";
    }
    if($("#sabado").is(':checked'))
    {
        dias = dias +"-6";
    }
    if($("#domingo").is(':checked'))
    {
        dias = dias +"-7";
    }

    token = $('_token').val();

    if ($('#form').parsley().isValid()) {
        if(estado == 'create'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : 'horarios',
                type: 'POST',
                data : {
                    '_token':token,
                    user_id : user_id,
                    hora_inicio : hora_inicio,
                    hora_fin : hora_fin,
                    dias : dias
                },
                success: function (response) {
                   swal({
                       type : 'success',
                       title : 'Horarios',
                       text : "Datos Registrados Satisfactoriamente !",
                       confirmButtonText: 'Aceptar'
                   }).then(function () {
                        $('#modal-default').modal('hide');
                        mostrar_tabla();
                   });      
               },
               error : function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Permisos',
                        text: xhr.responseText
                    });
               }
            });
        }
        else if(estado == 'edit'){
            id=$('#id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : 'horarios/'+id,
                type: 'POST',
                data : {
                    '_token':token,
                    '_method':'PUT',
                    user_id : user_id,
                    hora_inicio : hora_inicio,
                    hora_fin : hora_fin,
                    dias : dias
                },
                success: function (response) {
                   swal({
                       type : 'success',
                       title : 'Horarios',
                       text : "Datos Modificados Satisfactoriamente !",
                       confirmButtonText: 'Aceptar'
                   }).then(function () {
                        $('#modal-default').modal('hide');
                        mostrar_tabla();
                   });      
               },
               error : function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Permisos',
                        text: xhr.responseText
                    });
               }
            });
        }
        
    }
});

function mostrar_tabla()
{
    $.ajax({
        url: 'horarioTable',
        type:"GET",
        success: function (response) {
            $('#tabla-detalle').html(response);
        }
    });
}


$('body').on('click', '.modal-edit', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');  

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-default-title').text(title);
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });        
});

$('body').on('click', '.modal-destroy', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: title,
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
                    '_token':csrf_token,
                    '_method':'DELETE'
                },
                success:function(response){
                    swal({
                        type: 'success',
                        title: 'Horarios',
                        text: 'Registro Eliminado Satisfactoriamente'
                    }).then(function(){
                        mostrar_tabla();
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Permisos',
                        text: xhr.responseText
                    });
                },
            });
        }
    });
});
