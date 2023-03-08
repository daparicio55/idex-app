@extends('adminlte::page')
@section('title', 'Trámite Documentario')

@section('content_header')
    <h1>Sistema de Trámite Documentario
		<a href="{{route('tdocumentario.mesapartes.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Registrar Nuevo
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
<!-- campos de busquedas -->
{!! Form::model($request,['route'=>'tdocumentario.mesapartes.index','method'=>'get','role'=>'search']) !!}
<div class="row">
    {!! Form::hidden('buscar', 'si', [null]) !!}
    <div class="col-sm-12 col-md-2">
        {!! Form::label('dniRuc', 'Dni/Ruc', [null]) !!}
        {!! Form::text('dniRuc', null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-12 col-md-3">
        {!! Form::label('asunto', 'Asunto', [null]) !!}
        {!! Form::text('asunto', null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-12 col-md-3">
        {!! Form::label('observacion', 'Observacion', [null]) !!}
        {!! Form::text('observacion', null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-sm-12 col-md-2">
        {!! Form::label('finicio','F. Inicio', [null]) !!}
        {!! Form::date('finicio', null, ['class'=>'form-control','required',]) !!}
    </div>
    <div class="col-sm-12 col-md-2">
        {!! Form::label('ffin','F. Fin', [null]) !!}
        {!! Form::date('ffin', null, ['class'=>'form-control','required']) !!}
    </div>
    <div class="col-sm-12 col-md-12 mt-2">
        <button class="btn btn-info" type="submit">
            <i class="fab fa-searchengin"></i>   Buscar
        </button>
        <a href="{{ route('tdocumentario.mesapartes.index') }}" class="btn btn-warning">
           <i class="fas fa-broom"></i> Limpiar
        </a>
    </div>
</div>
{!! Form::close() !!}
<p class="text-primary mt-3">Lista de los Expedientes Registrados en el sistema</p>
<div class="row mt-2">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 60px; text-align: center">#</th>
                    <th style="width: 100px">Hora</th>
                    <th style="width: 110px">Fecha</th>
                    <th style="width: 120px">DNI/RUC</th>
                    <th>Cliente/Razon Social</th>
                    <th>Tipo</th>
                    <th style="width: 60px; text-align: center">Folios</th>
                </thead>
                <tbody>
                @foreach ($documentos as $documento)
                    <tr>
                        <td style="text-align: center">
                            <a href="" data-target="#modal-numero-{{$documento->id}}" data-toggle="modal" class="btn btn-warning">
                                <span class="text-black">
                                    {{ ceros($documento->numero) }}
                                </span>
                            </a>
                        </td>
                        <td>{{ $documento->hora }}</td>
                        <td>{{ date('d-m-Y',strtotime($documento->fecha)) }}</td>
                        <td>{{ $documento->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($documento->cliente->apellido) }}, {{ Str::title($documento->cliente->nombre) }}</td>
                        <td>{{ $documento->tipo->nombre }}</td>
                        <td style="text-align: center">{{ $documento->folios }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <a href="" data-target="#modal-delete-{{$documento->id}}" data-toggle="modal" title="eliminar este documento" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        <td><b>Asunto</b></td>
                        <td colspan="3">
                            {{ $documento->asunto }}
                        </td>
                        <td colspan="2" style="text-align: center">
                            @if($documento->enviado == "NO")
                                <a href="" data-target="#modal-enviar-{{$documento->id}}" data-toggle="modal" class="btn btn-primary">
                                    <i class="fas fa-file-import"></i> enviar
                                </a>
                            @else
                                <span class="font-italic font-weight-bold text-success">documento enviado ...</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: gray" colspan="7">
                            @include('tdocumentario.mesapartes.modal')
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    @if(!isset($request->buscar))
                        <tr>
                            <td colspan="7">{{ $documentos->links() }}</td>
                        </tr>
                    @endif
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
    $('#frm_eliminar').submit(function(event){
        $("#btn_eliminar").attr("disabled",true);
    });
    $('#frm_cambiar').submit(function(event){
        $("#btn_cambiar").attr("disabled",true);
    });
    $('#frm_enviar').submit(function(event){
        $("#btn_enviar").attr("disabled",true);
    });
	</script>
@stop