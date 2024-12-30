<div class="card card-navy card-outline" id="div_table_empresas">

    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda
                <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                <span class="text-nowrap">[ <b class="text-warning">{{ $rowsEmpresas }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Empresas [ <b class="text-warning">{{ $rowsEmpresas }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keyword)
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool d-sm-none" wire:click="createHide" @if(!comprobarPermisos('empresas.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($btnDisabled) disabled @endif>
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>

    <div class="card-body table-responsive p-0" id="table_empresas" wire:loading.class="invisible" wire:target="setLimit, actualizar, cerrarBusqueda, showHide, createHide" style="max-height: calc(100vh - {{ $size }}px)" >

        <table class="table table-head-fixed table-hover text-nowrap sticky-top">
            <thead>
            <tr class="text-lightblue">
                <th class="text-uppercase" style="width: 10%">
                    <!--Código-->
                    &nbsp;
                </th>
                <th>
                    <span class="text-uppercase">Nombre</span>
                    <small class="float-right">Rows {{ $listarEmpresas->count() }}</small>
                </th>
            </tr>
            </thead>
        </table>

        <!-- TO DO List -->
        <ul class="todo-list" data-widget="todo-list">
            @if($listarEmpresas->isNotEmpty())
                @foreach($listarEmpresas as $empresa)
                    <li class=" @if(/*$empresa->id == $empresas_id*/true) text-warning @endif ">

                        <!-- todo text -->
                        <span class="text">
                              codigo
                        </span>

                        <!-- Emphasis label -->
                        <small class="badge" style="cursor: pointer;">
                            <span class="text-uppercase text-truncate" style="max-width: 250px;">
                                {{ $empresa->nombre }}
                            </span>
                        </small>

                        <!-- General tools such as edit or delete-->
                        <div class="tools text-lightblue">
                            <i class="fas fa-eye"></i>
                        </div>

                    </li>
                @endforeach
            @else
                <li class="text-center">
                    <!-- todo text -->
                    @if($keyword)
                        <span class="text">Sin resultados</span>
                    @else
                        <span class="text">Sin registros guardados</span>
                    @endif
                </li>
            @endif

        </ul>
        <!-- /.TO DO List -->
    </div>

    <div style="z-index: 1025;">
        {!! verSpinner('setLimit, actualizar, cerrarBusqueda, showHide, createHide') !!}
    </div>

</div>



