@extends('adminlte::page')
@section('title', 'Roles Crear')
@section('content_header')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registrar Nuevo ROL</h3>
	</div>
</div>
@stop
@section('content')
{!! Form::open(['route'=>'accesos.roles.store','method'=>'POST','autocomplete'=>'off']) !!}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            {!! Form::label('name','Nombre del ROL') !!}
            {!! Form::text('name', null, ["class"=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            @foreach ($permissions as $permission)
            <div class="form-group">
                <label>
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
                    {{$permission->description}}
                </label>
            </div>
            @endforeach 
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