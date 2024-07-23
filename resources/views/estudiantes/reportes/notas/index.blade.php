@extends('adminlte::page')

@section('title', 'Reporte | Notas')

@section('content_header')
    <h1>Reporte Notas</h1>
@stop

@section('content')
    @foreach ($estudiantes as $estudiante)
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="h5">{{ $estudiante->postulante->carrera->nombreCarrera }} - {{ $estudiante->postulante->admisione->nombre }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                            <tr>
                                <th colspan="3" class="bg-secondary">
                                    {{ $modulo->nombre }}
                                </th>
                            </tr>
                            <tr>
                                <th>Unidad Didáctica</th>
                                <th>Ciclo</th>
                                <th>Notas</th>
                            </tr>
                            @foreach ($modulo->unidades as $unidade)
                            <tr>
                                <td>{{ $unidade->nombre }}</td>
                                <td>{{ $unidade->ciclo }}</td>
                                <td>
                                    @php
                                        $notas = notas($unidade->id,$estudiante->id);
                                    @endphp
                                    <ul>
                                        @php
                                            $estado = "text-danger";
                                        @endphp
                                        @foreach ($notas as $nota)
                                            @if(isset($nota->recuperacion->nota))
                                                @if($nota->recuperacion->nota > 12)
                                                    @php
                                                        $estado = "text-primary";
                                                    @endphp
                                                @endif
                                            @else
                                                @if($nota->nota > 12)
                                                    @php
                                                        $estado = "text-primary";
                                                    @endphp
                                                @endif
                                            @endif
                                            <li>
                                                @if(isset($nota->recuperacion->nota))
                                                    <span class="{{ $estado }}">
                                                        {{ number_format($nota->recuperacion->nota,0) }} 
                                                    </span>
                                                @else
                                                    <span class="{{ $estado }}">
                                                        {{ cero($nota->nota) }}
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>      
    @endforeach
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop