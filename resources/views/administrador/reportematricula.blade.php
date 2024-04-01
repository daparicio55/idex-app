@extends('adminlte::page')
@section('title', 'Reporte Ingresantes')

@section('content_header')
    <h1>Reporte de Matriculas {{ $pmatricula->nombre }}</h1>
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>APELLIDOS, Nombres</th>
                <th>Correo</th>
                <th>Modalidad</th>
                <th>Programa de Estudios</th>
                <th>Promocion</th>
                <th>Discapacidad</th>
                <th>Ciclo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pmatricula->matriculas as $key=>$matricula)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                    <td>{{ Str::upper($matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($matricula->estudiante->postulante->cliente->nombre) }}</td>
                    <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}@idexperujapon.edu.pe</td>
                    <td>{{ $matricula->estudiante->postulante->modalidad }}</td>
                    <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                    <td>{{ $matricula->estudiante->postulante->admisione->nombre }}</td>
                    <td>
                        @if ($matricula->estudiante->postulante->discapacidad == 1)
                            NO
                        @else
                            SI
                        @endif
                    </td>
                    <td>
                        @foreach ($matricula->detalles as $detalle)
                            @if ($loop->last)
                                {{ $detalle->unidad->ciclo }}
                            @endif  
                        @endforeach
                    </td>             
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop