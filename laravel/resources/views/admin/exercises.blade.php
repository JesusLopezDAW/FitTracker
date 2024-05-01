@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    @include('admin.exercises.content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('admin.exercises.styles')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('admin.exercises.scripts')
@stop
