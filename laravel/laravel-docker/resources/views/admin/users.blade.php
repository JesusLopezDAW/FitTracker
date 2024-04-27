@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    @include('admin.users.content')
@stop

@section('css')
    @include('admin.users.styles')
@stop

@section('js')
    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    @include('admin.users.scripts')
@stop
