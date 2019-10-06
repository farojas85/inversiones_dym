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
                "sLast":     "Ultimo",
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

$('body').on('click', '#btn-buscar', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'personalgastos/busqueda_modal',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text(title);
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });
});

$('body').on('click', '#btn-agregar', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'personalgastos/create',
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

    if ($('#form').parsley().isValid()) {
        $.ajax({
           url : url,
           method: method,
           data : form.serialize(),
           success: function (response) {
                swal({
                    type : 'success',
                    title : 'Pago al Personal',
                    text : response,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                    $('#modal-default').modal('hide');
                    mostrar_tabla();
                });             
           },
           error : function (xhr) {
               var res = xhr.errors.text;
               swal({
                    type : 'error',
                    title : 'Gasto de Personal',
                    text : res,
                    confirmButtonText: 'Aceptar'
                });
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
                    title: 'Adelanto Personal',
                    text: response
                }).then(function(){
                    mostrar_tabla();
                });
            },
            error: function (xhr) {
                swal({
                    type: 'error',
                    title: 'Adelanto Personal',
                    text: xhr.responseText
                });
            },
        });
    });
});

function mostrar_tabla()
{
    $.ajax({
        url: 'personalgastos/table',
        type: 'GET',
        success: function (response) {
           $('#tabla-detalle').html(response);
        }
    });
}

$('body').on('click',  '.btn-generar-reporte', function (event) {
    event.preventDefault()
    personal_id = $('#personal_id').val()
    fecha_inicio = $('#fecha_inicio').val()
    fecha_final = $('#fecha_final').val()

    $('#form').parsley().validate();

    if ($('#form').parsley().isValid()) {
        $.ajax({
            url: '/personalgastos/reporte',
            data:{
                personal_id : personal_id,
                fecha_inicio : fecha_inicio,
                fecha_final : fecha_final
            },
            type: 'GET',
            success: function (response) {
                $('#section-body').html(response)
                $('#modal-default').modal('hide')
            }
        });
    }
});