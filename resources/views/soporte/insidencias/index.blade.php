@extends('adminlte::page')
@section('title', 'Repocitorio | Inicio')
@section('content_header')
    <h1>Lista de Insidencias</h1>
    <a href="{{route('soporte.insidencias.create')}}" class="btn btn-info">
        <i class="fas fa-clipboard-list"></i> Nuevo Registro
    </a>
@stop
@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong><i class="fas fa-check"></i> {{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong><i class="fas fa-exclamation-circle"></i> {{session('error')}}</strong>
    </div>
@endif
hola
@stop
@section('js')
    <script>
    $(document).ready(function(){
        setTimeout(() => {
        $("#info").hide();
    }, 9000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
    }, 9000);
    });
    </script>
@stop