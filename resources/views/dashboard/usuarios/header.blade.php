@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users-cog"></i> Usuarios</h1>
            </div>
            <div class="col-sm-6 d-none d-md-inline">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    @if(comprobarPermisos())
                        <li class="breadcrumb-item">
                            <a href="#" data-toggle="modal" onclick="verRoles()" data-target="#modal-default-roles">
                                <i class="fas fa-user-cog"></i> Roles de Usuario
                            </a>
                        </li>
                    @endif
                    @if(comprobarPermisos('dashboard.usuarios.excel'))
                        <li class="breadcrumb-item">
                            <a id="btn_header_exportar_excel" href="{{ route('dashboard.usuarios.excel') }}" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                                <i class="far fa-file-excel"></i> Exportar Excel
                            </a>
                        </li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
@endsection
