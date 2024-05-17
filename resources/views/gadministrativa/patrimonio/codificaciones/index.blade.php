@extends('adminlte::page')

@section('title', 'Patrimonio - Codificaciones')

@section('content_header')
    <h1>Codificación de Bienes</h1>
    <a href="{{ route('gadministrativa.patrimonio.codificaciones.create') }}" class="btn btn-success mt-2">
        <i class="fas fa-plus"></i> Nuevo
    </a>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop