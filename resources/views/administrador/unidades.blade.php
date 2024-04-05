@extends('adminlte::page')
@section('title', 'Reporte de Unidades')

@section('content_header')
    <h1>Reporte de Unidades</h1>
@stop
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Programa de estudio</th>
            <th>shortname</th>
            <th>fullname</th>
            <th>Ciclo</th>
            <th>category</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carreras as $carrera)
            @foreach ($carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $key => $unidade)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <th>{{ $unidade->modulo->carrera->nombreCarrera }}</th>
                        <th>{{ $unidade->moodle }}</th>
                        <th>
                            {{ $unidade->nombre }}
                            @if ($unidade->tipo == "Empleabilidad")
                             - {{ $unidade->modulo->carrera->nombreCarrera }}
                            @endif
                        </th>
                        <th>{{ $unidade->ciclo }}</th>
                        <th>0</th>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
</table>
@stop