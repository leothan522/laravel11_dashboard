<div class="row justify-content-center">

    <div class="col-md-4 col-lg-3">
        @include('dashboard.parametros.form')
        <label>Parametros Manuales</label>
        <ul>
            <li>numRowsPaginate[null|numero]</li>
            <li>size_codigo[tamaño|null]</li>
            {{--<li>iva</li>
            <li>telefono_soporte</li>
            <li>codigo_pedido</li>--}}
        </ul>
    </div>

    <div class="col-md-8 col-lg-9">
        @include('dashboard.parametros.table')
    </div>

</div>
