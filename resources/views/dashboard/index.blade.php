@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Bienvenido al panel de administración.</p>
    <div class="visible-print">
        {!! qrCodeGenerate("https://t.me/Leothan") !!}
        <p class="text-lightblue"><i class="fab fa-telegram"></i> Telegram</p>
        <a href="{{ route('dashboard.pdf') }}" class="btn btn-default" target="_blank">Prueba Generar PDF</a>
    </div>
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        function search(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                alert('Falta vincular con el componente Livewire');
                //Livewire.emit('increment', keyword);
            }
            return false;
        }

        console.log('Hi!');
    </script>
@endsection
