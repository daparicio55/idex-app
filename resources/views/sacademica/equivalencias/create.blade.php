@extends('adminlte::page')

@section('title', 'Crear Equivalencia')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nueva Equivalencia</h1>
@stop
@section('content')
{!! Form::open(['route'=>'sacademica.equivalencias.store','method'=>'post','id'=>'frm']) !!}
<div class="row">
    <div class="col-sm-12">
        {!! Form::label('old_id', 'Unidad didactica antigua', [null]) !!}
        <select name="old_id" id="old_id" class="form-control selectpicker" data-live-search = "true"> 
            <option value=0>seleccione una unidad ...</option>
            @foreach ($unidades as $unidad)
                <option value="{{ $unidad->id }}">Ciclo: {{ $unidad->ciclo }} {{ $unidad->nombre }} - {{ $unidad->modulo->carrera->nombreCarrera }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-12 mt-3">
        {!! Form::label('new_id', 'Unidad didactica Nueva', [null]) !!}
        <select name="new_id" id="new_id" class="form-control selectpicker" data-live-search="true">
            <option value=0>seleccione una unidad ...</option>
            @foreach ($unidades as $unidad)
            <option value="{{ $unidad->id }}">Ciclo: {{ $unidad->ciclo }} {{ $unidad->nombre }} - {{ $unidad->modulo->carrera->nombreCarrera }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-12 mt-3">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
        <a href="{{ route('sacademica.equivalencias.index') }}" class="btn btn-danger">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    </script>
@stop