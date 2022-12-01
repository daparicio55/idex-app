@extends('adminlte::page')
@section('title', 'Nominas')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Seleccione los criterios de busqueda para las nóminas</h1>
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
{!! Form::open(['route'=>'sacademica.nominas.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
        {!! Form::label('idCarrera', 'Programa de Estudios', [null]) !!}
        {!! Form::select('idCarrera', $programas, null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        {!! Form::label('pmatricula_id', 'P. Matricula', [null]) !!}
        {!! Form::select('pmatricula_id', $matriculas, null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
        {!! Form::label('ciclo', 'Ciclo', [null]) !!}
        {!! Form::select('ciclo', ciclos(), null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        {!! Form::label('tipo', 'Tipo', [null]) !!}
        {!! Form::select('tipo', $tipos, null, ['class'=>'form-control']) !!}
    </div>
</div>
<br>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Nomina
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
    $('#frm_modal').submit(function(event){
        $("#btn_subir").attr("disabled",true);
    });
	</script>
@stop