@extends('adminlte::page')

@section('title', 'Usuarios')

@include('dashboard.usuarios.header')

@section('content')
    @livewire('dashboard.usuarios-component')
    @livewire('dashboard.roles-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection


