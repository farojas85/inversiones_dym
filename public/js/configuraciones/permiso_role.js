function mostrar_permisos(role_id)
{   
    $.ajax({
        url: 'permisosRol',
        data:{
            role_id:role_id
        },
        dataType:"html",
        success: function (response) {
            $('#tabla-detalle').html(response);
        }
    });
}

$('body').on('click', '#btn-guardar', function (event) {
    event.preventDefault();

    role_id=$('#hdd_role_id').val();

    var form = $('#form'),
                url = form.attr('action'),
                method =form.attr('method');

    console.log(url+' '+method)

    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (response) {              
            textos = "Permisos Modificados Satisfactoriamente !";

            swal({
                type : 'success',
                title : 'Asignación de Permisos',
                text : textos,
                confirmButtonText: 'Aceptar'
            }).then(function () {
                window.location.href="permissionroles";
            });               
        },
        error : function (xhr) {
            swal({
                type: 'error',
                title: 'Asignación de Permisos',
                text: xhr.responseText
            });
        }
    });    
});
