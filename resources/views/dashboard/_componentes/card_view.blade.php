<div class="card card-navy card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="create, cancel, show, showHide">
        <h3 class="card-title">
            {{ $title }}
        </h3>

        <div class="card-tools">
            @if(!$form)
                <button type="button" class="btn btn-tool" wire:click="show('{{ $rowquid }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            @endif
            @if($btnNuevo)
                <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('empresas.create')) disabled @endif>
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            @if($btnCancelar)
                <button type="button" class="btn btn-tool" wire:click="cancel">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            @endif
            <button type="button" class="btn btn-tool " {{--data-card-widget="remove"--}}>
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body table-responsive" wire:loading.class="invisible" wire:target="create, cancel, save, show, showHide" style="max-height: calc(100vh - {{ $size + $sizeFooter }}px)">

        <form class="row" wire:submit="save">

            <div class="col-sm-7 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Información</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-book"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) p-0 @endif ">
                        @if($form)
                            @include('dashboard.empresas.form')
                        @else
                            @include('dashboard.empresas.show')
                        @endif
                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-lg-6">

                <div class="card card-outline card-navy">

                    <div class="card-header">
                        <h5 class="card-title">Imagen</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-image"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) attachment-block p-0 m-0 @endif ">
                        @if($form)
                            {{-- @include('dashboard.empresas.form_imagen')--}}
                        @else
                            @include('dashboard.empresas.show_imagen')
                        @endif
                    </div>
                </div>

            </div>

            @if($form)
                <div class="col-12">
                    <div class="col-md-4 float-right">
                        <button type="submit" class="btn btn-block @if($empresas_id) btn-primary @else btn-success @endif">
                            <i class="fas fa-save mr-1"></i>
                            Guardar
                            @if($empresas_id)
                                Cambios
                            @endif
                        </button>
                    </div>
                </div>
            @endif


        </form>

    </div>

    @if(!$form && comprobarAccesoEmpresa(auth()->user()->permisos, auth()->id()))
        <div class="card-footer text-center" wire:loading.class="invisible" wire:target="create, cancel, show, showHide">

            @if($empresas_id != $empresaDefault)
                @if(auth()->user()->role == 100)
                    <button type="button" class="btn btn-default btn-sm mr-1" onclick="confirmToastBootstrap('delete', { rowquid: '{{ $rowquid }}'})"
                            @if(!comprobarPermisos('empresas.destroy')) disabled @endif>
                        <i class="fas fa-trash-alt"></i> Borrar
                    </button>
                @endif
                <button type="button" class="btn btn-default btn-sm mr-1" wire:click="convertirDefault"
                        @if(!comprobarPermisos('empresas.edit')) disabled @endif>
                    <i class="fas fa-certificate"></i> Convertir en Default
                </button>
            @endif

            <button type="button" class="btn btn-default btn-sm" wire:click="btnHorario"
                    @if(!comprobarPermisos('empresas.horario')) disabled @endif>
                <i class="fas fa-clock"></i> Horario
            </button>

            <button type="button" class="btn btn-default btn-sm" wire:click="edit"
                    @if(!comprobarPermisos('empresas.edit')) disabled @endif>
                <i class="fas fa-edit"></i> Editar Información
            </button>

            <button type="button" class="btn btn-tool d-md-none" wire:click="showHide">
                <i class="fas fa-times"></i>
            </button>

        </div>
    @endif

    {!! verSpinner('create, cancel, save, show, showHide') !!}

</div>
