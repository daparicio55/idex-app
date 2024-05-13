@extends('adminlte::page')

@section('title', 'Registrar Orden de compra')

@section('content_header')
    <h1>Registrar orden de compra</h1>
    <a href="{{ route('gadministrativa.abastecimiento.ocompras.index') }}" class="btn btn-danger mt-2">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop

@section('content')
@include('gadministrativa.abastecimiento.ocompras.mcatalogo')
{!! Form::open(['route'=>'gadministrativa.abastecimiento.ocompras.store','method'=>'POST','id'=>'frm']) !!}
<x-adminlte-card title="Seleccione Trámite" theme="info" icon="fas fa-file-invoice" collapsible>
    <select name="tramites" id="tramites" class="form-control selectpicker" title="Nada seleccionado" data-live-search="true" data-size="10" required>
        @foreach ($tramites as $tramite)
            <option value="{{ $tramite->id }}">Trámite: {{ ceros($tramite->numero) }} - Requerimiento: {{ ceros($tramite->requerimiento->numero) }} | {{ $tramite->requerimiento->asunto }}</option>
        @endforeach
    </select>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" id="btn_aceptar" onclick="selectTramite('{{ asset('') }}')">
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
        <div class="row">
            <div class="col-sm-12">
                <label for="empresa">Seleccione Empresa o Proveedor</label>
                <select name="empresa" id="empresa" class="form-control selectpicker" data-live-search="true" data-size="8" title="Nada seleccionado" required>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->idEmpresa }}">{{ $empresa->ruc }} - {{ $empresa->razonSocial }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="fecha" class="mt-2">Fecha</label>
                <input type="date" name="fecha" required class="form-control" value="{{ date('Y-m-d',strtotime(Carbon\Carbon::now())) }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="dias" class="mt-2">Días de entrega</label>
                <input type="number" name="dias" id="dias" class="form-control" value="15" required>
            </div>
            <div class="col-sm-12">
                <label class="mt-3">Lista de Productos</label>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="detalles">
                            
                        </tbody>
                    </table>
                </div>
            </div>
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
    <script src="{{ asset('js/gacademica/abastecimiento/ocompras/main.js') }}"></script>
@stop