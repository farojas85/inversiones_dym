$('#model-datatable').DataTable({
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

$('body').on('click', '#btn-agregar', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'personalsalarios/create',
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
               console.log(response.id)
               if(estado == 'edit'){
                   textos = "Datos Modificados Satisfactoriamente !";
               }
               else if(estado == 'create'){
                   textos = "Datos Registrados Satisfactoriamente !";   
               }
                swal({
                    type : 'success',
                    title : 'Pago al Personal',
                    text : textos,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                    $('#modal-large').modal('hide');
                    $.ajax({
                        url: 'pdfPagos',
                        data:{
                            id : response.id
                        },
                        type: 'GET',
                        success: function (response) {
                           $('#pago-table').html(response);
                        }
                    });
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

function mostrar_pago_pdf(id)
{
    $.ajax({
        url: 'pdfPagos',
        data:{
            id : id
        },
        type: 'GET',
        success: function (response) {
           $('#pago-table').html(response);
        }
    });
}

$('body').on('click', '#btn-adelantos', function (event) {
    event.preventDefault();
    adelantos = $('#adelantos').val();

    personal_id = $('#personal_id').val();
    mes_pago = $('#mes_pago').val();

    if(adelantos == '' || adelantos == null){
        swal({
            type: 'warning',
            title: 'Adelantos',
            text:'Seleccione Personal'
        });
    }
    else if(adelantos == 0){
        swal({
            type: 'warning',
            title: 'Adelantos',
            text:'No cuenta con Adelantos'
        });
    }
    else{
        $.ajax({
            url: 'tableAdelantos',
            data:{
                personal_id:personal_id,
                mes_pago:mes_pago
            },
            type:"GET",
            success: function (response) {
                $('#span-detalle-adelantos').html(response);
            }
        });
    }    
});


$('body').on('click', '.modal-show', function (event) {
    event.preventDefault();

    var me = $(this),
    url = me.attr('href'),
    title = me.attr('title');  

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#pago-table').html(response);
        }
    });
});


function mostrar_datos(personal_id){
    event.preventDefault();   

    obtener_sueldo(personal_id);
    //obtener_adelantos(personal_id);
    
}

function obtener_sueldo(personal_id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: 'sueldoPersonal',
        type: 'POST',
        data:{
            personal_id:personal_id,
            _token: CSRF_TOKEN,
            '_method':'POST'
        },
        dataType: 'JSON',
        success: function (data) {
            if(data.sueldo == null || data.sueldo==''){
                $('#sueldo').val('0.00');
            }
            else{
                $('#sueldo').val(data.sueldo);
            }
        },
        error: function (xhr) {
            if(personal_id == null || personal_id== ''){
                swal({
                    type: 'error',
                    title: 'Advertencia',
                    text: 'Seleccione un Personal'
                });
            }
            else{
                swal({
                    type: 'error',
                    title: 'Advertencia',
                    text: xhr.responseText
                });
            }            
        },
    });
}

function obtener_adelantos(personal_id){
    event.preventDefault();   
    mes_pago = $('#mes_pago').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    //console.log(personal_id+' '+mes_pago)
    $.ajax({
        url: 'adelantosPersonal',
        type: 'POST',
        data:{
            personal_id:personal_id,
            mes_pago : mes_pago,
            _token: CSRF_TOKEN,
            '_method':'POST'
        },
        dataType: 'JSON',
        success: function (data) {
            if(data[0].adelantos == '' || data[0].adelantos == null){
                $('#adelantos').val('0.00');
            }
            else{
                $('#adelantos').val(data[0].adelantos);
            }            
        },
        error: function (xhr) {
            if(personal_id == null || personal_id== '' || mes_pago == null || mes_pago== '' ){
                swal({
                    type: 'error',
                    title: 'Advertencia',
                    text: 'Seleccione un Personal y/o Mes pago'
                });
            }
            else{
                swal({
                    type: 'error',
                    title: 'Advertencia',
                    text: xhr.responseText
                });
            }            
        },
    });
}

function imprimir_boleta()
{
    var css = '@page { size: 210mm 148mm; margin: 0mm;}',
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
    //swal({type: 'error',title: 'Advertencia',text: 'Listo Imprimir'});
}