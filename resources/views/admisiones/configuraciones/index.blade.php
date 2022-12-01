@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Procesos de Admisión IDEX Perú Japón
		<a href="{{route('admisiones.configuraciones.create')}}" class="btn btn-primary">
			<i class="fas fa-plus"></i> Nuevo
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
{{-- mostramos la lista de procesos de admision --}}
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                   <th>Nombre</th>
                   <th>Periodo</th>
                   <th>Preguntas</th>
                   <th>Ord. Fecha</th>
                   <th>Ord. Hora</th>
                   <th>Exo. Fecha</th>
                   <th>Exo. Hora</th>
                   <th>Puntos</th>
                   <th>Encontra</th>
                </thead>
                <tbody>
                    @foreach ($admisiones as $admisione)
                        <tr>
                            <td>{{ $admisione->nombre }}</td>
                            <td>{{ $admisione->periodo }}</td>
                            <td>{{ $admisione->preguntas }}</td>
                            <td>{{ date('d-m-Y',strtotime($admisione->fecha)) }}</td>
                            <td>{{ $admisione->hora }}</td>
                            <td>{{ date('d-m-Y',strtotime($admisione->efecha)) }}</td>
                            <td>{{ $admisione->ehora }}</td>
                            <td>{{ $admisione->puntos }}</td>
                            <td>{{ $admisione->encontra }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('admisiones.configuraciones.edit',$admisione->id) }}" class="btn btn-success" title="editar proceso de admision">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url(asset('admisiones/vacantes/?id='.$admisione->id)) }}" class="btn btn-warning" title="configurar vacantes">
                                    <i class="fas fa-users"></i>
                                </a>
                                <a href="{{ route('admisiones.alternativas.show',$admisione->id) }}" class="btn btn-primary" title="configuracion de respuestas">
                                    <i class="fas fa-question"></i>
                                </a>
                                <a href="" data-target="#modal-delete-{{ $admisione->id }}" data-toggle="modal" class="btn btn-danger" title="eliminar proceso de admision">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admisiones.configuraciones.modal')
                    @endforeach
                </tbody>
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