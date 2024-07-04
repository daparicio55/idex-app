@extends('adminlte::page')

@section('title', 'Nueva Unidad Intercambiable')

@section('content_header')
    <h1>Registrar nueva unidad didactica Intercambiable</h1>
    <a href="{{ route('sacademica.intercambiables.index') }}" class="btn btn-danger mt-2">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
@stop

@section('content')
{!! Form::open(['route'=>'sacademica.intercambiables.store','method'=>'POST']) !!}
    <div class="row">
        <div class="col-sm-12">
            <label>Ingrese nombre:</label>
            {!! Form::text('nombre', null, ['class'=>'form-control mb-2','required']) !!}
        </div>
    </div>
    @php
        $config = [
            "title" => "Select unidades didácticas ...",
            "liveSearch" => true,
            "liveSearchPlaceholder" => "Buscar...",
            "showTick" => true,
            "actionsBox" => true,
        ];
    @endphp
    <x-adminlte-select-bs id="unidades" name="unidades[]" label="Uniadades didácticas" :config="$config" multiple>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-red">
                <i class="fas fa-tag"></i>
            </div>
        </x-slot>
        @foreach ($unidades as $unidade)
            <option data-icon="fa fa-fw fa-newspaper text-info" value="{{ $unidade->id }}">{{ $unidade->nombre }} - {{ $unidade->ciclo }} - {{ $unidade->modulo->carrera->nombreCarrera }}</option>
        @endforeach
    </x-adminlte-select-bs>
    <div class="row">
        <div class="col-sm-12 mt-3">
            <button type="submit" id="btn_guardar" class="btn btn-primary">
                <i class="fas fa-save" title="guardar"></i> Guardar
            </button>
        </div>
    </div>
{!! Form::close() !!}
@stop
