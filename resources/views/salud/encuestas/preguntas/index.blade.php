@extends('adminlte::page')
@section('title', 'Gestion de Encuestas')
@section('content_header')
{!! Form::open(['route'=>'salud.preguntas.create','method'=>'get']) !!}
<h1> Lista de Preguntas.
    {!! Form::hidden('survey_id', $survey->id, [null]) !!}
    <button type="submit" class="btn btn-success">
        <i class="fas fa-hospital"></i> Nueva Pregunta.
    </button>
</h1>
{!! Form::close() !!}

<p class="mt-2"><b>Nombre de la Encusta:</b>  {{ $survey->name_es }}</p>
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
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($survey->questions()->orderBy('id','desc')->get() as $question)
                    <tr>
                        <td><b>Español:</b> {{ $question->group_es }} <br> <b>Awajum:</b> {{ $question->group_awa }}</td>
                        <td><b>Español:</b> {{ $question->name_es }} <br> <b>Awajum:</b> {{ $question->name_awa }}</td>
                        <td>
                            <a href="{{ route('salud.preguntas.show',$question->id) }}" class="btn btn-info mb-1" title="alternativas">
                                <i class="fa fa-list"></i> 
                            </a>
                            <a title="editar" href="{{ route('salud.preguntas.edit',$question->id) }}" class="btn btn-success mb-1" title="editar">
                                <i class="fa fa-edit"></i> 
                            </a>
                            <a title="borrar" data-toggle="modal" data-target="#modal-delete-{{ $question->id }}" class="btn btn-danger mb-1" title="eliminar">
                                <i class="fa fa-trash"></i> 
                            </a>
                        </td>
                        @include('salud.encuestas.preguntas.modal')
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