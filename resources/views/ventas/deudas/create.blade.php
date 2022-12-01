@extends('adminlte::page')
@section('title', 'Deudas Nuevo')
@section('content_header')
	<h1>Registro Nueva Deuda</h1>
@stop

@section('content')
@include('ventas.deudas.buscardni')

{!!Form::open(array('id'=>'frm_datos','name'=>'frm_datos','url'=>'ventas/deudas','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<input type="hidden" name="idCliente" id="idCliente" value="{{$idCliente}}">
<input type="hidden" name="dniRuc" id="dniRuc" value="{{$dni}}">
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class='form-group'>
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" value="{{$apellido}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class='form-group'>
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" value="{{$nombre}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class='form-group'>
            <label for="telefono">Telefono</label>
            <input type="apellido" name="telefono" value="{{$telefono}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class='form-group'>
            <label for="email">Correo</label>
            <input type="text" name="email" value="{{$correo}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class='form-group'>
            <label for="apellido">Direccion</label>
            <input type="text" name="direccion" value="{{$direccion}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class='form-group'>
            <label for="observacion">Observacion</label>
            <textarea name="observacion" id="observacion" rows="3" class="form-control"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
        <div class="form-group">
              <label>Productos Servicios | Costo | Fecha</label>
              <select name="pidservicio" class="form-control selectpicker" id="pidservicio" data-live-search="true" data-size="5">
                    @foreach($servicios as $serv)
                    <option value="{{$serv->idServicio}}_{{$serv->nombre}}_{{$serv->precio}}">
                          {{$serv->nombre}}
                    </option>
                    @endforeach
              </select>
        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="pprecio" id ="pprecio" class="form-control" placeholder="Precio">
        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class='form-group'>
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" required class="form-control" value="{{date('Y-m-d')}}">
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row" id="control">
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <label>Numero de Cuotas</label>
                <input type="number" name="cuotas" id="cuotas" required class="form-control" step="1" value="1">
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <button type="button" id="bt_add" class="btn btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                    <button type="button" id="bt_limpiar" class="btn btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Limpiar</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color:#A9D0F5">
                            <th style="width: 10%">Num.</th>
                            <th>Servicio</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 10%">Pago</th>
                      </thead>
                      <tfoot>
                            <th colspan="3" class="text-right">TOTAL</th>
                            <th colspan="2" class="text-center"><h4 id="total">S/ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                      </tfoot>
                      <tbody>
    
                      </tbody>
                </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center" id="guardar">
        <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" id='bt_guardar' name='bt_guardar'>
                <i class="far fa-save"></i> Guardar
            </button>
{!!Form::close()!!}
            <a class="btn btn-danger btn-lg" href="{{route('ventas.deudas.index')}}">
                <i class="fas fa-backward"></i> Cancelar
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
$(document).ready(function()
      {
            $('#bt_add').click(function()
            {
                agregar();
            });
            $("#pidservicio").change(function()
            {
                mostrarServicio();
            });
            $("#bt_limpiar").click(function()
            {
                $("#detalles tbody tr").remove();
                $('#total').html("S/. 0.00");
                $('#guardar').hide();
            });
      });
      $('#guardar').hide();
      $('#control').hide();
      function agregar()
      {
        $("#detalles tbody tr").remove();
        var ffecha;
        var pMensual;
        var orden;
        datosArticulo=document.getElementById('pidservicio').value.split('_');
        totalPago=$('#pprecio').val();
        cuotas=$('#cuotas').val();
        pagoMensual=totalPago/cuotas;
        fechaa=$('#fecha').val();
        for (var cont = 1; cont <= cuotas; cont++) 
        {
            var fila='<tr><td><input type="hidden" name="orden[]" value="'+cont+'">'+cont+'</td><td>'+datosArticulo[1]+'</td><td> <input type="date" name="ffecha[]" id="ffecha" required class="form-control" value="{{date('Y-m-d')}}"></td><td>Deuda</td><td><input class="form-control" type="number" name="pMensual[]" value="'+pagoMensual+'"></td></tr>'
            $('#detalles').append(fila);
        }
        $('#total').html("S/. "+datosArticulo[2]);
        $('#guardar').show();
      }
      function mostrarServicio()
      {
        datosArticulo=document.getElementById('pidservicio').value.split('_');
        $("#pprecio").val(datosArticulo[2]);
        $('#control').show();
      }
</script>
@stop