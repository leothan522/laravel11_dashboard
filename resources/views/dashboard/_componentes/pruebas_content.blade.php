<p>Welcome to this beautiful admin panel.</p>
<div class="row justify-content-between">
    <button type="button" class="btn btn-primary" wire:click="btnPrueba">LivewireAlert</button>
    <button type="button" class="btn btn-primary" onclick="btnToast()">Toast</button>
</div>

<div class="row justify-content-center" id="toastBootstrazp">
    <div class="position-fixed pr-4 pl-4" style="z-index: 5; top: 10%">
        <div id="liveToastP" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" {{--data-delay="2000"--}}>
            <div class="toast-header bg-success">
                <i class="fa fa-check"></i>
                <strong class="ml-2 mr-auto">Bootstrap</strong>
                <small>Subtitle</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body <!--bg-light-->">
                <div class="row">
                    <div class="col-12 p-2">
                        <div class="small-box" style="box-shadow: none; min-height: 50px;">
                            <div class="overlay">
                                <i class="far fa-5x fa-lightbulb opacity-75 text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-justify">
                        El registro que intenta borrar ya se encuentra vinculado con otros procesos.
                    </div>
                </div>
                <div class="row justify-content-between border-top mt-2 pt-2">
                    {{--<button type="button" class="btn btn-sm btn-primary">¡Sí, bórralo!</button>--}}
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="toast" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>




