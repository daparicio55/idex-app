@extends('adminlte::page')

@section('title', 'Requerimientos | SISGE')

@section('content_header')
    <h1>Requerimientos</h1>
    <a href="{{ route('gadministrativa.requerimientos.create') }}"class="btn btn-success mt-1">
        <i class="fas fa-list"></i> Nuevo
    </a>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success" id='info'>
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" id='error'>
            <strong>{{session('error')}}</strong>
        </div>
    @endif
    @include('gadministrativa.requerimientos.partes.search')
    <p>Lista de Requerimientos:</p>
    <div class="table-responsive">
        <div class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Encabezado</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requerimientos as $key => $requerimiento)
                        <tr>
                            <td>{{ ceros($requerimiento->numero) }}</td>
                            <td>{{ $requerimiento->encabezado }}</td>
                            <td>{{ $requerimiento->asunto }}</td>
                            <td style="width: 120px">{{ date('d-m-Y',strtotime($requerimiento->fecha)) }}</td>
                            <th style="width: 180px">
                                <a href="{{ route('gadministrativa.requerimientos.show',$requerimiento->id) }}" class="btn btn-warning">
                                    <i class="fas fa-print"></i> 
                                </a>
                                <a class="btn btn-success" type="button" title="Editar requerimiento" href="{{ route('gadministrativa.requerimientos.edit',$requerimiento->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#modal-delete-{{ $requerimiento->id }}" type="button" class="btn btn-danger" title="eliminar requerimiento">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </th>
                        </tr>
                        @include('gadministrativa.requerimientos.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
        setTimeout(() => {
            $("#info").hide();
        }, 12000);
        });
        $(document).ready(function(){
            setTimeout(() => {
            $("#error").hide();
        }, 12000);
        });
	</script>
@stop