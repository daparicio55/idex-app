@extends('adminlte::page')

@section('title', 'Cepre Asistencias')

@section('content_header')
    <h1>Registro de Asistencias</h1>
@stop

@section('content')
{!! Form::open(['route'=>'cepres.estudiantes.asistencias.create','method'=>'get']) !!}
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="mb-0"><i class="fas fa-search"></i> Buscar</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="idCepre">Periodo Cepre</label>
                    <select name="idCepre" class="form-control" required>
                        <option value="" selected disabled>Seleccione un periodo</option>
                        @foreach ($cepres as $cepre)
                            <option value="{{ $cepre->idCepre }}">{{ $cepre->periodoCepre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label>Aula</label>
                    <select name="aula" class="form-control" required>
                        <option value="" selected disabled>Seleccione Aula</option>
                        @foreach ($aulas as $aula)
                            <option value="{{ $aula['id'] }}">{{ $aula['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label>Fecha</label>
                    <input name="fecha" type="date" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
        </div>
    </div>
{!! Form::close() !!}
@stop