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
{!! Form::model($request,['route'=>'tdocumentario.rdocumentos.index','method'=>'get','role'=>'search']) !!}
<x-adminlte-card title="Buscar documentos" theme="info" icon="fas fa-lg fa-search" collapsible>
    <div class="row">
        {!! Form::hidden('buscar', 'si', [null]) !!}
        <div class="col-sm-12 col-md-2">
            {!! Form::label('dniRuc', 'Dni/Ruc', [null]) !!}
            {!! Form::text('dniRuc', null, ['class'=>'form-control']) !!}
        </div>
        <div class="col-sm-12 col-md-3">
            {!! Form::label('numero', 'N. Expediente', [null]) !!}
            {!! Form::text('numero', null, ['class'=>'form-control']) !!}
        </div>
        <div class="col-sm-12 col-md-3">
            {!! Form::label('asunto', 'Asunto', [null]) !!}
            {!! Form::text('asunto', null, ['class'=>'form-control']) !!}
        </div>
        <div class="col-sm-12 col-md-2">
            {!! Form::label('finicio','F. Inicio', [null]) !!}
            {!! Form::date('finicio', null, ['class'=>'form-control','required',]) !!}
        </div>
        <div class="col-sm-12 col-md-2">
            {!! Form::label('ffin','F. Fin', [null]) !!}
            {!! Form::date('ffin', null, ['class'=>'form-control','required']) !!}
        </div>
        <div class="col-sm-12 mt-2">
            <x-adminlte-select2 name="oficinas" label="Oficina o usuario" label-class="text-dark"
                igroup-size="md" data-placeholder="Select an option...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-building"></i>
                    </div>
                </x-slot>
                <option value="0">Seleccione oficina ... </option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @isset($request->oficinas) @if($request->oficinas == $user->id) selected @endif @endisset>{{ $user->name }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button class="btn btn-info" type="submit">
            <i class="fab fa-searchengin"></i>   Buscar
        </button>
        <a href="{{ route('tdocumentario.rdocumentos.index') }}" class="btn btn-warning">
           <i class="fas fa-broom"></i> Limpiar
        </a>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}



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
                        <div class="modal fade" id="modal-recibido-{{ $recibido->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">   
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
<div class="row">
    <div class="col-sm-12">
        @if(!isset($request->buscar))
            <tr>
                <td colspan="7">{{ $recibidos->links() }}</td>
            </tr>
        @endif
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
	</script>
@stop