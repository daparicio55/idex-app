@extends('adminlte::page')

@section('title', 'Repocitorio | Inicio')

@section('content_header')
    <h1>Documentos del Repositorio</h1>
    <a href="{{route('repositorios.create')}}" class="btn btn-info">
        <i class="fas fa-clipboard-list"></i> Nuevo Registro
    </a>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong><i class="fas fa-check"></i> {{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong><i class="fas fa-exclamation-circle"></i> {{session('error')}}</strong>
    </div>
@endif
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <th></th>
                <th>Tipo Doc.</th>
                <th>N.</th>
                <th>Asunto</th>
                <th>Fecha</th>
            </thead>
            <tbody>
                @foreach ($repositorios as $repositorio)
                    <tr>
                        <td>
                            <a class="mr-2" href="{{route('repositorios.edit',['repositorio'=>$repositorio->id])}}" title="Editar">
                                <i class="fas fa-edit fa-2x"></i>
                            </a>
                            <a class="mr-2" href="{{Storage::url($repositorio->url)}}" title="mostrar pdf">
                                <i class="far fa-file-pdf fa-2x text-success"></i>
                            </a>
                            <a class="mr-2" href="" data-target="#modal-delete-{{$repositorio->id}}" data-toggle="modal" title="Eliminar">
                                <i class="fas fa-trash-alt fa-2x text-danger"></i>
                            </a>
                        </td>
                        <td>{{$repositorio->documentotipo->nombre}}</td>
                        <td>{{$repositorio->numero}}</td>
                        <td>{{$repositorio->asunto}}</td>
                        <td>{{date('d-m-Y',strtotime($repositorio->fecha))}}</td>
                        @include('repositorios.modal')
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    $(document).ready(function(){
        setTimeout(() => {
        $("#info").hide();
    }, 9000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
    }, 9000);
    });
    </script>
@stop
