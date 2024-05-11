@extends('adminlte::page')

@section('title', 'Alimentos')

@section('content')
    @include('admin.suggestion.foods.content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('admin.foods.styles')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-enterprise/dist/ag-grid-enterprise.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('admin.suggestion.foods.scripts')
@stop
