@extends('adminlte::page')
@section('title', 'Servicios Editar')
@section('content_header')
    <h1>Editar Servicio: <strong>{{$servicio->nombre}}</strong></h1>
@stop
@section('content')
{!!Form::model($servicio,['method'=>'PATCH','route'=>['ventas.servicios.update',$servicio->idServicio],'id'=>'frm_datos','name'=>'frm_datos'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">       
        <div class="form-group">
            <label for="nombre">Nombre del Servicio</label>
            <input type="text" name="nombre" class="form-control" value="{{$servicio->nombre}}" required placeholder="servicio...">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" class="form-control" value="{{$servicio->precio}}" required placeholder="precio...">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
        <div class="form-group">
            <label for="dias">Días de Tramite</label>
            <input type="number" name="dias" class="form-control" value="{{$servicio->dias}}" required placeholder="Dias de trámite...">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <button class="btn btn-primary" type="submit" id='bt_guardar' name='bt_guardar'>
                <i class="fas fa-save"></i> Guardar
            </button>
{!!Form::close()!!}  
            <a href="{{route('ventas.servicios.index')}}" class="btn btn-danger" type="reset">
                <i class="fas fa-backward"></i> Salir
            </a>
        </div>      
	</div>
</div>
@stop
@section('js')
<script>
$('#frm_datos').submit(function(event){
    $('#bt_guardar').attr('disabled',true);
});
</script>
@stop