@extends('adminlte::page')
@section('title', 'Documentos Finalizados')

@section('content_header')
    <h1><b>Sistema de Trámite Documentario</b></h1>
    <span class="text-success font-italic">bandeja de documentos finalizados</span>
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
@foreach ($finalizados as $finalizado)
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th colspan="7">
                            <h4><i class="fas fa-shipping-fast"></i> Datos del Documento </h4> 
                            {{-- @if($finalizados->revisado == 'NO') 
                                <span class="text-danger font-italic">pendiente</span>
                            @else
                                <span class="text-success font-italic">recepcionado</span>
                                
                            @endif   --}}                          
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
                            <b>
                                @php
                                    $letras = Str::length($finalizado->documento->numero);
                                @endphp
                                @if ($letras == 1)
                                    000{{ $finalizado->documento->numero }}    
                                @endif
                                @if ($letras == 2)
                                    00{{ $finalizado->documento->numero }}    
                                @endif
                                @if ($letras == 3)
                                    0{{ $finalizado->documento->numero }}    
                                @endif
                                @if ($letras == 4)
                                    {{ $finalizado->documento->numero }}    
                                @endif
                            </b>
                        </td>
                        <td>{{ $finalizado->documento->hora }}</td>
                        <td>{{ date('d-m-Y',strtotime($finalizado->documento->fecha)) }}</td>
                        <td>{{ $finalizado->documento->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($finalizado->documento->cliente->apellido) }}, {{ Str::title($finalizado->documento->cliente->nombre) }}</td>
                        <td>{{ $finalizado->documento->tipo->nombre }}</td>
                        <td style="text-align: center">{{ $finalizado->documento->folios }}</td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td><b>Asunto</b></td>
                        <td colspan="5">
                            {{ $finalizado->documento->asunto }}
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td><b>Observacion</b></td>
                        <td colspan="5">
                            {{ $finalizado->documento->observacion }}
                        </td>
                    </tr>
                    <th colspan="7">
                        <h4><i class="far fa-clock"></i> Datos del Envio</h4>
                    </th>
                    <tr>
                        <td colspan="2"><b>Enviado por:</b></td>
                        <td colspan="3">
                            {{ $finalizado->envia->name }}
                        </td>
                        <td colspan="2" rowspan="3">
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Correo:</b></td>
                        <td colspan="3">
                            {{ $finalizado->envia->email }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Observacion:</b></td>
                        <td colspan="3">
                            {{ $finalizado->observacion }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Folios</b></td>
                        <td colspan="1">{{ $finalizado->folios }}</td>
                        <td colspan="4" style="text-align: right"> fecha: {{ date('d-m-Y',strtotime($finalizado->fecha)) }} hora: {{ $finalizado->hora }}</td>
                    </tr>
                    <tr>
                        <td colspan="7" style="background-color: gray"></td>
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