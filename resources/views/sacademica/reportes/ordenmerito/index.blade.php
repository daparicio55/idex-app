@extends('adminlte::page')

@section('title', 'Reportes - Orden de Mérito')

@section('content_header')
    <h1>Reporte de acta de notas y orden de mérito</h1>
@stop

@section('content')
{!! Form::open(['route'=>'sacademica.reportes.ordermerito.create','method'=>'get','id'=>'frm']) !!}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Seleccione parametros</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <label for="periodo">Programa de Estudios</label>
                    <select name="programa" id="programa" class="form-control">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->idCarrera }}">{{ $carrera->nombreCarrera }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-2">
                    <label for="ciclo">Ciclo</label>
                    {!! Form::select('ciclo', $ciclos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-12 col-md-3">
                    <label for="periodo">Periodo</label>
                    <select name="periodo" id="periodo" class="form-control">
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
    </div>
{!! Form::close() !!}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop