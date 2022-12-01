@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1>Registrar Nuevo cliente</h1>
@stop
@section('content')
{!!Form::model($cliente,['method'=>'PATCH','route'=>['ventas.clientes.update',$cliente->idCliente],'name'=>'frm_datos', 'id'=>'frm_datos'])!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="dniRuc">DNI/RUC</label>
            <input type="text" name="dniRuc" class="form-control" value="{{$cliente->dniRuc}}" placeholder="DNI o RUC...">
        </div>
        <div class="form-group">
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" class="form-control" value="{{$cliente->nombre}}" placeholder="Nombres...">
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" class="form-control" value="{{$cliente->apellido}}" placeholder="Apellidos...">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}" placeholder="Dirección...">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="email" name="email" class="form-control" placeholder="Email..." value="{{$cliente->email}}">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono" class="form-control" value="{{$cliente->telefono}}" placeholder="Telefono...">
        </div>
        <div class="form-group">
            <label for="telefono2">Teléfono WhatsApp</label>
            <input type="tel" name="telefono2" class="form-control" value="{{$cliente->telefono2}}" placeholder="Telefono WhatsApp...">
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