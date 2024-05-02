@extends('errors::layout')

@section('title', 'Acceso prohibido')

@section('css')
    @include('errors.403.styles')
@stop

@section('message')
    @include('errors.403.content')
@stop