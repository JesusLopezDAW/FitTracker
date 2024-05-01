@extends('adminlte::page')

@section('title', 'XXXX')

@section('content')
    @include('admin.x.x')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('admin.x.x')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('admin.x.x')
@stop
