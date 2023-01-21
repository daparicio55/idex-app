@extends('adminlte::page')
@section('title', 'Hoja de Vida')

@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Creacion de tu Hoja de Vida</h3>
	</div>
</div>
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

<a class="btn btn-info" href="{{ route('docentes.cv.personales.create') }}"><i class="fa fa-user" aria-hidden="true"></i> Datos Personales</a>
<a class="btn btn-primary" href="{{ route('docentes.cv.estudios.index') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Estudios Realizados</a>
{{-- <a href="{{asset('cv/capacitaciones/')}}">Capacitaciones y/o Actualizaciones</a>
<br> --}}
<a class="btn btn-success" href="{{ route('docentes.cv.experiencias.index') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Experiencia Laboral</a>
<a class="btn btn-danger" href="{{ route('docentes.cv.conocimientos.create') }}"><i class="fas fa-bahai"></i> Conocimientos</a>
<a class="btn btn-warning" href="{{ route('docentes.cvs.show',auth()->id()) }}">
    <i class="fas fa-file-pdf"></i> Generar Hoja de Vida
</a>

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