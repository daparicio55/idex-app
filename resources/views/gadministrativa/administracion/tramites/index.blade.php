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
                <tr>
                    <td>{{ ceros($tramite->numero) }}</td>
                    <td>{{ $tramite->requerimiento->encabezado }} {{ $tramite->requerimiento->asunto }}</td>
                    <td style="width: 110px">{{ date('d-m-Y',strtotime($tramite->fecha)) }}</td>
                    <td>
                        <a href="{{ route('gadministrativa.administracion.tramites.show',$tramite->id) }}" class="btn btn-info" title="Ver trámite">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('gadministrativa.administracion.tramites.edit',$tramite->id) }}" class="btn btn-success" title="Editar trámite">
                            <i class="fas fa-edit"></i> 
                        </a>
                        <button type="button" class="btn btn-danger" title="Eliminar trámite" data-toggle="modal" data-target="#modal-delete-{{ $tramite->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    @include('gadministrativa.administracion.tramites.modal')
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop