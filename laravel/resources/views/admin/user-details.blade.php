@extends('adminlte::page')

@section('title', 'Detalles usuario')

@section('content')
    @include('admin.user-details.content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('admin.user-details.styles')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-enterprise/dist/ag-grid-enterprise.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('admin.user-details.scripts')
@stop
