@extends('adminlte::page')

@section('title', 'Nuevo catálogo')

@section('content_header')
    <h1>Registro de nuevo catálogo</h1>
    <a href="{{ route('gadministrativa.administracion.catalogos.index') }}" class="btn btn-danger mt-1">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop
@section('content')
{{-- modal para nuevas marcas --}}
@include('gadministrativa.administracion.catalogos.modal_create.create_marca')
{{-- modal para nuevos tipos --}}
@include('gadministrativa.administracion.catalogos.modal_create.create_tipo')
{{-- modal para nuevas unidades --}}
@include('gadministrativa.administracion.catalogos.modal_create.create_unidade')
{!! Form::open(['route'=>'gadministrativa.administracion.catalogos.store','method'=>'POST','id'=>'frm']) !!}
    <x-adminlte-card title="Datos del nuevo catálogo" theme="info" icon="fab fa-product-hunt" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                {!! Form::label('codigo', 'Codigo', [null]) !!}
                {!! Form::text('codigo', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('modelo', 'Modelo', [null]) !!}
                {!! Form::text('modelo', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-6">
                {!! Form::label('descripcion', 'Descripcion', [null]) !!}
                {!! Form::text('descripcion', null, ['class'=>'form-control','required'=>true]) !!}
            </div>
            <div class="col-sm-12">
                {!! Form::label('observacion', 'Observacion', ['class'=>'mt-2']) !!}
                {!! Form::text('observacion', null, ['class'=>'form-control','required'=>true]) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('marcas', 'Marcas', ['class'=>'mt-2']) !!}
                <select name="marcas" id="marcas" class="form-control selectpicker" title="No hay selección" data-live-search = true data-size = 10 required>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
                <button type="button" id="btn_marca_add" class="btn btn-primary btn-sm mt-2" title="agregar nueva marca" data-toggle="modal" data-target="#modal-marca">
                    <i class="fas fa-plus-circle"></i>
                </button>
                <button type="button" id="btn_marca_refresh" class="btn btn-warning btn-sm mt-2" title="actualizar" onclick="refreshMarcas('{{ route('gadministrativa.administracion.marcas.get') }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('tipos', 'Tipos', ['class'=>'mt-2']) !!}
                <select name="tipos" id="tipos" class="form-control d-inline selectpicker" title="No hay selección" data-live-search = true data-size = 10 required>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-primary btn-sm mt-2" title="agregar nuevo tipo" data-toggle="modal" data-target="#modal-tipo">
                    <i class="fas fa-plus-circle"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm mt-2" title="actualizar" onclick="refreshTipos('{{ route('gadministrativa.administracion.tipos.get') }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="col-sm-12 col-md-3">
                 {!! Form::label('unidades', 'Uni.', ['class'=>'mt-2']) !!}
                 <select name="unidades" id="unidades" class="form-control d-inline selectpicker" title="No hay selección" data-live-search = true data-size = 10 required>
                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nombre }}</option>
                    @endforeach
                 </select>
                 <button type="button" class="btn btn-primary btn-sm mt-2" title="agregar nueva unidad" data-toggle="modal" data-target="#modal-unidad">
                    <i class="fas fa-plus-circle"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm mt-2" title="actualizar" onclick="refreshUnidades('{{ route('gadministrativa.administracion.unidades.get') }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('cantidad', 'Cant.', ['class'=>'mt-2']) !!}
                {!! Form::number('cantidad', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                <label for="" class="mt-2">¿Tiene serie?</label>
                <x-adminlte-input-switch name="serie" data-on-text="SI" data-off-text="NO" data-on-color="teal"/>
            </div>
            <div class="col-sm-12 col-md-3">
                <label for="" class="mt-2">¿Es perecible?</label>
                <x-adminlte-input-switch name="perecible" data-on-text="SI" data-off-text="NO" data-on-color="teal"/>
            </div>
            <div class="col-sm-12 col-md-6">
                {!! Form::label('padre', 'Categoria Padre', ['class'=>'mt-2']) !!}
                <select name="padre" id="padre" class="form-control selectpicker" title="No hay selección" data-live-search="true" data-size="10">
                    @foreach ($catalogos as $catalogo)
                        <option value="{{ $catalogo->id }}">{{ $catalogo->codigo }} {{ $catalogo->modelo }} {{ $catalogo->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-slot name="footerSlot">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-save"></i> Guardar
            </button>
        </x-slot>
    </x-adminlte-card>
{!! Form::close() !!}
<x-carga></x-carga>
@stop
@section('css')
  <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop
@section('js')
    <script src="{{ asset('js/gacademica/administracion/catalogos/main.js') }}"></script>
    <script src="{{ asset('js/carga.js') }}"></script>
@stop