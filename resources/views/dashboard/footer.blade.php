<div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0
</div>
<span>&copy; 2024 {{ config('app.name') }}
    | Dv. <a href="https://t.me/Leothan" target="_blank">Ing. Yonathan Castillo</a>
</span>

<div class="row justify-content-center" id="toastBootstrap">
    <div class="position-fixed pr-4 pl-4" style="z-index: 5; top: 10%">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" {{--data-autohide="false"--}} data-delay="2000">
            <div class="toast-header bg-success">
                <i class="fa fa-check"></i>
                <strong class="ml-2 mr-auto">Bootstrap</strong>
                <small>Subtitle</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body <!--bg-light-->">
                Hello, world! This is a toast message.
                {{--<div class="clearfix border-top mt-2 pt-2">
                    <button type="button" class="btn btn-sm btn-primary float-left">¡Sí, bórralo!</button>
                    <button type="button" class="btn btn-sm btn-default float-right" data-dismiss="toast" aria-label="Close">Cancelar</button>
                </div>--}}
            </div>
        </div>
    </div>
</div>
