@extends('adminlte::page')
@section('title', 'Estadisticas')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Reporte de Matrículas</h1>
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
{!! Form::open(['route'=>'sacademica.estadisticas.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Admision', [null]) !!}
    {!! Form::select('id', $periodos, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@if (isset($matriculados))
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>#</th>
                    <th>NÚMERO</th>
                    <th>APELLIDOS</th>
                    <th>NOMBRES</th>
                    <th>FECHA</th>
                    <th>SEXO</th>
                    <th>CORREO</th>
                    <th>CELULAR</th>
                    <th>PERIODO</th>
                    <th>CICLO</th>
                    <th>PROGRAMA DE ESTUDIOS</th>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($matriculados as $matriculado)
                        <tr>
                            <td>
                                {{ $contador }}
                                @php
                                    $contador++;
                                @endphp
                            </td>
                            <td>{{ $matriculado->estudiante->postulante->cliente->dniRuc }}</td>
                            <td>{{ Str::title($matriculado->estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ Str::upper($matriculado->estudiante->postulante->cliente->apellido )}}</td>
                            <td>{{ date('d/m/Y',strtotime($matriculado->estudiante->postulante->fechaNacimiento)) }}</td>
                            <td>{{ Str::upper($matriculado->estudiante->postulante->sexo) }}</td>
                            <td>{{ $matriculado->estudiante->postulante->cliente->dniRuc }}@idexperujapon.edu.pe</td>
                            <td>{{ $matriculado->estudiante->postulante->cliente->telefono }}</td>
                            <td>{{ $matriculado->matricula->nombre }}</td>
                            <td>{{ $matriculado->detalles[0]->unidad->modulo->unidades[0]->ciclo }}</td>
                            <td>{{ $matriculado->estudiante->postulante->carrera->nombreCarrera }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
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