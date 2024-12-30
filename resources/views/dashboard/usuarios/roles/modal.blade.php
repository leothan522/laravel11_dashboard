<div wire:ignore.self class="modal fade" id="modal-default-roles">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 id="div_header_roles" class="modal-title">
                    @if($tabla == "parametros")
                        Roles de Usuario
                    @else
                        Permisos de Usuario
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body" wire:loading.class="invisible" wire:target.except="setPermisos" style="min-height: 174px;">


                <div class="row justify-content-center">

                    @if($tabla == "parametros")
                        <form wire:submit="save" class="col-md-8 mb-3">
                            <small class="text-lightblue text-bold text-uppercase">{{ $title }}:</small>
                            <div class="input-group">
                                <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
                                <span class="input-group-append">
                                <button type="submit" class="btn @if($roles_id) btn-primary @else btn-success @endif">
                                    <i class="fas fa-save"></i>
                                </button>
                            </span>
                                @error('nombre')
                                <span class="error invalid-feedback text-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    @else
                        <div class="invisible d-none d-sm-block" style="height: 62px;">
                            usuario
                        </div>
                    @endif

                    @if(!$verPermisos)
                        <div class="col-md-8">
                            @include('dashboard.usuarios.roles.list-roles')
                        </div>
                    @else
                        <div class="row col-12 justify-content-center">
                            @include('dashboard.usuarios.roles.list-permisos')
                        </div>
                    @endif

                </div>


            </div>
            <div id="div_footer_roles" class="modal-footer @if($verPermisos) justify-content-between @endif" wire:loading.class="invisible" wire:target="show, cancel, savePermisos">
                @if($verPermisos)
                    <button type="button" class="btn btn-danger @if($tabla != "parametros") d-none @endif" onclick="confirmToastBootstrap('deleteRole')"><i class="fas fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-primary" wire:click="savePermisos" @if(!$cambios) disabled @endif >Actualizar Permisos</button>
                    <button type="button" class="btn btn-default @if($tabla != "parametros") d-none @endif" wire:click="cancel">Volver</button>
                    @if($tabla != "parametros")
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                    @endif
                @else
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                @endif
            </div>
            {!! verSpinner() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
