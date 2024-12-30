<div wire:ignore.self class="modal fade" id="modal-show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    Ver Municipio
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" wire:loading.class="invisible">

                <div class="col-12 p-0">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span>Nombre</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">Yonathan Leonardo</span>
                        </li>
                        <li class="list-group-item">
                            <span>Nombre</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">Yonathan Leonardo</span>
                        </li>
                        <li class="list-group-item">
                            <span>Nombre</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">Yonathan Leonardo</span>
                        </li>
                        <li class="list-group-item">
                            <span>Nombre</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">Yonathan Leonardo</span>
                        </li>

                    </ul>

                </div>

            </div>

            <div class="modal-footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible">

                    <div class="btn-group">

                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-check"></i>
                        </button>

                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_show_municipios">
                        Cerrar
                    </button>

                </div>

            </div>

            {!! verSpinner() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

