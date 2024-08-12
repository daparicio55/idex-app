@extends('adminlte::page')

@section('title', 'S. Académica | Licencias')

@section('content_header')
    <h1>Licencias de Estudios</h1>
    <a href="{{ route('sacademica.licencias.create') }}" class="btn btn-success mt-1">
        <i class="fas fa-newspaper"></i> Nuevo
    </a>
@stop
@section('content')
    <x-alert/>
    @include('sacademica.licencias.search')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>DNI</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th>Periodo</th>
                    <th>Resolucion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($licencias as $key => $licencia)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $licencia->matricula->estudiante->postulante->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($licencia->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($licencia->matricula->estudiante->postulante->cliente->nombre) }}</td>
                        <td>{{ $licencia->matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                        <td>{{ $licencia->matricula->matricula->nombre }}</td>
                        <td>{{ $licencia->observacion }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#m-edit-{{ $licencia->id }}" class="btn btn-success mt-1" title="Editar resolución" type="button">
                                <i class="far fa-edit"></i>
                            </button>
                            <button data-toggle="modal" data-target="#m-delete-{{ $licencia->id }}" class="btn btn-danger mt-1" title="Eliminar licencia" type="button">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>                 
                    </tr>
                    @include('sacademica.licencias.modal')
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop