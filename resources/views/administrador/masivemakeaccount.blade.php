@extends('adminlte::page')
@section('title', 'Reporte Ingresantes')
@section('content_header')
    <h1>Usuarios Creados</h1>
    <a href="{{ route('administrador.index') }}" class="btn btn-danger">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop
@section('content')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>APELLIDO, Nombre</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($users as $key => $usuario)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $usuario['dni'] }}</td>
                    <td>
                        {{ Str::upper($usuario['apellido']) }}, {{ Str::title($usuario['nombre']) }}
                    </td>
                    <td>{{ $usuario['contraseña'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop