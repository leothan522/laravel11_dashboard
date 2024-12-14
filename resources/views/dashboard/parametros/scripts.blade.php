@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        Livewire.on('cerrarModal', () => {
            $("#btn_modal_default").click();
            setTimeout(function () {
                addClassinvisible("#tbody_parametros");
                verCargando('div_table_parametros');
            });
        });

        Livewire.on('delete', () => {
            addClassinvisible("#tbody_parametros");
            verCargando('div_table_parametros');
        });

        Livewire.on('buscar', () => {
            addClassinvisible("#tbody_parametros");
            verCargando('div_table_parametros');
        });

        console.log('Hi!');
    </script>
@endsection
