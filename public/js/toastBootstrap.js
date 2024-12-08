window.addEventListener('toastBootstrap', async (event) => {

    const toast = event.detail.toast;
    let type = event.detail.type;

    const htmlToast = '<div class="position-fixed pr-4 pl-4" style="z-index: 2050; top: 7%"> ' +
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

    const htmlConfirm = '<div class="position-fixed pr-4 pl-4" style="z-index: 2050; top: 40%"> ' +
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
        '<div class="row justify-content-between border-top mt-2 pt-2 pl-2 pr-2"> ' +
        '<button id="liveToastBtnSi" type="button" class="btn btn-sm btn-primary " data-dismiss="toast" aria-label="Close">¡Sí, bórralo!</button> ' +
        '<button id="liveToastBtnNO" type="button" class="btn btn-sm btn-default " data-dismiss="toast" aria-label="Close">Cancelar</button> ' +
        '</div> ' +
        '</div> ' +
        '</div> ' +
        '</div>';

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

            document.querySelector('#toastBootstrap').innerHTML = htmlToast;
            textTitle = event.detail.title ? event.detail.title : titulos[type];
            textMessage = "Datos Guardados.";

        } else {

            document.querySelector('#toastBootstrap').innerHTML = htmlConfirm;
            const liveToastBtnSi = document.querySelector('#liveToastBtnSi');
            const liveToastBtnNO = document.querySelector('#liveToastBtnNO');

            const confirmed = event.detail.confirmed ? event.detail.confirmed : "NoCallBack";
            const parametros = event.detail.parametros ? event.detail.parametros : "NoParametros";
            let btnSi;
            let btnNo;

            if (confirmed !== "NoCallBack"){
                textTitle = event.detail.title ? "¿" + event.detail.title + "?" : "¿Estas seguro?";
                btnSi = event.detail.button ? event.detail.button : "¡Sí, bórralo!";
                btnNo = event.detail.cancel ? event.detail.cancel : "Cancelar";
                liveToastBtnSi.addEventListener('click', function () {
                    if (parametros !== "NoParametros"){
                        Livewire.dispatch(confirmed, parametros);
                    }else{
                        Livewire.dispatch(confirmed);
                    }
                });
            }else {
                textTitle = event.detail.title ? event.detail.title : titulos[type];
                btnSi = event.detail.button ? event.detail.cancel : "btn Inactivo";
                btnNo = event.detail.cancel ? event.detail.cancel : "OK";
                liveToastBtnSi.classList.add('d-none');
            }

            textMessage = "¡No podrás revertir esto!";
            liveToastBtnSi.textContent = btnSi;
            liveToastBtnNO.textContent = btnNo;

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
        console.log('Falta incluir en el html: \n <!-- Toast Bootstrap con JS --> \n <div id="toastBootstrap"> \n \t <!-- JS --> \n </div>');
        alert('Toast Bootstrap: Falta Elemento, ver mas detalles en consola.');
    }

});

function toastBootstrap(options = { toast: true, type: 'success', }) {
    this.dispatchEvent(new CustomEvent('toastBootstrap', {
        bubbles: true,
        detail: options
    }));
}

window.flashToastBootstrap = async (flash) => {
    toastBootstrap(flash);
};

function confirmToastBootstrap(confirmed = null, params = "NoParametros", options = { toast: false, type: 'warning', }) {
    options.confirmed = confirmed;
    if (params !== "NoParametros"){
        options.parametros = params;
    }
    this.dispatchEvent(new CustomEvent('toastBootstrap', {
        bubbles: true,
        detail: options
    }));
}

console.log('toastBootstrap');
