@extends('adminlte::page')
@section('title', 'Crear Criterio')
@section('content_header')
{!! Form::open(['route'=>'docentes.cursos.criterios.store','method'=>'post','id'=>'frm_datos']) !!}
<div class="card">
    <div class="card-header bg-info">
        <h5>
            <a class="btn btn-danger" href="{{ route('docentes.cursos.show',$asignacione->id) }}">
                <i class="fas fa-long-arrow-alt-left"></i>
            </a> {{ $asignacione->unidad->nombre }}
        </h5>
        <h6 class="p-0 mb-0">{{ $asignacione->unidad->modulo->carrera->nombreCarrera }}</h6>
        <small class="p-0">{{ $asignacione->periodo->nombre }}</small>
    </div>
    <div class="card-body">
        {!! Form::hidden('uasignada_id', $asignacione->id, [null]) !!}
        <div class="row">
            <div class="col-sm-4">
                {!! Form::label('nombre', 'Nombre del criterio', [null]) !!}
                {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
            </div>
            <div class="col-sm-8">
                <label for="descripcion">Descripcion del Criterio</label>
                {!! Form::text('descripcion', null, ['class'=>'form-control','required']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" id="bt_guardar" class="btn btn-primary">
                    <i class="far fa-save"></i> Guardar
                </button>
                
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
<script>
      $('#frm_datos').submit(function(event){
            $('#bt_guardar').attr('disabled',true);
      });
</script>
@stop