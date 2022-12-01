@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1><i class="fas fa-print"></i> Seleccionar estudiantes</h1>
@stop

@section('content')

{!! Form::open(['id'=>'frm_datos','name'=>'frm_datos','route'=>'cepres.carnets.store','method'=>'POST','autocomplete'=>'off']) !!}
{!! Form::hidden('idCepre', $cepre->idCepre, [null]) !!}
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            @foreach ($estudiantes as $estudiante)
            <div class="form-group">
                <label>
                    {!! Form::checkbox('alumnos[]', $estudiante->idCepreEstudiante, null, ['class'=>'mr-1']) !!}
                    {{$estudiante->cliente->dniRuc}} - {{Str::upper($estudiante->cliente->apellido)}}, {{Str::title($estudiante->cliente->nombre)}} - {{$estudiante->carrera->nombreCarrera}}
                </label>
            </div>
            @endforeach
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">    
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-share-square"></i> Enviar
        </button>
{!! Form::close() !!}
        <a href="{{route('cepres.carnets.index')}}" class="btn btn-danger">
            <i class="fas fa-backward"></i> Regresar
        </a>
        </div>
</div>
@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
</script>
@stop