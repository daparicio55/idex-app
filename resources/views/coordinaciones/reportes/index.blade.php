@extends('adminlte::page')

@section('title', 'Reportes de Monitoreo de Notas')

@section('content_header')
    <h1>Reportes de monitoreo de notas</h1>
    <p>Coordinacion de: {{ auth()->user()->coordinacion->nombreCarrera }}</p>
@stop
@section('content')
{!! Form::open(['route'=>'coordinaciones.reportes.index','method'=>'get']) !!}
    <x-adminlte-card title="Seleccione filtros" theme="info" icon="fas fa-search-plus" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                {!! Form::label('Docente', 'Seleccione Docente', [null]) !!}
                <select name="docente" class="form-control selectpicker" data-live-search=true>
                    <option value="" selected disabled>Seleccione un docente</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id }}" @if(isset($_GET['docente'])) @if($_GET['docente'] == $docente->id) selected @endif @endif>{{ $docente->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-8">
                {!! Form::label('unidad', 'Unidad Didáctica', [null]) !!}
                <select name="unidad" class="form-control selectpicker" data-live-search=true>
                    <option value="" selected disabled>Seleccione una unidad</option>
                    @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->id }}" @if(isset($_GET['unidad'])) @if($_GET['unidad'] == $unidad->id) selected @endif @endif>Ciclo: {{ $unidad->ciclo }} Nombre: {{ $unidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('perido', 'Periodo de Estudios', ['class'=>'mt-3']) !!}
                <select name="periodo" class="form-control">
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}" @if(isset($_GET['periodo'])) @if($_GET['periodo'] == $periodo->id) selected @endif  @endif>{{ $periodo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="primary" label="Buscar" icon="fas fa-search" type="submit"/>
            <a href="{{ route('coordinaciones.reportes.index') }}" class="btn btn-danger">
                <i class="fas fa-broom"></i> Limpiar
            </a>
        </x-slot>
    </x-adminlte-card>
    @if (isset($resultados))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Docente</th>
                    <th>Ciclo</th>
                    <th>Unidad Didáctica</th>
                    <th>Periodo de Estudios</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($resultados as $key => $resultado)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $resultado->user->name }}</td>
                        <td>{{ $resultado->unidad->ciclo }}</td>
                        <td>{{ $resultado->unidad->nombre }}</td>
                        <td>{{ $resultado->periodo->nombre }}</td>
                        <td>
                            <a href="{{ route('coordinaciones.reportes.show', $resultado->id) }}" class="btn btn-primary" title="Acta Regular" target="_blank">
                                <i class="fas fa-clipboard-list"></i> R
                            </a>
                            @if(isset($resultado->unidad->old))
                                <a href="{{ route('coordinaciones.reportes.edit',$resultado->id) }}" class="btn btn-success" title="Acta Equivalencias" target="_blank">
                                    <i class="fas fa-clipboard-list"></i> E
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            @include('coordinaciones.reportes.estructure')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    
{!! Form::close() !!}
@stop