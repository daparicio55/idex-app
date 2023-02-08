@extends('adminlte::page')
@section('title', 'Gestion de Encuestas')
@section('content_header')
{!! Form::open(['route'=>'salud.alternativas.create','method'=>'get']) !!}
<h1>
    <a href="{{ route('salud.encuestas.show',$squestion->survey->id) }}" class="btn btn-danger">
        <i class="fas fa-angle-left"></i>
    </a>
    Lista de Alternativas.
    {!! Form::hidden('squestion_id', $squestion->id, [null]) !!}
</h1>
<button type="submit" class="btn btn-success mt-2">
    <i class="fas fa-hospital"></i> Nueva Alternativa.
</button>
{!! Form::close() !!}

<p class="mt-2"><b>Nombre de la Pregunta:</b>  {{ $squestion->name_es }}</p>
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
                    <th>Nombre</th>
                    <th>Puntos</th>
                    <th>Observacion Requerida</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($squestion->alternatives as $alternative)
                    <tr>
                        <td><b>Español:</b> {{ $alternative->name_es }} <br> <b>Awajum:</b> {{ $alternative->name_awa }}</td>
                        <td>{{ $alternative->point }}</td>
                        <td>
                            @if ($alternative->required == 0)
                                No requiere Observacion
                            @else
                                Requiere Obsevacion
                            @endif
                        </td>
                        <td>
                            <a title="editar" href="{{ route('salud.alternativas.edit',$alternative->id) }}" class="btn btn-success mb-1" title="editar">
                                <i class="fa fa-edit"></i> 
                            </a>
                            <a title="borrar" data-toggle="modal" data-target="#modal-delete-{{ $alternative->id }}" class="btn btn-danger mb-1" title="eliminar">
                                <i class="fa fa-trash"></i> 
                            </a>
                        </td>
                        @include('salud.encuestas.alternativas.modal')
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