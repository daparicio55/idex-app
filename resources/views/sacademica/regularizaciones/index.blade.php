@extends('adminlte::page')
@section('title', 'Convalidaciones')

@section('content_header')
    <h1>Regularizaciones o Extraornarios
		<a href="{{route('sacademica.regularizaciones.create')}}" class="btn btn-success">
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
@include('sacademica.regularizaciones.searchdni')
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
                    @foreach ($regularizaciones as $regularizacione)
                        <tr>
                            <td>{{ $regularizacione->estudiante->postulante->cliente->dniRuc }}</td>
                            <td>{{ Str::upper($regularizacione->estudiante->postulante->cliente->apellido) }}, {{ Str::title($regularizacione->estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ $regularizacione->estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td style="text-align: center; width: 130px">
                                <a data-toggle="modal" data-target="#delete-{{ $regularizacione->id }}" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><h5 class="text-primary">Regularizaciones o Extraordinarios:</h5></td>
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
                                            $contador = 1;
                                        @endphp
                                        @foreach ($regularizacione->detalles as $detalle)
                                            @if ($detalle->tipo == "Regularizacion" || $detalle->tipo == "Extraordinario")
                                            <tr>
                                                <th>{{ $contador }}</th>
                                                <td>{{ $detalle->unidad->ciclo }}</td>
                                                <td>{{ $detalle->unidad->tipo }}</td>
                                                <td>
                                                    {{ $detalle->unidad->nombre }}
                                                </td>
                                                <td>{{ $detalle->nota }}</td>
                                                <td>{{ $detalle->observacion }} - {{ $detalle->tipo }}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#editar-{{ $detalle->id }}" class="btn btn-outline-success" title="editar nota">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#detalle-eliminar-{{ $detalle->id }}" class="btn btn-outline-danger" title="elimnar nota">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('sacademica.regularizaciones.eleminar')
                                            @php
                                                $contador ++;
                                            @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @include('sacademica.regularizaciones.delete')
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            @if(!isset($search))
                            {{ $regularizaciones->links() }}
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