@extends('adminlte::page')

@section('title', 'S. Académica | Licencias')

@section('content_header')
    <h1>Licencias de Estudios</h1>
    <a href="{{ route('sacademica.licencias.create') }}" class="btn btn-success mt-1">
        <i class="fas fa-newspaper"></i> Nuevo
    </a>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="h5"><i class="fas fa-search"></i> Buscar</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="ingrese un texto para buscar">
                </div>
                <div class="col-sm-12 col-md-9 mt-2">
                    <select name="programa" id="programa" class="form-control selectpicker" data-live-search="true">
                        <option value="0" disabled selected>Programa de estudios</option>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->idCarrera }}">{{ $programa->nombreCarrera }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-3 mt-2">
                    <select name="periodo" id="periodo" class="form-control selectpicker" data-live-search="true" data-size="5">
                        <option value="0" disabled selected>Periodo</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-share-square"></i> Enviar
            </button>
        </div>
    </div>
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
                            <button data-toggle="modal" data-target="#m-delete-{{ $licencia->id }}" class="btn btn-danger" type="button" >
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

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop