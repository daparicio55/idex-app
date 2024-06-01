@extends('adminlte::page')

@section('title', 'Trámite de Requerimientos')

@section('content_header')
    <h1>Trámite de requerimientos</h1>
    <a href="{{ route('gadministrativa.administracion.tramites.create') }}" class="btn btn-success mt-2">
        <i class="fas fa-plus-circle"></i> Nuevo
    </a>
@stop

@section('content')
<x-alert/>
<div class="table-responsive">
    <table class="table table-striped">        
        <thead>
            <tr>
                <th>Número</th>
                <th>Requerimiento</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tramites as $tramite)
                <tr class="bg-secondary">
                    <td>{{ ceros($tramite->numero) }}</td>
                    <td>{{ $tramite->requerimiento->encabezado }} {{ $tramite->requerimiento->asunto }}</td>
                    <td style="width: 110px">{{ date('d-m-Y',strtotime($tramite->fecha)) }}</td>
                    <td>
                        <button type="button" class="btn btn-danger" title="Eliminar Trámite" data-toggle="modal" data-target="#modal-delete-{{ $tramite->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    @include('gadministrativa.administracion.tramites.modal')
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pt-1 pb-1">Cant.</th>
                                    <th class="pt-1 pb-1">Destino</th>
                                    <th class="pt-1 pb-1">Catálogo</th>
                                    <th class="pt-1 pb-1">Cant.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tramite->tramiteDetalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->destino }}</td>
                                        <td>{{ $detalle->catalogo->codigo }} {{ $detalle->catalogo->marca->nombre }} {{ $detalle->catalogo->modelo }} {{ $detalle->catalogo->descripcion }}</td>
                                        <td>{{ $detalle->cantidad }}</td>               
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop