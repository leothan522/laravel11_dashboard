<div class="row justify-content-center">
    <div class="col-sm-8 col-md-5 col-lg-4 @if($ocultarCard)  d-none @endif d-md-block">
        @include('dashboard.usuarios.show')
    </div>
    <div class="col-sm-8 col-md-5 col-lg-4 @if(!$form) d-none @endif ">
        @include('dashboard.usuarios.form')
    </div>
    <div class="col-md-7 col-lg-8 @if($form || $ocultarTable) d-none @endif">
        @include('dashboard.usuarios.table')
    </div>
</div>
