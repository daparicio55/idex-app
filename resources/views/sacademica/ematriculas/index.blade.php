@extends('adminlte::page')
@section('title', 'Matriculas')
@section('content_header')
    <x-alert/>
    <h1>Lista de Matrículas del Sistema...</h1>
    <a href="{{route('sacademica.matriculas.create')}}" class="btn btn-success mt-2 mb-2">
        <i class="far fa-file"></i> Nuevo Registro
    </a>
    @include('sacademica.ematriculas.search')
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>DNI</th>
                <th>APELLIDOS, Nombres</th>
                <th>Programa de Estudios</th>
                <th>Telefono</th>
                <th>WhatsApp</th>
                <th style="width: 100px">Fecha</th>
                <th>Periodo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                        <tr @if($matricula->licencia == "SI") style="text-decoration : line-through" @endif>
                            <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                            <td><strong>{{Str::upper($matricula->estudiante->postulante->cliente->apellido)}}</strong>, {{Str::title($matricula->estudiante->postulante->cliente->nombre)}}</td>
                            <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td>{{ $matricula->estudiante->postulante->cliente->telefono }}</td>
                            <td>{{ $matricula->estudiante->postulante->cliente->telefono2 }}</td>
                            <td>{{ date('d-m-Y',strtotime($matricula->fecha)) }}</td>
                            <td>{{ $matricula->matricula->nombre }}</td>
                            <td style="width: 120px; text-align: center">
                                <a target="_blank" href="{{ route('sacademica.matriculas.show',['matricula'=>$matricula->id]) }}" class="btn btn-warning mt-1">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a data-target="#modal-delete-{{$matricula->id}}" data-toggle="modal" href="" class="btn btn-danger mt-1" title="eliminar matricula">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a data-target="#modal-unidades-{{ $matricula->id }}" data-toggle="modal" class=" btn btn-info mt-1">
                                    <i class="fas fa-list-ol"></i>
                                </a>
                            </td>                        
                        </tr>
                        @include('sacademica.ematriculas.delete')
                @endforeach
        </tbody>
        <tfoot>
            @if(method_exists($matriculas, 'links'))
            <tr>
                <td colspan="8" class="pb-0">
                    {{ $matriculas->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>
@stop