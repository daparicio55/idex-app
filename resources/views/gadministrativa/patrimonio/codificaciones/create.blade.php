@extends('adminlte::page')

@section('title', 'Codificaciones - Registrar')

@section('content_header')
    <h1>Codificación de Bienes</h1>
    <a href="{{ route('gadministrativa.patrimonio.codificaciones.index') }}" class="btn btn-danger mt-2">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop

@section('content')
<x-adminlte-card title="Seleccione Orden de compra" theme="info" icon="fas fa-file-invoice" collapsible>
    <select name="recepciones" id="recepciones" class="form-control selectpicker" title="Nada seleccionado" data-live-search="true" data-size="10" required>
        @foreach ($recepciones as $recepcione)
            
            <option value="{{ $recepcione->id }}">N° {{ ceros($recepcione->numero) }} Ref: {{ $recepcione->ocompra->tramite->requerimiento->encabezado }}</option>
        @endforeach
    </select>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" id="btn_aceptar" onclick="selectrecepcion('{{ asset('') }}')">
            <i class="fas fa-check-square"></i> Aceptar
        </button>
    </x-slot>
</x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop
<x-carga/>
@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script src="{{ asset('js/gacademica/patrimonio/codificaciones/main.js') }}"></script>
@stop