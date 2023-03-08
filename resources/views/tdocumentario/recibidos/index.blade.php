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


<div id="accordion">
    @foreach ($recibidos as $key => $recibido)
        <div class="card">
            <div class="card-header" id="heading-{{ $recibido->id }}">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        @if($recibido->revisado == 'NO')
                        <a class="btn btn-danger" href="" data-target="#modal-recibido-{{$recibido->id}}" data-toggle="modal">
                            <i class="fas fa-shipping-fast"></i> Recibir documento
                        </a>
                        @else
                            <b class="text-success"><i class="fas fa-shipping-fast"></i> recepcionado.
                                <b><i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($recibido->rfecha)) }}
                                <b><i class="fas fa-clock"></i></b> {{ $recibido->rhora }}
                            </b>
                        @endif
                        <!-- tenemos que verificar si fue enviado o tiene otro envio -->
                        @if(!fueenviado($recibido->id,$recibido->document_id))
                            @if($recibido->revisado == 'SI')
                                @if ($recibido->documento->finalizado == 'NO')
                                    <a href="" class="btn btn-primary" data-target="#modal-enviar-{{$recibido->id}}" data-toggle="modal">
                                        <i class="fas fa-share-square"></i> enviar
                                    </a>
                                @endif
                            @endif
                                
                            @if($recibido->revisado == 'SI')
                                @if ($recibido->documento->finalizado == 'NO')
                                    <a href="" class="btn btn-warning" data-target="#modal-finalizar-{{$recibido->id}}" data-toggle="modal">
                                        <i class="fas fa-stamp"></i> finalizar
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>
                    <div class="col-sm-12">
                        {!! Form::open(['route'=>['tdocumentario.rdocumentos.recepcion',$recibido->id],'method'=>'get']) !!}
                        <div class="modal fade" id="modal-recibido-{{$recibido->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">   
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar Recepcion</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p>desea marcar este documento como recepcionado</p> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fas fa-power-off"></i> Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-concierge-bell"></i> Aceptar
                                    </button>
                                </div>
                              </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <!-- boton de enviar -->

                        {!! Form::open(['route'=>['tdocumentario.rdocumentos.update',$recibido->id],'method'=>'put']) !!}
                        <div class="modal fade" id="modal-enviar-{{$recibido->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar envio <i class="far fa-paper-plane"></i></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div> 
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            {!! Form::label('folios', 'Folios', [null]) !!}
                                            {!! Form::number('folios', 0, ['class'=>'form-control']) !!}
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                            {!! Form::label('user_id', 'Usuario', [null]) !!}
                                            {!! Form::select('user_id', $usuarios, null, ['class'=>'form-control selectpicker','data-live-search'=>'true', 'data-size'=>5]) !!}
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    {!! Form::label(null, 'Observacion', [null]) !!}
                                    {!! Form::textarea('observacion', null, ['class'=>'form-control','rows'=>3]) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fas fa-power-off"></i> Cerrar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-share"></i> Enviar
                                </button>
                            </div>
                            </div>
                        </div>  
                        </div>
                        {!! Form::close() !!}
                        <!-- BOTON FINALIZAR -->
                        {!! Form::open(['route'=>['tdocumentario.rdocumentos.edit',$recibido->id],'method'=>'get']) !!}    
                        <div class="modal fade" id="modal-finalizar-{{$recibido->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar Finalizacion del Documento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <p>esta opcion es irreversible, esta seguro que desea dar final al tramite de este documento...</p>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            {!! Form::label('folios', 'Folios', [null]) !!}
                                            {!! Form::number('folios', 0, ['class'=>'form-control','required']) !!}
                                        </div>
                                    </div>
                   
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                {!! Form::label('observacion', 'Observacion', [null]) !!}
                                                {!! Form::textarea('observacion', '-', ['class'=>'form-control','rows'=>'3','required']) !!}
                                            </div>
                                        </div>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fas fa-power-off"></i> Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-stamp"></i> Finalizar
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <div class="col-sm-12 col-md-1">
                        <b><i class="fas fa-hashtag"></i></b> {{ ceros($recibido->documento->numero) }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b><i class="fas fa-user"></i> De:</b> {{ $recibido->envia->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $recibido->envia->email }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b>Enviado: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($recibido->fecha)) }}
                        <b><i class="fas fa-clock"></i></b> {{ $recibido->hora }}
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <b><i class="fas fa-copy"></i> Observacion:</b> {{ $recibido->observacion }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $recibido->folios }}
                    </div>
                    <div class="col-sm-12 col-md-2" style="text-align:right">
                        <button class="btn btn-link bg-info" data-toggle="collapse" data-target="#collapse-{{ $recibido->id }}" aria-expanded="true" aria-controls="collapse-{{ $recibido->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="collapse-{{ $recibido->id }}" class="collapse" aria-labelledby="heading-{{ $recibido->id }}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row text-info">
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-user"></i></b> {{ $recibido->documento->cliente->apellido }} {{ $recibido->documento->cliente->nombre }}
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $recibido->documento->cliente->email }}
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <b>Recibido: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($recibido->documento->fecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $recibido->documento->hora }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $recibido->documento->folios }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="far fa-file"></i> Asunto:</b> {{ $recibido->documento->asunto }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-search"></i> Observación:</b> {{ $recibido->documento->observacion }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
</div>





{{-- 
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
@endforeach   --}}
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