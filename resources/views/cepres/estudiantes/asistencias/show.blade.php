@extends('adminlte::page')

@section('title', 'Asistencias')

@section('content_header')
    <h1><i class="far fa-calendar-alt"></i> Reporte de Asistencias de:</h1>
    <h5 class="h5 mt-2"><i class="fas fa-user"></i> {{ Str::upper($estudiante->cliente->apellido) }}, {{ Str::title($estudiante->cliente->nombre) }}</h5>
    <a href="{{ route('cepres.estudiantes.index') }}" class="btn btn-danger">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop

@section('content')
    <div class="table-responsive">   
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rangoFechas as $fecha)
                    @php
                        $asistencia = \App\Models\CepreEstudianteAsistencia::where('fecha','=',$fecha)
                        ->where('cestudiante_id','=',$estudiante->idCepreEstudiante)
                        ->first();
                    @endphp
                    <tr>
                        <td>
                            {{ __(date('l',strtotime($fecha))) }} {{ date('j',strtotime($fecha)) }} de {{ __(date('F',strtotime($fecha))) }}
                        </td>
                        <td>
                            @if (isset($asistencia->estado))
                                <span @if($asistencia->estado == "Asistio") class="text-primary" @else @if($asistencia->estado == "Tardanza") class="text-warning" @else class="text-danger" @endif @endif>{{ $asistencia->estado }}</span>
                            @else
                                <span class="text-success"> no registrado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop