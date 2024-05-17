@extends('adminlte::page')

@section('title', 'Registrar Entrega')

@section('content_header')
    <h1>Registrar entrega de productos</h1>
@stop

@section('content')
{!! Form::open(['route'=>'gadministrativa.almacen.recepciones.store','method'=>'post','id'=>'frm']) !!}
<x-adminlte-card title="Seleccione Orden de compra" theme="info" icon="fas fa-file-invoice" collapsible>
    <select name="ocompras" id="ocompras" class="form-control selectpicker" title="Nada seleccionado" data-live-search="true" data-size="10" required>
        @foreach ($ocompras as $ocompra)
            
            <option value="{{ $ocompra->id }}">N° {{ ceros($ocompra->numero) }} Ref: {{ $ocompra->tramite->requerimiento->encabezado }}</option>
        @endforeach
    </select>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" id="btn_aceptar" onclick="selectocompra('{{ asset('') }}')">
            <i class="fas fa-check-square"></i> Aceptar
        </button>
    </x-slot>
</x-adminlte-card>
<div class="card" data-toggle="collapse">
    <div class="card-header bg-primary">
        <h3 class="card-title">
            <i class="fas fa-list-ol"></i> Detalles de la Orden de compra
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-lg fa-minus"></i>     
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Serie</th>
                        <th>F. Vencimiento</th>
                        <th>Check</th>
                    </tr>
                </thead>
                <tbody id="tb_productos">

                </tbody>
            </table>
        </div>
        
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
</div>
{!! Form::close() !!}
@stop
<x-carga/>
@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script src="{{ asset('js/gacademica/almacen/recepciones/main.js') }}"></script>
@stop