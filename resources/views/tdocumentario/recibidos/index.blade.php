@extends('adminlte::page')
@section('title', 'Trámite Documentario')

@section('content_header')
    <h1><b>Sistema de Trámite Documentario</b></h1>
    <span class="text-primary font-italic"><b>bandeja de entrada</b></span>
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
@foreach ($recibidos as $recibido)
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="7">
                            <h4>
                                @if($recibido->revisado == 'NO')
                                    <i class="fas fa-envelope"></i> Datos del Documento
                                @else
                                    <i class="fas fa-envelope-open-text"></i> Datos del Documento
                                @endif
                            </h4> 
                            @if($recibido->revisado == 'NO')
                                <a href="" data-target="#modal-recibido-{{$recibido->id}}" data-toggle="modal">
                                    <i class="text-danger">marcar como recibido</i>
                                </a>
                            @else
                                <i class="text-success">Recibido <i class="fas fa-calendar-check"></i> {{ date('d-m-Y',strtotime($recibido->rfecha)) }} <i class="fas fa-clock"></i> {{ $recibido->rhora }}</i>
                                @if ($recibido->documento->finalizado == 'SI')
                                - <i class="text-warning">finalizado</i>
                                @endif
                            @endif                            
                        </th>
                    </tr>
                    <tr>       
                        <th style="width: 60px; text-align: center">#</th>
                        <th style="width: 100px">Hora</th>
                        <th style="width: 110px">Fecha</th>
                        <th style="width: 120px">DNI</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th style="width: 60px; text-align: center">Folios</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td style="text-align: center">
                            <b class="text-success">
                                @php
                                    $letras = Str::length($recibido->documento->numero);
                                @endphp
                                @if ($letras == 1)
                                    000{{ $recibido->documento->numero }}    
                                @endif
                                @if ($letras == 2)
                                    00{{ $recibido->documento->numero }}    
                                @endif
                                @if ($letras == 3)
                                    0{{ $recibido->documento->numero }}    
                                @endif
                                @if ($letras == 4)
                                    {{ $recibido->documento->numero }}    
                                @endif
                            </b>
                        </td>
                        <td>{{ $recibido->documento->hora }}</td>
                        <td>{{ date('d-m-Y',strtotime($recibido->documento->fecha)) }}</td>
                        <td>{{ $recibido->documento->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($recibido->documento->cliente->apellido) }}, {{ Str::title($recibido->documento->cliente->nombre) }}</td>
                        <td>{{ $recibido->documento->tipo->nombre }}</td>
                        <td style="text-align: center">{{ $recibido->documento->folios }}</td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td><b>Asunto</b></td>
                        <td colspan="5">
                            {{ $recibido->documento->asunto }}
                        </td>
                    </tr>
                    <tr>
                        <td>
 
                        </td>
                        <td><b>Observacion</b></td>
                        <td colspan="5">
                            {{ $recibido->documento->observacion }}
                        </td>
                    </tr>
                    <th colspan="7">
                        <h4><i class="far fa-clock"></i> Datos del Envio</h4>
                    </th>
                    <tr>
                        <td colspan="2"><b>Enviado por:</b></td>
                        <td colspan="3">
                            {{ $recibido->envia->name }}
                        </td>
                        <td style="text-align: center" colspan="2">
                            @if($recibido->revisado == 'SI')
                                @if ($recibido->documento->finalizado == 'NO')
                                    <a href="" class="btn btn-primary" data-target="#modal-enviar-{{$recibido->id}}" data-toggle="modal">
                                        <i class="fas fa-share-square"></i> enviar
                                    </a>
                                @endif
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Correo:</b></td>
                        <td colspan="3">
                            {{ $recibido->envia->email }}
                        </td>
                        <td style="text-align: center" colspan="2">
                            @if($recibido->revisado == 'SI')
                                @if ($recibido->documento->finalizado == 'NO')
                                    <a href="" class="btn btn-warning" data-target="#modal-finalizar-{{$recibido->id}}" data-toggle="modal">
                                        <i class="fas fa-stamp"></i> finalizar
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Observacion:</b></td>
                        <td colspan="3">
                            {{ $recibido->observacion }}
                        </td>
                        <td colspan="2" rowspan="2">

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Folios</b></td>
                        <td colspan="1">{{ $recibido->folios }}</td>
                        <td colspan="2" style="text-align: right"> fecha: {{ date('d-m-Y',strtotime($recibido->fecha)) }} hora: {{ $recibido->hora }}</td>
                    </tr>
                    <tr>
                        <td colspan="7" style="background-color: gray">
                            @include('tdocumentario.recibidos.modal')
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach  
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