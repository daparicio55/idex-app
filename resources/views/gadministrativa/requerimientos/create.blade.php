@extends('adminlte::page')

@section('title', 'Requerimientos | SISGE')

@section('content_header')
    <h1>Nuevo Requerimiento</h1>
@stop

@section('content')
{!! Form::open(['route'=>'gadministrativa.requerimientos.store','method'=>'POST','id'=>'frm']) !!}
<x-adminlte-card title="Datos del requerimiento" theme="info" icon="fas fa-lg fa-bell" collapsible>
    <div class="row">
        <div class="col-sm-12">
            <label for="encabezado">Encabezado</label>
            <textarea name="encabezado" id="encabezado" rows="3" class="form-control" required>@if (isset($ultimo_requerimiento)){{ $ultimo_requerimiento->encabezado }}@endif</textarea>
        </div>
        <div class="col-sm-12">
            <label for="asunto" class="mt-2">Asunto</label>
            <textarea name="asunto" id="asunto" rows="3" class="form-control" required></textarea>
        </div>
        <div class="col-sm-12">
            <label for="Justificación" class="mt-2">Justificación</label>
            <textarea name="justificacion" id="justificacion" rows="10" class="form-control" required></textarea>
        </div>

    </div>
</x-adminlte-card>
<x-adminlte-card title="Agregar materiales y/o productos" theme="primary" icon="fas fa-list-ol" collapsible>
    <div class="row">
        <div class="col-sm-12">
            <select name="productos" id="productos" class="form-control selectpicker" data-live-search=true data-size=10>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="button" id="btn_add" class="btn btn-primary">
            <i class="fas fa-save"></i> Agregar
        </button>
    </x-slot>
</x-adminlte-card>
<x-adminlte-card title="Lista de materiales y/o productos" theme="success" icon="fas fa-list-ol" collapsible>
    <div class="responsive-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Observación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>
        </table>
    </div>
    <x-slot name="footerSlot">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Guardar
        </button>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop
<x-carga/>
@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script src="{{ asset('js/gacademica/requerimientos/main.js') }}"></script>
@stop