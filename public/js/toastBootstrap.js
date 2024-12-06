window.addEventListener('toastBootstrap', async (event) => {

    const toast = event.detail.toast;
    let type = event.detail.type;

    const colores = {
        success: "bg-success",
        info: "bg-info",
        error: "bg-danger",
        warning: "bg-warning"
    };

    const iconos = {
        success: '<i class="fas fa-check"></i>',
        info: '<i class="fas fa-info"></i>',
        error: '<i class="fas fa-exclamation-triangle"></i>',
        warning: '<i class="fas fa-exclamation-circle"></i>'
    };

    const titulos = {
        success: "¡Éxito!",
        info: "Información",
        error: "¡Error!",
        warning: "¡Alerta!"
    };

    let textMessage;
    let textTitle;

    if (document.querySelector('#toastBootstrap')) {

        if (toast) {

            document.querySelector('#toastBootstrap').innerHTML = '<div class="position-fixed pr-4 pl-4" style="z-index: 2050; top: 7%"> ' +
                '<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" style="min-width: 232px;"> ' +
                '<div id="liveToastClass" class="toast-header"> ' +
                '<span id="liveToastIcon"><i class="fa fa-check"></i></span> ' +
                '<strong id="liveToastTitle" class="ml-2 mr-auto">Bootstrap</strong> ' +
                '<small id="liveToastSubTitle"></small> ' +
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> ' +
                '<span aria-hidden="true">&times;</span> ' +
                '</button> ' +
                '</div> ' +
                '<div class="toast-body bg-light"> ' +
                '<span id="liveToastMessage">Hello, world! This is a toast message.</span> ' +
                '</div> ' +
                '</div> ' +
                '</div>';
            textMessage = "Datos Guardados.";
            textTitle = event.detail.title ? event.detail.title : titulos[type];

        } else {

            document.querySelector('#toastBootstrap').innerHTML = '<div class="position-fixed pr-4 pl-4" style="z-index: 2050; top: 40%"> ' +
                '<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="min-width: 232px;"> ' +
                '<div id="liveToastClass" class="toast-header"> ' +
                '<span id="liveToastIcon"><i class="fa fa-check"></i></span> ' +
                '<strong class="ml-2 mr-auto"><span id="liveToastTitle">Bootstrap</span></strong> ' +
                '<small id="liveToastSubTitle"></small> ' +
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> ' +
                '<span aria-hidden="true">&times;</span> ' +
                '</button> ' +
                '</div> ' +
                '<div class="toast-body bg-light"> ' +
                '<span id="liveToastMessage">Hello, world! This is a toast message.</span> ' +
                '<div class="row justify-content-between border-top mt-2 pt-2"> ' +
                '<button id="liveToastBtnSi" type="button" class="btn btn-sm btn-primary" data-dismiss="toast" aria-label="Close">¡Sí, bórralo!</button> ' +
                '<button id="liveToastBtnNO" type="button" class="btn btn-sm btn-default" data-dismiss="toast" aria-label="Close">Cancelar</button> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '</div>';
            textMessage = "¡No podrás revertir esto!";

            const liveToastBtnSi = document.querySelector('#liveToastBtnSi');
            const liveToastBtnNO = document.querySelector('#liveToastBtnNO');
            const confirmed = event.detail.confirmed ? event.detail.confirmed : "NoCallBack";

            if (confirmed !== "NoCallBack"){
                textTitle = event.detail.title ? "¿" + event.detail.title + "?" : "¿Estas seguro?";
                const btnSi = event.detail.button ? event.detail.button : "¡Sí, bórralo!";
                const btnNo = event.detail.cancel ? event.detail.cancel : "Cancelar";
                liveToastBtnSi.textContent = btnSi;
                liveToastBtnNO.textContent = btnNo;
                liveToastBtnSi.addEventListener('click', function () {
                    Livewire.dispatch(confirmed);
                });
            }else {
                textTitle = event.detail.title ? event.detail.title : titulos[type];
                const btnNo = event.detail.cancel ? event.detail.cancel : "OK";
                /*liveToastBtnNO.classList.remove('btn-default');
                liveToastBtnNO.classList.add('btn-primary')*/
                liveToastBtnNO.textContent = btnNo;
                liveToastBtnSi.classList.add('d-none');
            }

        }

        const liveToastClass = document.querySelector('#liveToastClass');
        const liveToastIcon = document.querySelector('#liveToastIcon');
        const liveToastTitle = document.querySelector('#liveToastTitle');
        const liveToastSubTitle = document.querySelector('#liveToastSubTitle');
        const liveToastMessage = document.querySelector('#liveToastMessage');


        const color = event.detail.color ? event.detail.color : colores[type];
        const icon = event.detail.icon ? event.detail.icon : iconos[type];
        const subtitle = event.detail.subtitle ? event.detail.subtitle : "";
        const message = event.detail.message ? event.detail.message : textMessage;

        liveToastClass.classList.add(color);
        liveToastIcon.innerHTML = icon;
        liveToastTitle.textContent = textTitle;
        liveToastSubTitle.textContent = subtitle;
        liveToastMessage.innerHTML = message;

        $('#liveToast').toast('show');

    }else{
        alert('Falta incluir con php en el html la funcion verToastBootstrap()')
        console.log('Falta agregar el selector #toastBootstrap')
    }

});

function toastBootstrap(options = { toast: true, type: 'success', }) {
    this.dispatchEvent(new CustomEvent('toastBootstrap', {
        bubbles: true,
        detail: options
    }));
}

window.flashToastBootstrap = async (flash) => {
    var events = flash.events;
    var data = flash.events.data;
    var options = flash.options;
    alert('hgola');
};

console.log('toastBootstrap.js');
