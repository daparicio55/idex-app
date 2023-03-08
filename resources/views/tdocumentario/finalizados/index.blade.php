@extends('adminlte::page')
@section('title', 'Documentos Finalizados')

@section('content_header')
    <h1><b>Sistema de Trámite Documentario</b></h1>
    <span class="text-success font-italic">
        <i class="fas fa-stamp"></i> bandeja de documentos finalizados
    </span>
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

<!-- ACORDEON -->

<div id="accordion">
    @foreach ($finalizados as $key => $finalizado)
        <div class="card">
            <div class="card-header" id="heading-{{ $finalizado->id }}">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        @if($finalizado->revisado == 'NO')
                        <a class="btn btn-warning" href="" data-target="#modal-recibido-{{$finalizado->id}}" data-toggle="modal">
                            <i class="fas fa-check-double"></i> Archivar documento
                        </a>
                        @else
                            <b class="text-warning"><i class="fas fa-check-double"></i> archivado.
                                <b><i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($finalizado->rfecha)) }}
                                <b><i class="fas fa-clock"></i></b> {{ $finalizado->rhora }}
                            </b>
                        @endif
                    </div>
                    <div class="col-sm-12">
                        {!! Form::open(['route'=>['tdocumentario.fdocumentos.recepcion',$finalizado->id],'method'=>'get']) !!}
                        <div class="modal fade" id="modal-recibido-{{$finalizado->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">   
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


                    </div>
                    <div class="col-sm-12 col-md-1">
                        <b><i class="fas fa-hashtag"></i></b> {{ ceros($finalizado->documento->numero) }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b><i class="fas fa-user"></i> De:</b> {{ $finalizado->envia->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $finalizado->envia->email }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b>Enviado: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($finalizado->fecha)) }}
                        <b><i class="fas fa-clock"></i></b> {{ $finalizado->hora }}
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <b><i class="fas fa-copy"></i> Observacion:</b> {{ $finalizado->observacion }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $finalizado->folios }}
                    </div>
                    <div class="col-sm-12 col-md-2" style="text-align:right">
                        <button class="btn btn-link bg-info" data-toggle="collapse" data-target="#collapse-{{ $finalizado->id }}" aria-expanded="true" aria-controls="collapse-{{ $finalizado->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="collapse-{{ $finalizado->id }}" class="collapse" aria-labelledby="heading-{{ $finalizado->id }}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row text-info">
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-user"></i></b> {{ $finalizado->documento->cliente->apellido }} {{ $finalizado->documento->cliente->nombre }}
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $finalizado->documento->cliente->email }}
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <b>Recibido: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($finalizado->documento->fecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $finalizado->documento->hora }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $finalizado->documento->folios }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="far fa-file"></i> Asunto:</b> {{ $finalizado->documento->asunto }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-search"></i> Observación:</b> {{ $finalizado->documento->observacion }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
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
	</script>
@stop