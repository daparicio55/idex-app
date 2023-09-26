@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Modulos Formativos
		<a href="{{route('sacademica.mformativos.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Modulo Formativo
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


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Nombre del Módulo</th>
                    <th>Programa de Estudios</th>
                    <th>Itinerario</th>
                    <th>Horas</th>
                    <th>Creditos</th>
                </thead>
                @foreach ($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nombre }}</td>
                        <td>{{ $modulo->carrera->nombreCarrera }}</td>
                        <td>{{ $modulo->itinerario->nombre }}</td>
                        <td>{{ $modulo->horas }}</td>
                        <td>{{ $modulo->creditos }}</td>
                        <td style="width: 230px; text-align: center">
                            <a class="btn btn-success" title="editar modulo formativo" href="{{ route('sacademica.mformativos.edit',$modulo->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route'=>'sacademica.ability.index','method'=>'get','class'=>'d-inline']) !!}
                                <input type="hidden" name="mformativo_id" value="{{ $modulo->id }}">
                                <button type="submit" title="Capacidades" class="btn btn-warning">
                                    <i class="fas fa-list-ol"></i>
                                </button>
                            {!! Form::close() !!}
                            <a class="btn btn-primary" title="unidades didacticas" href="{{ route('sacademica.mformativos.show',$modulo->id) }}">
                                <i class="fas fa-book"></i>
                            </a>
                            <a class="btn btn-danger" href="" data-target="#modal-delete-{{$modulo->id}}" data-toggle="modal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        @include('sacademica.mformativos.modal')
                    </tr>
                @endforeach
            </table>
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
    });
	</script>
@stop