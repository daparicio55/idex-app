@extends('adminlte::page')
@section('title', 'Cepre')

@section('content_header')
    <h1><i class="fas fa-id-card text-success"></i> Carnets</h1>
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
{!! Form::open(['route'=>'cepres.carnets.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('idCepre', 'Periodo de Cepre (TODOS LOS ALUMNOS)', [null]) !!}
    {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-id-badge"></i> Generar Carnets
    </button>
</div>
{!! Form::close() !!}
{{-- formulario si es para escoger los alumnos --}}
{!! Form::open(['route'=>['cepres.carnets.create'],'method'=>'get']) !!}
<div class="form-group">
    {!! Form::label('idCepre', 'Periodo de Cepre (ALUMNOS PERSONALIZADO)', [null]) !!}
    {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-info" type="submit">
        <i class="fas fa-id-badge"></i> Seleccionar
    </button>
</div>
{!! Form::close() !!}
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