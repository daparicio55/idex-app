@extends('adminlte::page')

@section('title', 'Unidad Didactica')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nueva Unidad Didactica</h1>
@stop
@section('content')

{!! Form::open(['id'=>'frm','method'=>'post','route'=>'sacademica.udidacticas.store','autocomplete'=>'off']) !!}
{!! Form::hidden('mformativo_id', $modulo->id, [null]) !!}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! Form::label('nombre', 'Nombre de la Unidad Didactica', [null]) !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('horas', 'Horas', [null]) !!}
                    {!! Form::number('horas', null, ['class'=>'form-control','step'=>0.1,'required']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('creditos', 'Creditos', [null]) !!}
                    {!! Form::number('creditos', null, ['class'=>'form-control','step'=>0.1,'required']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('ciclo', 'Ciclo', [null]) !!}
                    {!! Form::text('ciclo', null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('moodle', 'Cod Moodle', [null]) !!}
                    {!! Form::text('moodle', null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('tipo', 'Tipo', [null]) !!}
                    {!! Form::select('tipo', $tUnidades, null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
        <a class="btn btn-danger" href="{{ url('sacademica/mformativos/'.$modulo->id) }}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    </script>
@stop