@extends('adminlte::page')
@section('title', 'Permisos Crear')
@section('content_header')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Editar Nuevo Permiso</h3>
	</div>
</div>
@stop
@section('content')
{!! Form::model($permission, ['route'=>['accesos.permisos.update',$permission->id],'method'=>'put']) !!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Nombre del Permiso</label>
            {!! Form::text('name', null , ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label>Descripcion del Permiso</label>
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