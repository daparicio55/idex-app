@extends('adminlte::page')

@section('title', 'Editar Programa de Estudios')

@section('content_header')
    <h1>Editar Programa de Estudios</h1>
    <a href="{{ route('sacademica.programas.index') }}" class="btn btn-danger mt-2">
        <i class="fas fa-undo-alt"></i> Regresar
    </a>
@stop

@section('content')
    {!! Form::model($programa,['route'=>['sacademica.programas.update',$programa->idCarrera],'method'=>'PUT','id'=>'frm']) !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('nombreCarrera', 'Nombre del Programa') !!}
                {!! Form::text('nombreCarrera', $programa->nombreCarrera, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del programa']) !!}
                {!! Form::label('observacionCarrera', 'Observacion', ['class'=>'mt-2']) !!}
                {!! Form::text('observacionCarrera', $programa->observacionCarrera, ['class' => 'form-control', 'placeholder' => 'Ingrese una observacion']) !!}
                {!! Form::label('iformativo_id', 'Itinerario', ['class'=>'mt-2']) !!}
                {!! Form::select('iformativo_id', $itinerarios, null, ['class'=>'form-control']) !!}
                {!! Form::label('ccarrera_id', 'Carrera Anterior', ['class'=>'mt-2']) !!}
                {!! Form::select('ccarrera_id', $programaAnterior, null, ['class' => 'form-control']) !!}
                {!! Form::label('icon', 'Icono', ['class'=>'mt-2']) !!}
                {!! Form::text('icon', null, ['class'=>'form-control']) !!}
                {!! Form::label('image', 'Imagen', ['class'=>'mt-2']) !!}
                {!! Form::text('image', null, ['class'=>'form-control']) !!}
                {!! Form::label('user_id', 'Coordinador', ['class'=>'mt-2']) !!}
                {!! Form::select('user_id', $coordinadores, null, ['class'=>'form-control selectpicker','data-size'=>'8','data-live-search'=>'true']) !!}
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop