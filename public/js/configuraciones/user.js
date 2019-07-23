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

$('body').on('click', '.modal-user-edit', function (event) {
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

$('body').on('click', '.btn-agregar-usuario', function (event) {
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

$('body').on('click', '#btn-user-guardar', function (event) {
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
                    $('#modal-default').modal('hide');
                    mostrar_tabla();                    
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


function mostrar_tabla(){
    $.ajax({
        url: 'userTable',
        dataType: 'html',
        success: function (response) {
            $('#tabla-detalle').html(response);
        }
    });  
}

$('body').on('click', '.modal-reset-password', function (event) {
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

$('body').on('click', '#btn-reset-guardar', function (event) {
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
                if(response == "exito"){
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
                        $('#modal-default').modal('hide');
                        mostrar_tabla();                      
                    });                                      
                }
                else{
                    swal({
                        type : 'warning',
                        title : 'Usuario',
                        text : 'Contraseña Actual incorrecta'+response,
                        confirmButtonText: 'Aceptar'
                    })
                }              
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

$('body').on('click', '#btn-editar-usuario', function (event) {
    event.preventDefault();

    $.ajax({
        url: '/perfilEdit',
        dataType: 'html',
        success: function (response) {
            $('#datos-usuario').html(response);
        }
    });        
});

$('body').on('click', '.btn-cancelar', function (event) {
    event.preventDefault();

   window.location.href="perfil";
});

$('body').on('click', '#btn-perfil-guardar', function (event) {
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
                    window.location.href="perfil";                      
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