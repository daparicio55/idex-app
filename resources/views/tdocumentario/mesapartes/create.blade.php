@extends('adminlte::page')
@section('title', 'Registrar Documento')
@section('content_header')
    <h1><i class="fas fa-address-book"></i> Registrar Nuevo Trámite</h1>
@stop

@section('content')
{!! Form::open(['route'=>'tdocumentario.mesapartes.create','method'=>'GET','autocomplete'=>'on','role'=>'search']) !!}
<div class='form-group'>
    <label for="searchText" class="d-block">DNI/RUC</label>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese DNI o RUC a buscar ..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
        </span>
    </div>
</div>
<div class="form-group">
    <label for="">Nombre/Razon Social </label>
    <div class="input-group">
        {{-- <input type="text" class="form-control" name="searchText" placeholder="Ingrese DNI o RUC a buscar ..." @if(isset($searchText)) value="{{$searchText}}" @endif > --}}
        @if(isset($cliente->idCliente))
            {!! Form::select('idCliente', $clientes, $cliente->idCliente, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'7']) !!}    
        @else
        {!! Form::select('idCliente', $clientes, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'7']) !!}    
        @endif       
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
        </span>
    </div>
</div>
{!! Form::close() !!}



{{-- fila de datos personales --}}
@if (isset($cliente))
    {!! Form::open(['route'=>'tdocumentario.mesapartes.store','method'=>'post','id'=>'frm_datos']) !!}
    {!! Form::hidden('idCliente', $cliente->idCliente, [null]) !!}
    {!! Form::hidden('dniRuc', $searchText, [null]) !!}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card sm-12">
                <div class="card-header">
                    <h4><i class="fa fa-user" aria-hidden="true"></i> Datos de Contacto.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class='form-group'>
                                <label for="apellido">Apellidos</label>
                                {!! Form::text('apellido', $cliente->apellido, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class='form-group'>
                                <label for="nombre">Nombres</label>
                                {!! Form::text('nombre', $cliente->nombre, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class='form-group'>
                                <label for="telefono">Tel. General</label>
                                {!! Form::text('telefono', $cliente->telefono, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class='form-group'>
                                <label for="telefono2">Tel. Notificaciones</label>
                                {!! Form::text('telefono2', $cliente->telefono2, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        {{-- siguiente fila --}}
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class='form-group'>
                                <label for="email">E. Mail</label>
                                {!! Form::text('email', $cliente->email, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        {{-- siguiente fila de direccion--}}
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class='form-group'>
                                <label for="direccion">Dirección</label>
                                {!! Form::text('direccion', $cliente->direccion, ['class'=>'form-control','required']) !!}
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- otra fila --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-user" aria-hidden="true"></i> Datos Documento.</h4>
            </div>
            <div class="card-body">
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
            </div>
        </div>
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
@endif


@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
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
    document.getElementById('chkboleta').addEventListener('change',function(){
        let nboleta = document.getElementById('nboleta');
        if(this.checked == true){
            console.log(this.checked);
            nboleta.value = "";
            nboleta.setAttribute('readonly',true);
        }else{
            console.log(this.checked);
            nboleta.value = "";
            nboleta.removeAttribute('readonly');
        }
    });
</script>
@stop
