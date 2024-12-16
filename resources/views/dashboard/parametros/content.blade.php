<div class="row justify-content-center">
    <div class="d-none d-md-block col-md-4 col-lg-3">
        @include('dashboard.parametros.manual')
    </div>
    <div class="col-md-8 col-lg-7">
        @include('dashboard.parametros.table')
        @include('dashboard.parametros.form')
    </div>
</div>

<div class="row d-md-none justify-content-center">
    <div class="col-12">
    @include('dashboard.parametros.manual')
    </div>
</div>
