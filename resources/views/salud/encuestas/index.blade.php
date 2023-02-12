@extends('adminlte::page')
@section('title', 'Gestion de Encuestas')
@section('content_header')
<h1> Lista de Encuestas.
    <a href="{{route('salud.encuestas.create')}}" class="btn btn-success">
        <i class="fas fa-hospital"></i> Nueva Encuesta.
    </a>
</h1>
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
{{-- contenido --}}
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Introduccion</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surveys as $survey)
                    <tr>
                        <td><b>Español:</b> {{ $survey->name_es }} <br> <b>Awajun:</b> {{ $survey->name_awa }}</td>
                        <td><b>Español:</b> {{ $survey->introduction_es }} <br> <b>Awajun:</b> {{ $survey->introduction_awa }}</td>
                        <td>{{ $survey->type }}</td>
                        <td>
                            <a class="btn btn-warning mb-1" title="descargar resultados" href="{{ route('salud.encuestas.download',$survey->id) }}">
                                <i class="fas fa-download"></i>  
                            </a>
                            <a href="{{ route('salud.encuestas.show',$survey->id) }}" class="btn btn-info mb-1" title="preguntas">
                                <i class="fa fa-question"></i> 
                            </a>
                            <a title="editar" href="{{ route('salud.encuestas.edit',$survey->id) }}" class="btn btn-success mb-1" title="editar">
                                <i class="fa fa-edit"></i> 
                            </a>
                            <a title="borrar" data-toggle="modal" data-target="#modal-delete-{{ $survey->id }}" class="btn btn-danger mb-1" title="eliminar">
                                <i class="fa fa-trash"></i> 
                            </a>
                        </td>
                        @include('salud.encuestas.modal')
                    </tr>
                @endforeach
            </tbody>
        </div>
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
    })
</script>
@stop