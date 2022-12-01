@extends('adminlte::page')
@section('title', 'Convalidaciones')

@section('content_header')
    <h1>Convalidaciones
		<a href="{{route('sacademica.convalidaciones.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo
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
@include('sacademica.convalidaciones.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>DNI</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($convalidaciones as $convalidacion)
                        <tr >
                            <td>{{ $convalidacion->estudiante->postulante->cliente->dniRuc }}</td>
                            <td>{{ Str::upper($convalidacion->estudiante->postulante->cliente->apellido) }}, {{ Str::title($convalidacion->estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ $convalidacion->estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td style="text-align: center; width: 130px">
                                <a data-toggle="modal" data-target="#delete-{{ $convalidacion->id }}" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><h5 class="text-primary">Convalidaciones:</h5></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Ciclo</th>
                                        <th>Tipo</th>
                                        <th>Unidad Didactica</th>
                                        <th>Nota</th>
                                        <th>Observación</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cantidad = count($convalidacion->detalles);
                                        @endphp
                                        @foreach ($convalidacion->detalles as $detalle)
                                            @if ($detalle->tipo == "Convalidacion")
                                            <tr>
                                                <td class="text-primary">{{ $cantidad }}</td>
                                                <td>{{ $detalle->unidad->ciclo }}</td>
                                                <td>{{ $detalle->unidad->tipo }}</td>
                                                <td>
                                                    {{ $detalle->unidad->nombre }}
                                                </td>
                                                <td>{{ $detalle->nota }}</td>
                                                <td>{{ $detalle->observacion }}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#editar-{{ $detalle->id }}" class="btn btn-outline-success" title="editar nota">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#detalle-eliminar-{{ $detalle->id }}" class="btn btn-outline-danger" title="elimnar nota">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('sacademica.convalidaciones.eleminar')
                                            @endif
                                            @php
                                                $cantidad --;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @include('sacademica.convalidaciones.delete')
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            @if(!isset($search))
                            {{ $convalidaciones->links() }}
                            @endif
                        </td>
                    </tr>
                </tfoot>
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