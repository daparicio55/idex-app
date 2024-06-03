@extends('adminlte::page')

@section('title', 'Trámite de Requerimientos')

@section('content_header')
    <h1>Trámite de requerimientos</h1>
    <a href="{{ route('gadministrativa.administracion.tramites.index') }}" class="btn btn-danger mt-2">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop
@section('content')
<x-adminlte-card title="N° {{ ceros($tramite->numero) }} - {{ $tramite->requerimiento->encabezado }}" theme="info" icon="fas fa-list-ol">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Destino</th>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tramite->tramiteDetalles as $detalle)
                    <tr>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->destino }}</td>
                        <td>{{ $detalle->catalogo->codigo }}</td>
                        <td>{{ $detalle->catalogo->marca->nombre }}</td>
                        <td>{{ $detalle->catalogo->modelo }}</td>
                        <td>{{ $detalle->catalogo->descripcion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-adminlte-card>
@stop