@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1>Registrar Nuevo Servicio</h1>
@stop
@section('content')
{!!Form::open(array('id'=>'frm_datos','name'=>'frm_datos','url'=>'ventas/servicios','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">       
        <div class="form-group">
            <label for="nombre">Nombre del Servicio</label>
            <input type="text" name="nombre" class="form-control" required placeholder="servicio...">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" class="form-control" required placeholder="precio...">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
        <div class="form-group">
            <label for="dias">Días de Tramite</label>
            <input type="number" name="dias" class="form-control" required placeholder="Dias de trámite...">
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