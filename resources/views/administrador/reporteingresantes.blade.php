@extends('adminlte::page')
@section('title', 'Reporte Ingresantes')

@section('content_header')
    <h1>Reporte de Ingresantes</h1>
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Postulantes {{ $admisione->nombre }}
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
                            @foreach ($estudiantes as $key => $estudiante)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $estudiante->postulante->cliente->dniRuc }}</td>
                                    <td>{{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::title($estudiante->postulante->cliente->nombre) }}</td>
                                    <td>{{ $estudiante->postulante->sexo }}</td>
                                    <td>
                                        @php
                                            $nacimiento = \Carbon\Carbon::parse($estudiante->postulante->fechaNacimiento);
                                            $edad = $nacimiento->age;
                                        @endphp
                                        {{ $edad }}
                                        {{-- {{ $estudiante->postulante->fechaNacimiento }} --}}
                                    </td>
                                    <td>{{ $estudiante->postulante->carrera->nombreCarrera }}</td>
                                    <td>{{ $estudiante->postulante->colegio->D_DPTO }}</td>
                                    <td>{{ $estudiante->postulante->colegio->D_PROV }}</td>
                                    <td>{{ $estudiante->postulante->colegio->D_DIST }}</td>
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