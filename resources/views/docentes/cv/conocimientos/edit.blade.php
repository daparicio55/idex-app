@extends('adminlte::page')
@section('title', 'Editar Conocimientos')
@section('content_header')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Editar Conocimientos</h3>
	</div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p>
            Valora tus conocimientos en las diferentes areas, recuerda que la valoracion es de 0 a 100, donde 0 es que desconoces del tema y 100 es que lo dominas a la perfección.
        </p>
    </div>
</div>
@stop
@section('content')
{!! Form::model($personale, ['route'=>['docentes.cv.conocimientos.update',$personale->conocimientos->id],'method'=>'put']) !!}
{!! Form::hidden('cv_personale_id', $personale->id, [null]) !!}
<div class="row">
    <div class="col-sm-12 col-md-3">
        <label for="">Inglés</label>
        <x-adminlte-input-slider name="ingles" min=0 max=100 step=1 value="{{ $personale->conocimientos->ingles }}" color="blue"/>
    </div>
    <div class="col-sm-12 col-md-1">
        &nbsp;
    </div>
    <div class="col-sm-12 col-md-3">
        <label for="">Ofimática</label>
        <x-adminlte-input-slider name="ofimatica" min=0 max=100 step=1 value="{{ $personale->conocimientos->ofimatica }}" color="orange"/>
    </div>
    <div class="col-sm-12 col-md-1">
        &nbsp;
    </div>
    <div class="col-sm-12 col-md-3">
        <label for="">TIC's</label>
        <x-adminlte-input-slider name="tics" min=0 max=100 step=1 value="{{ $personale->conocimientos->tics }}" color="green"/>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</div>
{!! Form::close() !!}
@stop