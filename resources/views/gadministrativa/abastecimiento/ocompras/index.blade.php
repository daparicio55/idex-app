@extends('adminlte::page')

@section('title', 'Abastecimiento')

@section('content_header')
    <h1>Ordenes de Compras</h1>
    <a href="{{ route('gadministrativa.abastecimiento.ocompras.create') }}" class="btn btn-success mt-1">
        <i class="fas fa-plus-circle"></i> Nueva
    </a>
@stop

@section('content')
    <x-alert/>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Referencia</th>
                    <th>Usuario</th>
                    <th>Oficina</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ocompras as $ocompra)
                    <tr>
                        <td>{{ ceros($ocompra->numero) }}</td>
                        <td>{{ date('d-m-Y',strtotime($ocompra->fecha)) }}</td>
                        <td>{{ $ocompra->tramite->requerimiento->encabezado }}</td>
                        <td>{{ $ocompra->tramite->requerimiento->user->name }}</td>
                        <td>{{ $ocompra->tramite->requerimiento->user->oficina->nombre }}</td>
                        <td>
                            <a href="{{ route('gadministrativa.abastecimiento.ocompras.show',$ocompra->id) }}" class="btn btn-warning" title="Imprimir orden de compra">
                                <i class="fa fa-print"></i>
                            </a>
                            <button type="button" class="btn btn-danger" title="Eliminar orden de compra" data-toggle="modal" data-target="#modal-delete-{{ $ocompra->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('gadministrativa.abastecimiento.ocompras.modal')
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop