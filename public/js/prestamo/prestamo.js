var tabla;
$(document).ready(function() {
    // Default Datatable
    tabla = $('#prestamo-datatable').DataTable({
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
        url: 'prestamos/create',
        type:"GET",
        success: function (response) {
            $('#modal-large-title').text(title);
            $('#modal-large-body').html(response);
            $('#modal-large').modal('show');
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
                    title : 'Préstamos',
                    text : textos,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                   // console.log(response)
                    window.location="prestamos";
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

function mostrar_cobranza(id)
{   
    $.ajax({
        url: 'mostrarCobranza/'+id,
        type: 'GET',
        success: function (response) {   
            $('#view-detalle').html(response);
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
        success: function(datos){
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

$('body').on('keyup', '#monto', function (event) {
    event.preventDefault();
    cuota = $('#cuota').val();
    monto = $(this).val(); 
    saldo_ant = $('#saldo_anterior').val();

    cantidad_cuotas = parseFloat(monto/cuota).toFixed(2);
    $('#cantidad_cuotas').val(cantidad_cuotas);    
    $('#saldo_nuevo').val((saldo_ant - monto).toFixed(2));
});

$('body').on('keyup', '#pagado', function (event) {
    event.preventDefault();
    monto = $('#monto').val();
    pagado = $(this).val();
    $('#vuelto').val((pagado - monto).toFixed(2));
});

$('body').on('click', '#btn-guardar-cobranza', function (event) {
    event.preventDefault();

    estado = $(this).val();

    var form = $('#form'),
                url = form.attr('action'),
                method =form.attr('method');

    prestamo_id = $('#prestamo_id').val();

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
                    title : 'Cobranzas',
                    text : textos,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                    $('#modal-default').modal('hide');
                    //mostrar_tabla_cobros(prestamo_id);
                    window.location="prestamos";
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


function mostrar_tabla_cobros(prestamo_id){
    $.ajax({
        url: 'cobranzasTable/'+prestamo_id,
        type:"GET",
        success: function (response) {
            $('.table-responsive').html(response);
        }
    }); 
}

function imprimir_boleta(){
    var css = '@page { size: 74mm 105mm; margin: 0mm;}',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

    window.print();
}

$('body').on('click', '#btn-reporte', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: '/prestamoReporte',
        type:"GET",
        success: function (response) {
            if(response == 0){
                swal({
                    type : 'warning',
                    title : 'Reporte Préstamos',
                    text : 'No tiene Préstamo(s) Asignado(s)',
                    confirmButtonText: 'Aceptar'
                })
            }
            else{
                $('#modal-default-title').text(title);
                $('#modal-default-body').html(response);
                $('#modal-default').modal('show');
            }
        }
    });
});

$('body').on('click', '.destroy-prestamo', function (event) {
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
                        window.location="prestamos";
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


$('body').on('click', '.destroy-cobranza', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    prestamo_id = $('#prestamo_id').val();

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
                        title: 'Cobranzas',
                        text: 'Registro Eliminado Satisfactoriamente'
                    }).then(function(){
                        window.location.href="prestamos";
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Cobranzas',
                        text: xhr.responseText
                    });
                },
            });
        } 
    })
});



