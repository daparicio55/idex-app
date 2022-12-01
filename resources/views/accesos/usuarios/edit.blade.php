@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop
@section('content')
{!! Form::model($usuario, ['route'=>['accesos.usuarios.update',$usuario->id],'method'=>'put']) !!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            {!! Form::label(null, 'Nombre', null) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nombre del usuario']) !!}
            
        </div>
        <div class="form-group">
            {!! Form::label(null, 'Correo', null) !!}
            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Correo electronico']) !!}
        </div>
        <div class="form-group">
            {!! Form::label(null, 'Contraseña', null) !!}
            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'ingrese contraseña']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label(null, 'Selecciona la Oficina', null) !!}
            {!! Form::select('idOficina', $oficinas, null, ['class'=>'form-control selectpicker']) !!}
        </div>   	
        <div class='form-group'>
            {!! Form::label(null, 'Selecciona Roles', null) !!}
            @foreach ($roles as $role)
                <div class="form-check">
                    {!! Form::checkbox('roles[]', $role->id,null, ['class'=>'form-check-input']) !!}
                    <label class="form-check-label">
                        {{$role->name}}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type='reset'>Limpiar</button>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection