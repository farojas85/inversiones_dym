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
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
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
                   title : 'Usuario',
                   text : textos,
                   confirmButtonText: 'Aceptar'
               }).then(function () {
                    window.location="clientes";
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
    }).then(function(){
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
                    window.location="clientes";
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
    });
});