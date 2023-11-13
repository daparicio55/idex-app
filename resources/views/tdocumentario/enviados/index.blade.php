@extends('adminlte::page')
@section('title', 'Trámite Documentario')

@section('content_header')
    <h1><b>Sistema de Trámite Documentario</b></h1>
    <span class="text-black font-italic">
        <i class="fas fa-file-import"></i> Documentos enviados
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

{!! Form::model($request,['route'=>'tdocumentario.edocumentos.index','method'=>'get','role'=>'search']) !!}
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
        <a href="{{ route('tdocumentario.edocumentos.index') }}" class="btn btn-warning">
           <i class="fas fa-broom"></i> Limpiar
        </a>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}

<div id="accordion">
    @foreach ($enviados as $key => $enviado)
        <div class="card">
            <div class="card-header" id="heading-{{ $enviado->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        @if($enviado->revisado == 'NO')
                            <b class="text-danger"><i class="fas fa-shipping-fast"></i> sin recepcion.</b> 
                        @else
                            <b class="text-success"><i class="fas fa-shipping-fast"></i> recepcionado.
                            <b><i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($enviado->rfecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $enviado->rhora }}
                            </b>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <b><i class="fas fa-hashtag"></i></b> {{ ceros($enviado->documento->numero) }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b><i class="fas fa-user"></i> Para:</b> {{ $enviado->receptor->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $enviado->receptor->email }}
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <b>Enviado: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($enviado->fecha)) }}
                        <b><i class="fas fa-clock"></i></b> {{ $enviado->hora }}
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <b><i class="fas fa-copy"></i> Observacion:</b> {{ $enviado->observacion }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <b><i class="fas fa-file-medical"></i> Folios Agregados:</b> {{ $enviado->folios }} <b> Total: </b> {{ totalfolios($enviado->id) }} 
                    </div>
                    <div class="col-sm-12 col-md-2" style="text-align:right">
                        <button class="btn btn-link bg-info" data-toggle="collapse" data-target="#collapse-{{ $enviado->id }}" aria-expanded="true" aria-controls="collapse-{{ $enviado->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="collapse-{{ $enviado->id }}" class="collapse" aria-labelledby="heading-{{ $enviado->id }}" data-parent="#accordion">
                <div class="card-body">
                    <div class="row text-info">
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-user"></i></b> {{ $enviado->documento->cliente->apellido }} {{ $enviado->documento->cliente->nombre }}
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <b><i class="fas fa-envelope-open-text"></i> Correo:</b> {{ $enviado->documento->cliente->email }}
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <b>Recibido: <i class="fas fa-calendar-check"></i></b> {{ date('d-m-Y',strtotime($enviado->documento->fecha)) }}
                            <b><i class="fas fa-clock"></i></b> {{ $enviado->documento->hora }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-file-medical"></i> Folios:</b> {{ $enviado->documento->folios }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="far fa-file"></i> Asunto:</b> {{ $enviado->documento->asunto }}
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <b><i class="fas fa-search"></i> Observación:</b> {{ $enviado->documento->observacion }}
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
                <td colspan="7">{{ $enviados->links() }}</td>
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