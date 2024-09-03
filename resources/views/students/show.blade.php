@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Resumen de notas</h1>
@stop

@section('content')
    
    <x-adminlte-card title="Datos Personales" theme="info" icon="fas fa-lg fa-bell" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <label>APELLIDOS, Nombres</label>
                <input type="text" disabled class="form-control" value="{{ Str::upper($object->cliente['apellidos']) }}, {{ Str::title($object->cliente['nombres']) }}">
            </div>
            <div class="col-sm-12 col-md-4">
                <label>Teléfono</label>
                <input type="text" disabled class="form-control" value="{{ $object->cliente['telefono'] }}" >
            </div>
        </div>
        {{-- <p>{{ var_dump($object->carreras) }}</p> --}}
        
    </x-adminlte-card>
    @foreach ($object->carreras as $carrera)
        @php
            $title = $carrera['programa'].' - '.$carrera['periodo'];
        @endphp
        <x-adminlte-card :title=$title theme="info" icon="fas fa-graduation-cap" collapsible>
            @foreach ($carrera['ciclos'] as $ciclo)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                <th colspan="9" class="text-center pb-1 h5">{{ $ciclo['nombre'] }} SEMESTRE</th>
                            </tr>
                            <tr>
                                <th class="pb-1 pt-1 h6">Unidad Didáctica</th>
                                <th class="pb-1 pt-1 h6">Cre.</th>
                                <th class="pb-1 pt-1 h6">Hor.</th>
                                <th class="pb-1 pt-1 h6">Not.</th>
                                <th class="pb-1 pt-1 h6">Observación</th>
                                <th class="pb-1 pt-1 h6">Not.</th>
                                <th class="pb-1 pt-1 h6">Observación</th>
                                <th class="pb-1 pt-1 h6">Not.</th>
                                <th class="pb-1 pt-1 h6">Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ciclo['unidades'] as $unidad)
                                <tr>
                                    <td class="pb-1"><b>{{ $unidad['tipo'] }}:</b> {{ $unidad['nombre'] }}</td>
                                    <td class="pb-1">{{ $unidad['creditos'] }}</td>
                                    <td class="pb-1">{{ $unidad['horas'] }}</td>
                                    @foreach ($unidad['matriculas'] as $matricula)
                                        <td class="text-{{ $matricula['color'] }} pb-1">{{ cero($matricula['nota']) }}</td>
                                        <td class="pb-1"><b>{{ $matricula['tipo'] }}: </b><br>{{ $matricula['periodo'] }}</td>
                                    @endforeach
                                    @for ($i = count($unidad['matriculas']); $i < 3; $i++)
                                        <td class="pb-1"></td>
                                        <td class="pb-1"></td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                </div>
            @endforeach
        </x-adminlte-card>        
    @endforeach
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop