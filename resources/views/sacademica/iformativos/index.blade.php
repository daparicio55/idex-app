@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Itinearios Formativos
		<a href="{{route('sacademica.iformativos.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Itinerario
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
                    <th>Nombre</th>
                    <th>Creditos</th>
                </thead>
                @foreach ($itinerarios as $itinerario)
                    <tr>
                        <td>{{ $itinerario->nombre }}</td>
                        <td>{{ $itinerario->creditos }}</td>
                        <td style="width: 210px; text-align: center">
                            <a class="btn btn-success" title="editar modulo formativo" href="{{ route('sacademica.iformativos.edit',$itinerario->id) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a class="btn btn-danger" href="" data-target="#modal-delete-{{$itinerario->id}}" data-toggle="modal">
                                <i class="fas fa-trash-alt"></i> Borrar
                            </a>
                        </td>
                        @include('sacademica.iformativos.modal')
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