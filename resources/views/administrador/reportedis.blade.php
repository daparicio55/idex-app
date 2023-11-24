@extends('adminlte::page')
@section('title', 'Reporte Discapacitados')

@section('content_header')
    <h1>Reporte de Discapacitados</h1>
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Periodo de Estudios {{ $periodo->nombre }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>Apellidos, Nombres</th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Programa de Estudios</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriculas as $key => $matricula)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                                    <td>{{ Str::upper($matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($matricula->estudiante->postulante->cliente->nombre) }}</td>
                                    <td>{{ $matricula->estudiante->postulante->sexo }}</td>
                                    <td>
                                        @php
                                            $nacimiento = \Carbon\Carbon::parse($matricula->estudiante->postulante->fechaNacimiento);
                                            $edad = $nacimiento->age;
                                        @endphp
                                        {{ $edad }}
                                        {{-- {{ $estudiante->postulante->fechaNacimiento }} --}}
                                    </td>
                                    <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                                    <td>{{ $matricula->estudiante->postulante->colegio->D_DPTO }}</td>
                                    <td>{{ $matricula->estudiante->postulante->colegio->D_PROV }}</td>
                                    <td>{{ $matricula->estudiante->postulante->colegio->D_DIST }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@stop