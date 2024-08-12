@extends('adminlte::page')

@section('title', 'S. Académica | Reingresos')

@section('content_header')
    <h1>Registro de Reingresos</h1>
    <a class="btn btn-success mt-1" href="{{ route('sacademica.reingresos.create') }}">
        <i class="fas fa-door-open"></i> Nuevo
    </a>
@stop
@section('content')
    <x-alert/>
    @include('sacademica.reingresos.search')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>APELLIDOs, Nombres</th>
                    <th>Observacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reingresos as $reingreso)
                    <tr>
                        <td>{{ $reingreso->licencia->matricula->estudiante->postulante->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($reingreso->licencia->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($reingreso->licencia->matricula->estudiante->postulante->cliente->nombre) }}</td>
                        <td>{{ $reingreso->observacion }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#m-edit-{{ $reingreso->id }}" class="btn btn-success mt-1" title="Editar resolución" type="button">
                                <i class="far fa-edit"></i>
                            </button>
                            <button data-toggle="modal" data-target="#m-delete-{{ $reingreso->id }}" class="btn btn-danger mt-1" type="button" >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td> 
                    </tr>
                    @include('sacademica.reingresos.modal')
                @endforeach
            </tbody>
        </table>
    </div>
@stop