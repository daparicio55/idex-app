@extends('adminlte::page')

@section('title', 'Recepcionar ')

@section('content_header')
    <h1>Recepción de Productos</h1>
    <a href="{{ route('gadministrativa.almacen.recepciones.create') }}" class="btn btn-success mt-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
@stop

@section('content')
<x-alert/>
<div class="table-responsive">
    <table class="table">
        <thead>
            <th>Num.</th>
            <th>Fecha</th>
            <th>Ord. Servicio</th>
            <th>Proveedor</th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                @foreach ($recepciones as $recepcione)
                    <td>{{ ceros($recepcione->numero) }}</td>
                    <td>{{ date('d-m-Y',strtotime($recepcione->fecha)) }}</td>
                    <td>{{ ceros($recepcione->ocompra->numero) }}</td>
                    <td>{{ $recepcione->ocompra->empresa->razonSocial }}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modal-delete-{{ $recepcione->id }}" class="btn btn-danger" title="Eliminar recepción">
                            <i class="fa fa-trash"></i>
                        </button>
                        @include('gadministrativa.almacen.recepciones.modal')
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop