<div id="div_table_usuarios" class="card card-navy card-outline">

    <div class="card-header" wire:loading.class="invisible" wire:target="create, edit, showHide">

        <h3 class="card-title mb-2 mb-sm-auto">
            @if($keyword)
                Búsqueda
                <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                <span class="text-nowrap">[ <b class="text-warning">{{ $rows }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Todos [ <b class="text-warning">{{ $rows }}</b> ]
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
            <button class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('dashboard.usuarios.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($btnDisabled) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>

    </div>

    <div class="card-body table-responsive p-0" wire:loading.class="invisible" wire:target="create, edit, showHide" style="max-height: calc(100vh - {{ $size }}px)">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class="text-center text-uppercase" style="width: 5%">#</th>
                <th class="d-none d-lg-table-cell text-center text-uppercase" style="width: 5%"><i class="fas fa-cloud"></i></th>
                <th class="text-uppercase">nombre</th>
                <th class="d-none d-lg-table-cell text-uppercase">Email</th>
                <th class="d-none d-lg-table-cell text-uppercase">&nbsp;</th>
                <th class="d-none d-sm-table-cell text-uppercase text-center">Rol</th>
                <th class="d-none d-sm-table-cell d-md-none d-lg-table-cell text-uppercase" style="width: 5%">Estatus</th>
                <th class="text-center" style="width: 5%;"><small>Rows {{ $listarUsuarios->count() }}</small></th>
            </tr>
            </thead>
            <tbody id="tbody_usuarios" wire:loading.class="invisible" wire:target="actualizar, cerrarBusqueda, setLimit">
            @if($listarUsuarios->isNotEmpty())
                @php($i = 0)
                @foreach($listarUsuarios as $user)
                    <tr>
                        <td class="align-middle text-bold text-center">{{ ++$i }}</td>
                        <td class="align-middle d-none d-lg-table-cell text-bold text-center">
                            @if($user->plataforma)
                                <i class="fas fa-mobile-alt"></i>
                            @else
                                <i class="fas fa-desktop"></i>
                            @endif
                        </td>
                        <td class="align-middle d-table-cell text-truncate text-uppercase" style="max-width: 150px;">{{ $user->name }}</td>
                        <td class="align-middle d-none d-lg-table-cell text-truncate text-lowercase" style="max-width: 150px;">{{ $user->email }}</td>
                        <td class="align-middle d-none d-lg-table-cell">
                            @if($user->email_verified_at)
                                <small><i class="fas fa-check-double text-success"></i></small>
                            @endif
                        </td>
                        <td class="align-middle d-none d-sm-table-cell text-center">{{ verRole($user->role, $user->roles_id) }}</td>
                        <td class="align-middle d-none d-sm-table-cell d-md-none d-lg-table-cell text-center">
                            {!! $this->getEstatusUsuario($user->estatus, true) !!}
                        </td>
                        <td class="justify-content-end">

                            <div class="btn-group d-md-none">
                                <button wire:click="showHide('{{ $user->rowquid }}')" class="btn btn-primary"
                                        data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <div class="btn-group d-none d-md-flex">

                                <button type="button" wire:click="show('{{ $user->rowquid }}')" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button type="button" wire:click="edit('{{ $user->rowquid }}')" class="btn btn-primary btn-sm"
                                        @if($this->getComprobarPermisos($user)) disabled @endif >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" onclick="confirmToastBootstrap('delete',  { rowquid: '{{ $user->rowquid }}' })"  class="btn btn-primary btn-sm"
                                        @if($this->getComprobarPermisos($user, 'dashboard.usuarios.destroy')) disabled @endif >
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="8">
                        @if($keyword)
                            <span>Sin resultados</span>
                        @else
                            <span>Sin registros guardados</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>

    <div class="card-footer" wire:loading.class="invisible" wire:target="create, edit, showHide">
        <small>Mostrando {{ $listarUsuarios->count() }}</small>
    </div>

    {!! verSpinner('actualizar, cerrarBusqueda, setLimit, create, edit, showHide') !!}

</div>
