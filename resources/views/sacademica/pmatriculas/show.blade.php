@extends('adminlte::page')

@section('title', 'Reporte de Periodo Académico')

@section('content_header')
    <h1>Reporte de avance de programacion de unidades didácticas</h1>
@stop
@section('content')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Docente</th>
                <th>Unididad Didáctica</th>
                <th>Ciclo</th>
                <th>Programa de Estudios</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periodo->uasignadas as $key => $uasignada)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $uasignada->user->name }}</td>
                    <td>{{ $uasignada->unidad->nombre }}</td>
                    <td>{{ $uasignada->unidad->ciclo }}</td>
                    <td>{{ $uasignada->unidad->modulo->carrera->nombreCarrera }}</td>
                    <td>
                        @php
                            $bandera = true;
                        @endphp
                        {{-- <ul> --}}
                            @foreach ($uasignada->capacidades as $capacidade)
                                @if (!isset($capacidade->fecha))
                                    @php
                                        $bandera = false;
                                    @endphp
                                    {{-- <li class="text-danger"> --}}
                                        {{-- {{ $capacidade->nombre }} --}}
                                        {{-- <ul> --}}
                                            @foreach ($capacidade->indicadores as $indicadore)
                                                @if (!isset($indicadore->fecha))
                                                    @php
                                                        $bandera = false;
                                                    @endphp
                                                    {{-- <li>{{ $indicadore->nombre }}</li> --}}
                                                @endif
                                            @endforeach
                                        {{-- </ul> --}}
                                    {{-- </li>  --}}                                 
                                @endif
                            @endforeach
                            @if ($bandera == true)
                                <span class="text-primary">COMPLETO</span>
                            @else
                                <span class="text-danger">FALTANTE</span>
                            @endif
                        {{-- </ul> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
@section('js')

@stop