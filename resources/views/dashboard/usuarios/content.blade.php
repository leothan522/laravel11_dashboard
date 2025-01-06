<div class="row justify-content-center">
    <div class="col-sm-8 col-md-5 col-lg-4 @if($ocultarCard) d-none @endif d-md-block">
        @include('dashboard.usuarios.show')
    </div>
    <div class="col-sm-8 col-md-5 col-lg-4 @if(!$form) d-none @endif ">
        @include('dashboard.usuarios.form')
    </div>
    <div class="col-md-7 col-lg-8 @if($form || $ocultarTable) d-none @endif">
        @include('dashboard.usuarios.table')
        @if(comprobarPermisos())
            <div class="d-md-none mb-2 text-center">
                <a href="#" data-toggle="modal" onclick="verRoles()" data-target="#modal-default-roles">
                    <i class="fas fa-user-cog"></i> Roles de Usuario
                </a>
            </div>
        @endif
        @if(comprobarPermisos('dashboard.usuarios.excel'))
            <div class="d-md-none mb-2 text-center">
                <a href="{{ route('dashboard.usuarios.excel', $keyword) }}" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                    <i class="far fa-file-excel"></i> Exportar Excel
                </a>
            </div>
        @endif
    </div>
</div>
