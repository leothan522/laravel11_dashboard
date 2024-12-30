<!-- Profile Image -->
<div id="div_show_user" class="card card-navy card-outline">
    <div id="div_show_header" class="card-header border-0 d-md-none" wire:loading.class="invisible" wire:target="showHide, editHide">
        <div class="card-tools">
            <button type="button" class="btn btn-tool" onclick="confirmToastBootstrap('deleteHide',  { rowquid: '{{ $rowquid }}' })" @if($verBorrar) disabled @endif>
                <i class="fas fa-trash-alt"></i> Borrar
            </button>
            <button type="button" class="btn btn-tool" wire:click="editHide" @if($verEditar) disabled @endif>
                <i class="fas fa-edit"></i> Editar
            </button>
            <button type="button" class="btn btn-tool" wire:click="showHide">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div id="div_show_body" class="card-body box-profile" wire:loading.class="invisible" wire:target="show, showHide, editHide">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ verImagen(null, true) }}" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center my-3 text-uppercase">
            @if($verName)
                {{ $verName }}
            @else
                &nbsp;
            @endif
        </h3>

        <p class="text-muted text-center d-none">Software Engineer</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Email:</b> <a class="float-right">{{ $verEmail }}</a>
            </li>
            <li class="list-group-item">
                <b>Rol:</b> <a class="float-right">{{ $verRole }}</a>
            </li>
            <li class="list-group-item">
                <b>Estatus:</b> <a class="float-right">{!! $verEstatus  !!}</a>
            </li>
            <li class="list-group-item">
                <b>Registro:</b> <a class="float-right">{{ $verRegistro }}</a>
            </li>
            @if(comprobarPermisos() && $users_id != auth()->id() && !$form)
                <li class="list-group-item text-center">
                    <span class="text-primary" onclick="verPermisos('{{ $rowquid }}')" data-toggle="modal" data-target="#modal-default-roles" style="cursor: pointer;">Ver Permisos</span>
                </li>
            @endif
            @if($newPassword)
                <li class="list-group-item">
                    <div class="row justify-content-between">
                        <b class="col-6 text-nowrap">Nueva Contraseña:</b>
                        <div class="input-group col-6 text-right">
                            <input type="text" wire:model="newPassword" class="form-control form-control-sm float-right" placeholder="{{ __('Password') }}">
                            <div class="input-group-append">
                                <button type="button" onclick="copiarPortapapeles('{{ $newPassword }}')" class="input-group-text"><i class="fas fa-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        </ul>

        <div class="row @if($form) d-none @endif">
            <div class="col-6">
                <button type="button" wire:click="setEstatus" class="btn @if($estatus) btn-danger @else btn-success @endif btn-block" @if(!$users_id || $btnEstatus) disabled @endif>
                    <b>
                        <span class="text-nowrap">
                            @if($estatus) Suspender @else Reactivar @endif
                        </span>
                        <br>
                        <span class="text-nowrap">Usuario</span>
                    </b>
                </button>
            </div>
            <div class="col-6">
                <button type="button" wire:click="resetPassword" class="btn btn-secondary btn-block" @if(!$users_id || $btnReset) disabled @endif>
                    <b>
                        <span class="text-nowrap">Restablecer</span>
                        <br>
                        <span class="text-nowrap">Contraseña</span>
                    </b>
                </button>
            </div>
        </div>

    </div>
    {!! verSpinner('show, setEstatus, resetPassword, showHide, editHide') !!}
</div>
