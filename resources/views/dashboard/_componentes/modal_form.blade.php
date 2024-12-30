<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title" wire:loading.class="invisible" wire:target="limpiar">
                        @if($parametros_id)
                            Crear
                        @else
                            Editar
                        @endif
                            Parametro
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" wire:loading.class="invisible">

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Nombre:</small>
                        <div class="input-group">
                            <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
                            @error('nombre')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">tabla_id:</small>
                        <div class="input-group">
                            <input type="number" wire:model="tabla_id" class="form-control @error('tabla_id') is-invalid @enderror" placeholder="Tabla_id">
                            @error('tabla_id')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">valor:</small>
                        <div class="input-group">
                            <input type="text" wire:model="valor" class="form-control @error('valor') is-invalid @enderror" placeholder="Valor">
                            @error('valor')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target="limpiar, edit">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                        <button type="submit" class="btn  @if($parametros_id) btn-primary @else btn-success @endif ">
                            Guardar @if($parametros_id) Cambios @endif
                        </button>
                    </div>

                </div>

                {!! verSpinner() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

