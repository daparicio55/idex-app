@extends('adminlte::page')

@section('title', 'Repositorio Editar')

@section('content_header')
    <h1>Editar de Documento <i class="far fa-address-book text-success"></i></h1>
@stop
@section('content')
{!! Form::model($repositorio, ['route'=>['repositorios.update',$repositorio->id],'id'=>'frm','method'=>'PUT','files'=>'true']) !!}
<input type="hidden" name="idCliente" value="{{$repositorio->idCliente}}">
<div class="card">
    <h5 class="card-header"><i class="fas fa-user-tie"></i> Datos Personales..</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                {!! Form::label('apellido', 'Apellidos', [null]) !!}
                <input required name="apellido" type="text" class="form-control" value="{{$repositorio->cliente->apellido}}">
            </div>
            <div class="col-sm-4">
                {!! Form::label('nombre', 'Nombres', [null]) !!}
                <input required name="nombre" type="text" class="form-control" value="{{$repositorio->cliente->nombre}}">
            </div>
            <div class="col-sm-2">
                {!! Form::label('telefono', 'Telefono', [null]) !!}
                <input required name="telefono" type="text" class="form-control" value="{{$repositorio->cliente->telefono}}">
            </div>
            <div class="col-sm-2">
                {!! Form::label('telefono2', 'Telefono 2', [null]) !!}
                <input required name="telefono2" type="text" class="form-control" value="{{$repositorio->cliente->telefono2}}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                {!! Form::label('email', 'Correo Electronico', [null]) !!}
                <input required name="email" type="text" class="form-control" value="{{$repositorio->cliente->email}}">
            </div>
            <div class="col-sm-8">
                {!! Form::label('direccion', 'Dirección', [null]) !!}
                <input required name="direccion" type="text" class="form-control" value="{{$repositorio->cliente->direccion}}">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header"><i class="fas fa-file-alt"></i> Datos del Documento..</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                {!! Form::label('asunto', 'Asunto', [null]) !!}
                {!! Form::text('asunto', null, ['class'=>'form-control','required','placeholder'=>'asunto del documento...']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::label(null,'T. Documento', [null]) !!}
                {!! Form::select('documentotipo_id', $documentotipos, null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::label(null,'Numero', [null]) !!}
                {!! Form::text('numero', null, ['class'=>'form-control','required']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::label(null, 'Fecha', [null]) !!}
                {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::label('url', 'PDF', [null]) !!}
                {!! Form::file('url', ['class'=>'form-control','accept'=>'application/pdf']) !!}
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save fa-2x" title="guardar"></i>
        </button>
{!! Form::close() !!}
        <a class="btn btn-danger" href="{{route('repositorios.index')}}">
            <i class="fas fa-backward fa-2x" title="salir"></i>
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    </script>
@stop