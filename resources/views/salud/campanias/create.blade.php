@extends('adminlte::page')
@section('title', 'Crear Nueva Campaña')
@section('content_header')
{!! Form::open(['route'=>'salud.campanias.store','method'=>'post','id'=>'frm']) !!}
    <div class="row">
        <div class="from-group">
            <h3 class="h3">Datos</h3>
            {!! Form::label('nombre', 'Nombre', [null]) !!}
            {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
            {!! Form::label('fecha', 'Fecha', [null]) !!}
            {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
            <button type="submit" class="btn btn-info mt-2">
                <i class="fa fa-save"></i> Guardar
            </button>
            <a href="{{ route('salud.campanias.index') }}" class="btn btn-danger mt-2">
                <i class="fa fa-backward"></i> Regresar
            </a>
        </div>
    </div>
{!! Form::close() !!}
@stop
@section('content')
@stop