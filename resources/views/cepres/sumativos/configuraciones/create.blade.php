@extends('adminlte::page')
@section('title', 'Sumativo Crear')
@section('content_header')
    <h1>Registrar Nuevo Sumativo Cepre</h1>
@stop

@section('content')
{!! Form::open(['id'=>'frm_datos','name'=>'frm_datos','route'=>'cepres.sumativos.configuraciones.store','method'=>'POST','autocomplete'=>'off']) !!}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-notes-medical"></i> Datos del Sumativo.</h4>
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
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="fecha">Fecha</label>
                            {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- otra linea --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class='form-group'>
                            <label for="cepre_id">Perido Cepre</label>
                            {!! Form::select('cepre_id', $cepres,null, ['class'=>'form-control selectpicker']) !!}
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
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('cepres.sumativos.configuraciones.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
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
@stop