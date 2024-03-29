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
    $( "#fecha" ).flatpickr();
});
//AGREGAR ROLE
$('body').on('click', '#btn-agregar', function (event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('title');

    $.ajax({
        url: 'personalmontos/create',
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
                
                if(estado == 'edit'){
                    textos = "Datos Modificados Satisfactoriamente !";
                }
                else if(estado == 'create'){
                    textos = "Datos Registrados Satisfactoriamente !";   
                }

                swal({
                    type : 'success',
                    title : 'Asignación Montos',
                    text : textos,
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                     window.location="personalmontos";
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


$('body').on('click', '.modal-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');  

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#table-detalle').html(response);           
        }
    });        
});

$('body').on('click', '.modal-edit', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');  

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#table-detalle').html(response);           
        }
    });        
});

function editar_monto(id){
    document.getElementById('tr_edit_'+id).style.visibility="visible";
}
function cerrar(id){
    document.getElementById('tr_edit_'+id).style.visibility="hidden";
}