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
        url: 'roles/create',
        type:"GET",
        success: function (response) {
            $('#modal-default-title').text(title);
            $('#modal-default-body').html(response);
            $('#modal-default').modal('show');
        }
    });
});