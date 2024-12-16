@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const btnCerrarModal = document.querySelector("#btn_modal_default");

        Livewire.on('cerrarModal', () => {
            btnCerrarModal.click();
            setTimeout(function () {
                addClassinvisible("#tbody_parametros");
                verCargando('div_table_parametros');
            });
        });

        Livewire.on('delete', () => {
            btnCerrarModal.click();
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
