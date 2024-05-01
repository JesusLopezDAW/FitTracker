@extends('adminlte::page')

@section('title', 'Alimentos')

@section('content')
    @include('admin.foods.content')
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('admin.foods.styles')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('admin.foods.scripts')
@stop
