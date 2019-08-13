$(document).ready(function() {
    $('#cliente-datatable').DataTable({
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
//AGREGAR ROLE
$('body').on('click', '#btn-agregar-cliente', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'clientes/create',
        type:"GET",
        success: function (response) {
            $('#modal-large-title').text(title);
            $('#modal-large-body').html(response);
            $('#modal-large').modal('show');
        }
    });
});

$('body').on('click', '.modal-cliente-edit', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-large-title').text(title);
            $('#modal-large-body').html(response);
            $('#modal-large').modal('show');
        }
    });
});

$('body').on('click', '.modal-cliente-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-large-title').text(title);
            $('#modal-large-body').html(response);
            $('#modal-large').modal('show');
        }
    });
});


$('body').on('click', '.modal-cliente-gmap', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            console.log(response)
            $('#modal-large-title').text(title);
            $('#modal-large-body').html(response);
            $('#modal-large').modal('show');
        }
    });
});

$('body').on('click', '#btn-cliente-guardar', function (event) {
    event.preventDefault();

    estado = $(this).val();

    var form = $('#form'),
                url = form.attr('action'),
                method =form.attr('method');

    $('#form').parsley().validate();

    if ($('#form').parsley().isValid()) {
        $.ajax({
           url : url,
           method: method,
           data : form.serialize(),
           success: function (response) {
               if(estado == 'edit'){
                   textos = "Datos Modificados Satisfactoriamente !";
               }
               else if(estado == 'create'){
                   textos = "Datos Registrados Satisfactoriamente !";
               }

               swal({
                   type : 'success',
                   title : 'Clientes',
                   text : textos,
                   confirmButtonText: 'Aceptar'
               }).then(function () {
                    tabla_clientes()
                    $('#modal-large').modal('hide');
               });
           },
           error : function (xhr) {
               var res = xhr.responseJSON;
               if ($.isEmptyObject(res) == false) {
                   $.each(res.errors, function (key, value) {
                       $('#' + key)
                           .closest('.form-group')
                           .addClass('has-error')
                           .append('<span class="help-block"><strong>' + value + '</strong></span>');
                   });
               }
           }
       });
    }
});

$('body').on('click', '.modal-cliente-destroy', function (event) {
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
                        title: 'Cliente',
                        text: 'Registro Eliminado Satisfactoriamente'
                    }).then(function(){
                        tabla_clientes();
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
});

function tabla_clientes() {
    $.ajax({
        url: 'clienteTabla',
        type:"GET",
        success: function (response) {
            $('#tabla-detalle').html(response);
        }
    });
}

$('body').on('click', '#btn-reporte-cliente', function (event) {
    event.preventDefault();

    $.ajax({
        url: 'clienteReporte',
        type:"GET",
        success: function (response) {
            $('#detalle-vista').html(response);
        }
    });
});


$('body').on('click',  '.btn-retornar', function (event) {
    event.preventDefault();
    window.location.href="clientes"
});

$('body').on('click',  '.btn-reporte-buscar', function (event) {
    event.preventDefault();
    personal_id = $('#personal_id').val()
    estado = $('#estado').val()
    $.ajax({
        url: 'clienteReporteTabla',
        data:{
            personal_id : personal_id,
            estado : estado
        },
        type: 'GET',
        success: function (response) {
           $('#reporte-tabla').html(response);
           $('a').removeClass("disabled");
        }
    });
});




