@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Vacantes por Programa de Estudios - IDEX Perú Japón
		<a href="{{url(asset('admisiones/vacantes/create/?id='.$admisione->id))}}" class="btn btn-success">
			<i class="fas fa-plus"></i> Nuevo <i class="fas fa-user-astronaut"></i>
		</a>
	</h1>
    <span>{{ $admisione->nombre }}</span>
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
                    <th>Proceso Admision</th>
                    <th>Programa de Estudios</th>
                    <th>Vacantes</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($vacantes as $vacante)
                        <tr>
                            <td>{{ $vacante->admision->nombre }}</td>
                            <td>{{ $vacante->carrera->nombreCarrera }}</td>
                            <td>{{ $vacante->cantidad }}</td>
                            <td style="width: 115px">
                                <a href="{{ route('admisiones.vacantes.edit',$vacante->id) }}" class="btn btn-success" title="editar proceso de admision">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" data-target="#modal-delete-{{ $vacante->id }}" data-toggle="modal" class="btn btn-danger" title="eliminar proceso de admision">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admisiones.vacantes.modal')
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