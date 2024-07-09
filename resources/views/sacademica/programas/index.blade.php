@extends('adminlte::page')

@section('title', 'Programas de Estudios')

@section('content_header')
    <h1>Programas de Estudios</h1>
    <a href="">
        <button type="button" class="btn btn-primary mt-2">
            <i class="fas fa-plus"></i> Nuevo Programa
        </button>
    </a>
@stop

@section('content')
<x-alert/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Itinerario</th>
                <th>Visible</th>
                <th>Anterior</th>
            </thead>
            <tbody>
                @foreach ($programas as $programa)
                    <tr>
                        <td>{{ $programa->idCarrera }}</td>
                        <td>{{ $programa->nombreCarrera }}</td>
                        <td>{{ $programa->itinerario->nombre }}</td>
                        <td>{{ $programa->observacionCarrera }}</td>
                        <td>{{ $programa->anterior ? $programa->anterior->nombreCarrera : null }}</td>
                        <td>
                            <a href="{{ route('sacademica.programas.edit',$programa->idCarrera) }}" class="btn btn-success" title="Editar Programa de Estudios">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop