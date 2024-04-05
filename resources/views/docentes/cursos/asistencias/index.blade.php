@extends('adminlte::page')
@section('title', 'Registro Asistencias')
@section('content_header')
<h4 class="h4">
    Unidad Didáctica: {{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }} {{ $asignacione->unidad->ciclo }}
</h4>
<p>
   Del {{ date('d-m-Y',strtotime($asignacione->periodo->finicio)) }} al {{ date('d-m-Y',strtotime($asignacione->periodo->ffin)) }}
</p>
@stop
@section('content')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>APELLIDOS, Nombres</th>
                @foreach ($fdias as $dia)
                    <th class="vertical-text">{{ date('d-m-Y',strtotime($dia['fecha'])) }} {{ Str::title($dia['nombre_dia']) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($asignacione->unidad->ematricula_detalles as $key => $detalle)
            <tr>
                <td>{{ Str::upper($detalle->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($detalle->matricula->estudiante->postulante->cliente->nombre) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
@push('css')
<style type="text/css">

    {{-- You can add AdminLTE customizations here --}}
    /*
    .card-header {
        border-bottom: none;
    }
    .card-title {
        font-weight: 600;
    }
    */
    .vertical-text {
        writing-mode: vertical-rl; /* Esto coloca el texto en posición vertical de derecha a izquierda */
        text-orientation:sideways-right; /* Esto hace que el texto se lea de arriba hacia abajo */
        white-space: nowrap; /* Esto evita que el texto se desborde en múltiples líneas */
    }
</style>
@endpush
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop