@extends('adminlte::page')

@section('title', 'Recepcionar ')

@section('content_header')
    <h1>Recepción de Productos</h1>
    <a href="{{ route('gadministrativa.almacen.recepciones.create') }}" class="btn btn-success mt-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
@stop

@section('content')
    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop