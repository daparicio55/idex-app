@extends('adminlte::page')
@section('title', 'Admisiones Exonerados')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Estudiantes con pago completo para el exámen</h1>
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
{!! Form::open(['route'=>'admisiones.exonerados.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Admisión', [null]) !!}
    {!! Form::select('id', $admisiones, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@if (isset($admision))
    {{-- voy a mostrar todos los aluimnos que tengo en exonerados para este periodo --}}
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
    $('#frm_modal').submit(function(event){
        $("#btn_subir").attr("disabled",true);
    });
	</script>
@stop

