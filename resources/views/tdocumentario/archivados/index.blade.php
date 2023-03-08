@extends('adminlte::page')
@section('title', 'Trámite Documentario')
@section('content_header')
    <h1><b>Sistema de Trámite Documentario</b></h1>
    <span class="text-warning font-italic">
        <i class="fas fa-check-double"></i> Documentos archivados
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
<div id="accordion">
    @foreach ($archivados as $key => $archivado)
        <div class="card">
            <div class="card-header" id="heading-{{ $archivado->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        @if($archivado->revisado == 'NO')
                            <b class="text-danger"><i class="fas fa-shipping-fast"></i> sin recepcion.</b> 
                        @else
                            <b class="text-success"><i class="fas fa-shipping-fast"></i> recepcionado.
                            <b><i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($archivado->rfecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $archivado->rhora }}
                            </b>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <b><i class="fas fa-hashtag"></i></b> {{ ceros($archivado->documento->numero) }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b><i class="fas fa-user"></i> Para:</b> {{ $archivado->receptor->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $archivado->receptor->email }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b>Enviado: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($archivado->fecha)) }}
                        <b><i class="fas fa-clock"></i></b> {{ $archivado->hora }}
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <b><i class="fas fa-copy"></i> Observacion:</b> {{ $archivado->observacion }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $archivado->folios }}
                    </div>
                    <div class="col-sm-12 col-md-2" style="text-align:right">
                        <button class="btn btn-link bg-info" data-toggle="collapse" data-target="#collapse-{{ $archivado->id }}" aria-expanded="true" aria-controls="collapse-{{ $archivado->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="collapse-{{ $archivado->id }}" class="collapse" aria-labelledby="heading-{{ $archivado->id }}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row text-info">
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-user"></i></b> {{ $archivado->documento->cliente->apellido }} {{ $archivado->documento->cliente->nombre }}
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $archivado->documento->cliente->email }}
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <b>Recibido: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($archivado->documento->fecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $archivado->documento->hora }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $archivado->documento->folios }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="far fa-file"></i> Asunto:</b> {{ $archivado->documento->asunto }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-search"></i> Observación:</b> {{ $archivado->documento->observacion }}
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