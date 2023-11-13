@extends('adminlte::page')

@section('title', 'Registrar Documento')
@section('content_header')
    <h1>Editar Documento</h1>
@stop
@section('content')
{!! Form::model($documento, ['route'=>['tdocumentario.mesapartes.actualizar',$documento->id],'method'=>'put','id'=>'frm_datos']) !!}
    <div class="row">
        <div class="col-sm-12 mt-2">
            <x-adminlte-card title="Datos de Contacto - DNI: {{ $documento->cliente->dniRuc }}" theme="info" icon="fas fa-lg fa-user" collapsible>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="apellido">Apellidos</label>
                            {!! Form::text('apellido', $documento->cliente->apellido, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombres</label>
                            {!! Form::text('nombre', $documento->cliente->nombre, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono">Tel. General</label>
                            {!! Form::text('telefono', $documento->cliente->telefono, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. Notificaciones</label>
                            {!! Form::text('telefono2', $documento->cliente->telefono2, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila --}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="email">E. Mail</label>
                            {!! Form::text('email', $documento->cliente->email, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila de direccion--}}
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', $documento->cliente->direccion, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>                  
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-sm-12 mt-2">
            <x-adminlte-card title="Datos Documento # {{ $documento->numero }}" theme="info" icon="fas fa-lg fa-file-invoice" collapsible>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('tramite', 'Servicios de Trámite Documentario', ['class'=>'mt-2']) !!}
                        {!! Form::select('tramite', $stramites, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>10]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label('tdocument_id', 'Tipo de Documento', [null]) !!}
                        {!! Form::select('tdocument_id', $tdocuments, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        {!! Form::label('dnumero', 'N° Documento', [null]) !!}
                        {!! Form::text('dnumero', null, ['class'=>'form-control','required']) !!}
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                        {!! Form::label('folios', 'Folios', [null]) !!}
                        {!! Form::number('folios', null, ['class'=>'form-control','required']) !!}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label('fecha', 'Fecha', [null]) !!}
                        {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        {!! Form::label('nboleta', 'N° Boleta', [null]) !!}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <span class="px-1">Sin boleta</span><input type="checkbox" aria-label="Checkbox for following text input" id="chkboleta">
                              </div>
                            </div>
                            <input type="text" id="nboleta" name="nboleta" class="form-control" aria-label="Text input with checkbox">
                        </div>
                        {{-- {!! Form::text('nboleta', null, ['class'=>'form-control','required']) !!} --}}
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {!! Form::label('asunto', 'Asunto', [null]) !!}
                        {!! Form::textarea('asunto', null, ['class'=>'form-control','rows'=>3]) !!}
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {!! Form::label('observacion', 'Observacion', [null]) !!}
                        {!! Form::textarea('observacion', null, ['class'=>'form-control','rows'=>3]) !!}
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
            <div class="form-group">
                <button class="btn btn-primary btn-lg" type="submit" id='bt_guardar' name='bt_guardar'>
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                </button>
    {!! Form::close() !!}            
                <a class="btn btn-danger btn-lg" href="{{route('tdocumentario.mesapartes.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop