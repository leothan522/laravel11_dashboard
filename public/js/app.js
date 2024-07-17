//CAMPO BUSQUEDA EN EL NAVBAR
$("#navbarSearch").focus(function(){
    let form = $(this).closest("form");
    form.attr("onsubmit","return search()");
});

$(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('.swalDefaultInfo').click(function() {
        Toast.fire({
            icon: 'info',
            title: 'Generando Archivo'
        })
    });

});

