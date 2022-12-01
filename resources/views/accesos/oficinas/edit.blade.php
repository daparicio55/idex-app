@extends('adminlte::page')
@section('title', 'Oficinas Editar')

@section('content_header')
    <h1>Editar Oficina</h1>
@stop
@section('content')
{!! Form::model($oficina, ['route'=>['accesos.oficinas.update',$oficina->idOficina],'method'=>'put','autocomplete'=>'off']) !!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            {!! Form::label(null, 'Nombre de la Oficina', [null]) !!}
            {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
            <input type="hidden" name="estado" value=1>
        </div>
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary btn-lg" type="submit">
        <i class="far fa-save"></i> Guardar
    </button>
{!! Form::close() !!}
    <a class="btn btn-danger btn-lg" href="{{route('accesos.oficinas.index')}}">
        <i class="fas fa-sign-out-alt"></i> Salir
    </a>
</div>
@stop