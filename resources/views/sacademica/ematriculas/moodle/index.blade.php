@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Reporte Moodle</h1>
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
{!! Form::open(['route'=>'sacademica.moodle.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Matrícula', [null]) !!}
    {!! Form::select('id', $periodo, null, ['class'=>'form-control']) !!}
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
                    <th>username</th>
                    <th>password</th>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>email</th>
                    @for ($i = 1; $i <= $maximo; $i++)
                        <th>course{{ $i }}</th>
                    @endfor
                </thead>
                <tbody>
                    @foreach ($matriculados as $matriculado)
                        <tr>
                            <td>{{ $matriculado->estudiante->postulante->cliente->dniRuc }}</td>
                            <td>Pj{{ $matriculado->estudiante->postulante->cliente->dniRuc }}</td>
                            <td>{{ Str::title($matriculado->estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ Str::upper($matriculado->estudiante->postulante->cliente->apellido )}}</td>
                            <td>{{ $matriculado->estudiante->postulante->cliente->dniRuc }}@idexperujapon.edu.pe</td>
                            @foreach ($matriculado->detalles as $detalle)
                                @if ($detalle->tipo <> 'Convalidacion')
                                <td>{{ $detalle->unidad->moodle }}</td>
                                @endif
                            @endforeach
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