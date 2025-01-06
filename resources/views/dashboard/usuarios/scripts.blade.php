@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        function buscar(){
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                let url = "{{ route('dashboard.usuarios.excel', 'keyword') }}";
                document.querySelector("#btn_header_exportar_excel").href = url.replace("keyword", keyword);
                //document.querySelector("#btn_movile_exportar_excel").href = url.replace("keyword", keyword);
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        Livewire.on('delete', () => {
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
        });

        Livewire.on('deleteHide', () => {
            addClassinvisible('#div_show_header');
            addClassinvisible('#div_show_body');
            verCargando('div_show_user');
        });

        Livewire.on('deleteRole', () => {
            addClassinvisible('#div_footer_roles');
        });

        function verRoles() {
            addClassinvisible('#div_header_roles');
            addClassinvisible('#div_footer_roles');
            Livewire.dispatch('initModal');
        }

        function verPermisos(rowquid) {
            addClassinvisible('#div_header_roles');
            addClassinvisible('#div_footer_roles');
            Livewire.dispatch('showPermisos', { rowquid: rowquid });
        }
		
		Livewire.on('resetPassword', () => {
            verCargando('div_show_user');
        });

        console.log('Hi!');
    </script>
@endsection
