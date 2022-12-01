@extends('adminlte::page')
@section('title', 'Admision Editar')
@section('content_header')
    <h1>Editar Proceso de Admisión</h1>
@stop

@section('content')
{!! Form::open(['route'=>'admisiones.configuraciones.store','method'=>'post','id'=>'frm_datos','autocomplete'=>'off']) !!}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-book-reader"></i> Datos del Proceso de Admisión.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombre</label>
                            {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                        <label for="periodo">Periodo</label>  
                        {!! Form::text('periodo', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="preguntas">Preguntas</label>
                            {!! Form::number('preguntas', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="puntas">Cal. Positiva</label>
                            {!! Form::number('puntos', null, ['class'=>'form-control','required','step'=>'0.01']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="encontra">Cal. Negativa</label>
                            {!! Form::number('encontra', null, ['class'=>'form-control','required','step'=>'0.01']) !!}
                        </div>
                    </div>
                    {{-- otra linea --}}
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="fecha">Exo. Fecha</label>
                            {!! Form::date('efecha', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="">Exo. Hora</label>
                            {!! Form::time('ehora', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="fecha">Or. Fecha</label>
                            {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="">Or. Hora</label>
                            {!! Form::time('hora', null, ['class'=>'form-control','required']) !!}
                        </div>
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
                <i class="far fa-save"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('admisiones.configuraciones.index')}}"><i class="fas fa-undo-alt"></i> Regresar</a>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
</script>
@stops