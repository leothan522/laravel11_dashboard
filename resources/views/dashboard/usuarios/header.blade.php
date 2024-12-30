@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users-cog"></i> Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    @if(comprobarPermisos())
                        <li class="breadcrumb-item text-primary">
                            <button type="button" class="btn btn-link " onclick="verRoles()" data-toggle="modal" data-target="#modal-default-roles">
                                Roles de Usuario
                            </button>
                        </li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
@endsection
