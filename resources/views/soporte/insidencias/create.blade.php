@extends('adminlte::page')
@section('title', 'Repocitorio | Inicio')
@section('content_header')
    <h1><i class="fas fa-tools"></i> Registrar Nueva Insidencia</h1>
@stop
@section('content')
@include('soporte.insidencias.searchdni')

{!! Form::open(['id'=>'frm_datos','name'=>'frm_datos','route'=>'soporte.insidencias.store','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('dniRuc', $cliente->dniRuc, [null]) !!}
{!! Form::hidden('idCliente', $cliente->idCliente, [null]) !!}
{{-- datos personales --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-user" aria-hidden="true"></i> Datos Personales.</h4>
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
                            <label for="telefono">Tel. Llamadas</label>
                            {!! Form::text('telefono', $cliente->telefono, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. WhatsApp</label>
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
                    <div class="col-lg-8 col-md-8-sm-8 col-xs-12">
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

{{-- lista de equipos --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-laptop"></i> Equipos Registrados.
                    <button name="btn_nuevo" id="btn_nuevo" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Nuevo
                    </button>
                </h4> 
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@stop
@section('js')
    <script>
        $('#btn_nuevo').click(function(){
            window.open = ("https://www.google.com.pe","ventana1","width=120,height=300,scrollbars=NO");
        });
        $(document).ready(function(){
            setTimeout(() => {
            $("#info").hide();
        }, 9000);
        });
        $(document).ready(function(){
            setTimeout(() => {
            $("#error").hide();
        }, 9000);
        });
    </script>
@stop