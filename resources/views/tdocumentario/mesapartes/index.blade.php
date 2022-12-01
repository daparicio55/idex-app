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
<p class="text-primary">Lista de los Expedientes Registrados en el sistema ......</p>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 60px; text-align: center">#</th>
                    <th style="width: 100px">Hora</th>
                    <th style="width: 110px">Fecha</th>
                    <th style="width: 120px">DNI</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th style="width: 60px; text-align: center">Folios</th>
                </thead>
                <tbody>
                @foreach ($documentos as $documento)
                    <tr>
                        <td style="text-align: center">
                            <a href="" data-target="#modal-numero-{{$documento->id}}" data-toggle="modal" class="btn btn-warning">
                                <b class="text-primary">
                                @php
                                    $letras = Str::length($documento->numero);
                                @endphp
                                @if ($letras == 1)
                                    000{{ $documento->numero }}    
                                @endif
                                @if ($letras == 2)
                                    00{{ $documento->numero }}    
                                @endif
                                @if ($letras == 3)
                                    0{{ $documento->numero }}    
                                @endif
                                @if ($letras == 4)
                                    {{ $documento->numero }}    
                                @endif
                                </b>
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