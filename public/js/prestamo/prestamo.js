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
                    window.location="clienteprestamos";
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

    id=$('#prestamo_id').val();
    minsaldo = $('#min_saldo').val();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'nuevaCobranza/'+id+'/'+minsaldo,
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text(title);
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });
});

$('body').on('keyup', '#monto', function (event) {
    event.preventDefault();
    monto = $('#monto').val();
    saldo_ant = $('#saldo_anterior').val();
    $('#saldo_nuevo').val((saldo_ant -monto).toFixed(2));
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
                    mostrar_tabla_cobros(prestamo_id);
                    //window.location="prestamos";
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

