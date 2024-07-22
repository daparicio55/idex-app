@extends('adminlte::page')

@section('title', 'Nuevo Registro')

@section('content_header')
    <h1>Registrar recuperación</h1>
@stop

@section('content')
{!! Form::open(['route'=>['docentes.cursos.recuperaciones.store',$uasignada->id],'method'=>'post','id'=>'frm']) !!}
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title">
                <i class="fas fa-database"></i> Recuperación
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <label for="emd">Estudiante desaprobado</label>
                    <select name="emd" class="form-control">
                        @foreach ($emds as $emd)
                            <option value="{{ $emd->id }}">
                                Nota: {{ $emd->nota }} - Estudiante: {{ Str::upper($emd->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($emd->matricula->estudiante->postulante->cliente->nombre) }}
                            </option>
                        @endforeach
                    </select>
                </div>           
                <div class="col-sm-12 col-md-3">
                    <label for="nota" class="mt-2">Nota recuperación</label>
                    <input name="nota" type="number" min="0" max="20" class="form-control" required>
                </div>
                <div class="col-sm-12 col-md-9">
                    <label for="observacion" class="mt-2">Observación</label>
                    <input type="text" class="form-control" name="observacion">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('docentes.cursos.recuperaciones.index',$uasignada->id) }}" class="btn btn-danger">
                <i class="fas fa-backward"></i> Regresar
            </a>
        </div>
    </div>
{!! Form::close() !!}
@stop