@extends('adminlte::page')
@section('title', 'Editar Capacidad')
@section('content_header')
    <h1><i class="fas fa-business-time"></i> Editar Capacidad</h1>
    <h5 class="mt-2">{{ $ability->modulo->nombre }} - {{ $ability->modulo->carrera->nombreCarrera }}</h5>
@stop
@section('content')
{!! Form::model($ability, ['route'=>['sacademica.ability.update',$ability->id],'method'=>'put','id'=>'formulario']) !!}
<div class="row">
    <div class="col-sm-12">
        {!! Form::label('nombre', 'Nombre o descripcion de la Capacidad', ['class'=>'mt-2']) !!}
        {!! Form::textarea('nombre', null, ['class'=>'form-control','rows'=>3]) !!}
    </div>
    <div class="col-sm-12 mt-2">
        <button type="submit" class="btn btn-info" id="button_save">
            <i class="fas fa-save"></i> Guardar
        </button>
        <a href="" class="btn btn-danger">
            <i class="fas fa-ban"></i> Regresar
        </a>
    </div>
</div>
{!! Form::close() !!}
@stop