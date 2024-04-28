@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    @include('admin.users.content')
@stop

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
@include('admin.users.styles')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>
    
    @include('admin.users.scripts')
    @stop
    
    <script src="{{ asset('js/scripts.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">