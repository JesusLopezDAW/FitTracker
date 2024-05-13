@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('admin.dashboard.content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts de Ag-Grid -->
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-enterprise/dist/ag-grid-enterprise.js"></script>
    
    <!-- Scripts de Ag-Charts -->
    <script src="https://cdn.jsdelivr.net/npm/ag-charts-enterprise@9.0.0/dist/umd/ag-charts-enterprise.js"></script> 
    <script src="{{ asset('js/scripts.js') }}"></script>
@stop