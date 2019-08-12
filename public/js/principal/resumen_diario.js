$( "#fecha_ini" ).flatpickr({
    locale: {
        firstDayOfWeek: 7,
        weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
    },
});
$( "#fecha_fin" ).flatpickr({
    locale: {
        firstDayOfWeek: 7,
        weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
    },
});

function mostrar_busqueda(){
    var personal_id = $('#personal_id').val();
    var fecha_ini  = $('#fecha_ini').val();
    var fecha_fin = $('#fecha_fin').val();

    $.ajax({
        url: '/resumendia',
        data:{
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            personal_id: personal_id
        },
        dataType:"html",
        success: function (response) {
            $('#tabla-detalle').html(response);
        }
    });
}

function exportar(){
    var personal_id = $('#personal_id').val();
    var fecha_ini  = $('#fecha_ini').val();
    var fecha_fin = $('#fecha_fin').val();

    $.ajax({
        url: '/resumen/exportar',
        data:{
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            personal_id: personal_id
        },
        dataType:"html",
        success: function (response) {
            swal({
                type: 'success',
                title: 'Exportar Registros',
                text: 'Excel descargado Satisfactoriamente'
            });
        }
    });
}
