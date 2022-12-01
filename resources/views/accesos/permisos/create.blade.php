@extends('adminlte::page')
@section('title', 'Permisos Crear')
@section('content_header')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registrar Nuevo Permiso</h3>
	</div>
</div>
@stop
@section('content')
{!! Form::open(['route'=>'accesos.permisos.store','method'=>'POST','autocomplete'=>'off']) !!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('name','Nombre de la Ruta') !!}
            {!! Form::text('name', null, ["class"=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            {!! Form::label('description', 'Descripcion de la Ruta') !!}
            {!! Form::text('description', null, ["class"=>'form-control']) !!}
        </div>
    </div>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary btn-lg" type="submit">
                    <i class="far fa-save"></i> Guardar
                </button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop