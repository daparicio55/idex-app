@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1>Registrar Nuevo cliente</h1>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('ventas.clientes.buscar')
    </div>
</div>
{!!Form::open(array('id'=>'frm_datos','name'=>'frm_datos','url'=>'ventas/clientes','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="dniRuc">DNI/RUC</label>
            <input type="text" name="dniRuc" class="form-control" value="{{$dnii}}" placeholder="DNI o RUC...">
        </div>
        <div class="form-group">
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" class="form-control" value="{{$nombress}}" placeholder="Nombres...">
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" class="form-control" value="{{$apellidoss}}" placeholder="Apellidos...">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{$direccionn}}" placeholder="Dirección...">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="email" name="email" class="form-control" placeholder="Email..." value="sincorreo@gmail.com">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono" class="form-control" placeholder="Telefono...">
        </div>
        <div class="form-group">
            <label for="telefono2">Teléfono WhatsApp</label>
            <input type="tel" name="telefono2" class="form-control" placeholder="Telefono WhatsApp...">
        </div>
	</div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <button class="btn btn-primary" type="submit" id="bt_guardar">
                <i class="fas fa-save"></i> Guardar
            </button>
{!!Form::close()!!}  
            <a href="{{route('ventas.clientes.index')}}" class="btn btn-danger" type="reset">
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