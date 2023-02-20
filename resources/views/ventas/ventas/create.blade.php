@extends('adminlte::page')
@section('title', 'Venta Nueva')

@section('content_header')
      <h3>Nueva Venta</h3>
@stop

@section('content')

	@include('ventas.ventas.buscardni')

<datalist id="listamodelos">
      <option value="Enfermería Técnica - Cepre">
      <option value="Mecatrónica Automotriz - Cepre">
      <option value="Electrónica Industrial - Cepre">
      <option value="Arq. de Pla. y Servicios de Tecnologías de la Información - Cepre">
      <option value="Producción Agropecuaria - Cepre">
      <option value="Asistencia Administrativa - Cepre">
      <option value="Laboratorio Clínico y Anatomía Patológica - Cepre">

      <option value="Enfermería Técnica - Regular">
      <option value="Mecatrónica Automotriz - Regular">
      <option value="Electrónica Industrial - Regular">
      <option value="Arq. de Pla. y Servicios de Tecnologías de la Información - Regular">
      <option value="Producción Agropecuaria - Regular">
      <option value="Asistencia Administrativa - Regular">
      <option value="Laboratorio Clínico y Anatomía Patológica - Regular">

      <option value="Enfermería Técnica - Exonerado">
      <option value="Mecatrónica Automotriz - Exonerado">
      <option value="Electrónica Industrial - Exonerado">
      <option value="Arq. de Pla. y Servicios de Tecnologías de la Información - Exonerado">
      <option value="Producción Agropecuaria - Exonerado">
      <option value="Asistencia Administrativa - Exonerado">
      <option value="Laboratorio Clínico y Anatomía Patológica - Exonerado">

</datalist>


{!!Form::open(array('id'=>'frm_datos','name'=>'frm_datos','url'=>'ventas/ventas','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<input type="hidden" name="idCliente" id="idCliente" value="{{$idCliente}}">
<input type="hidden" name="dniRuc" id="dniRuc" value="{{$dni}}">
{{-- 71815779 --}}
@if ($idCliente != 0)
      @if (deuda($idCliente) > 0)
            <div class="alert alert-danger" role="alert">
                  <h5><i class="far fa-sad-cry"></i> El usuario tiene una deuda de: S/  {{ deuda($idCliente) }} <i class="fas fa-skull-crossbones"></i></h5>  
            </div>      
      @endif
@endif

{{-- card para veriticar puestos --}}
@isset($cliente->idCliente)
      @foreach ($cliente->postulaciones as $postulacione)
      @isset($postulacione->estudiante)
      <div class="row">
            <div class="card col-lg-12">
            <div class="card-header bg-success">
                  <i class="fas fa-graduation-cap"></i> {{ $postulacione->carrera->nombreCarrera }}
            </div>
            <div class="card-body">
                  <table class="table table-striped">
                        <thead>
                        <th>Ciclo</th>
                        <th>Nota</th>
                        <th>Puesto</th>
                        <th>Periodo</th>
                        <th>Nota</th>
                        <th>Puesto</th>
                        <th>Periodo</th>
                        <th>Nota</th>
                        <th>Puesto</th>
                        <th>Periodo</th>
                        </thead>
                        <tbody>
                        <tr>
                              <td>Ciclo I</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"I") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor
                        </tr>
                        <tr>
                              <td>Ciclo II</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"II") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor
                        </tr>
                        <tr>
                              <td>Ciclo III</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"III") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor                   
                        </tr>
                        <tr>
                              <td>Ciclo IV</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"IV") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor
                        </tr>
                        <tr>
                              <td>Ciclo V</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"V") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor
                        </tr>
                        <tr>
                              <td>Ciclo VI</td>
                              @php
                                    $cont = 0;
                              @endphp
                              @foreach (primeros($postulacione->estudiante->id,"VI") as $item)
                                    <td>{{ $item['nota'] }}</td>
                                    <td>{{ $item['puesto'] }}</td>
                                    <td>{{ $item['periodo'] }}</td>
                                    @php
                                        $cont ++;
                                    @endphp
                              @endforeach
                              @for ($i = $cont; $i < 3; $i++)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              @endfor
                        </tr>
                        </tbody>
                  </table>
            </div>
            </div>
      </div>
      @endisset                
      @endforeach
@endisset

{{-- datos peronsales --}}
<div class="row">
      <div class="card col-lg-12">
            <div class="card-header bg-danger">
                  <i class="fas fa-users"></i> Datos Personales
            </div>
            <div class="card-body">
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
                  <!-- datos de la boleta -->
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class='form-group'>
                              <label>Tipo Comprobante</label>
                              <select name="tipo" class='form-control'>
                                    <option value="Boleta">Boleta</option>
                                    <option value="Factura">Factura</option>
                              </select>
                        </div>
                  </div>
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class='form-group'>
                              <label for="numero">Número Comprobante</label>
                              <input type="number" name="numero" required value="{{$numero->numero + 1}}" class="form-control" placeholder="Num. Comprobante ...">
                        </div>
                  </div>
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class='form-group'>
                              <label for="fecha">Fecha</label>
                              <input type="date" name="fecha" required class="form-control" value="{{date('Y-m-d')}}">
                        </div>
                  </div>
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class='form-group'>
                              <label>Tipo Pago</label>
                              <select name="tipoPago" class='form-control'>
                                    <option value="Contado">Contado</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Credito">Credito</option>
                              </select>
                        </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class='form-group'>
                              <!--<label for="comentario">Observacion</label>
                              <input type="text" name="comentario" id="comentario" required class="form-control"> -->
                              <label for="comentario">Observacion</label>
                              <input type="search" name="comentario" id="comentario" list="listamodelos" required class="form-control">
                        </div>
                  </div>
                  </div>
            </div>
      </div>
</div>
<!-- Detalles de la Venta -->
<div class="card card-primary">
      <div class="card-header">
            <i class="fas fa-shopping-cart"></i> Detalles de la Venta
      </div>
      <div class="card-body">
            <div class="row">
                  <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                        <div class="form-group">
                              <label>Productos y Servicios</label>
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
                        <div class="form-group">
                              <label for="cantidad">Cantidad</label>
                              <input type="number" name="pcantidad" id ="pcantidad" class="form-control" placeholder="cantdidad">
                        </div>
                  </div>
                  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                              <button type="button" id="bt_add" class="btn btn btn-primary">Agregar</button>
                        </div>
                  </div>

                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="table-responsive">
                              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#A9D0F5">
                                          <th></th>
                                          <th style="width: 50px">Cant.</th>
                                          <th style="width: 65%">Descripcion</th>
                                          <th style="text-align: right">Precio</th>
                                          <th style="text-align: right">Importe</th>
                                    </thead>
                                    <tfoot>
                                          <th colspan="3" style="text-align: right"> <h4><strong>TOTAL</strong></h4></th>
                                          <th colspan="2"><h4 id="total" style="text-align: center">S/ 0.00</h4><input type="hidden" name="total_venta" id="total_venta" ></th>
                                    </tfoot>
                                    <tbody>
      
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
            <div class="card-footer">
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center" id='bt_guardar' name='bt_guardar'>
                        <div class="form-group">
                              <button class="btn btn-primary btn-lg" type="submit">Guardar</button>
                              <a class="btn btn-danger btn-lg" href="{{route('ventas.ventas.index')}}">Cancelar</a>
                        </div>
                  </div>
            </div>  
      </div>     
</div>
{!!Form::close()!!}
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
            $('#bt_editar').click(function()
            {
              editar();
            });
            $('#bt_nuevo').click(function(){
              nuevo();
            });
      });
      var cont=0;
      total=0;
      subtotal=[];
      $("#guardar").hide();
      $("#pidCliente").change(mostrar);
      function nuevo()
      {
          window.location.href="/ventas/clientes/create";
      }

      function editar()
      {
          window.location.href="/ventas/clientes/"+$('#idCliente').val()+"/edit";
      }
      function mostrar()
      {
            datos=document.getElementById('pidCliente').value.split('_');
            $("#idCliente").val(datos[0]);
            $("#direccion").val(datos[1]);
      }
      $("#pidservicio").change(mostrarValores);
      function mostrarValores()
      {
            datosArticulo=document.getElementById('pidservicio').value.split('_');
            $("#pprecio").val(datosArticulo[2]);
            $("#pcantidad").val(1);
      }
      function agregar()
      {
            datosServicio=document.getElementById('pidservicio').value.split('_');
            idServicio=datosServicio[0];
            nombre=$("#pidservicio option:selected").text();
            precio=$("#pprecio").val();
            cantidad=$("#pcantidad").val();

            if (pidservicio!="" && precio!="" && cantidad>0)
            {
                  subtotal[cont]=(cantidad*precio);
                  total=total+subtotal[cont];
                  var fila='<tr class="selected" id="fila'+cont+'"><td  style="text-align: center; width: 10px"><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td style="text-align: center"><input type="hidden" name="idServicio[]" value="'+idServicio+'">'+cantidad+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+nombre+'</td><td style="text-align: right"><input type="hidden" name="precio[]" value="'+precio+'">'+precio+'</td><td style="text-align: right"><input type="hidden" name="importe[]" value="'+subtotal[cont]+'">'+subtotal[cont]+'</td></tr>';
                  cont ++;
                  limpiar();
                  $('#total').html("S/. "+total);
                  $('#total_venta').val(total);
                  validar();
                  $('#detalles').append(fila);
            }
            else
            {
                  alert('faltan completar datos');
            }
      }
      function eliminar(index)
      {
            total=total-subtotal[index];
            $("#total").html("S/. "+total);
            $("#total_venta").val(total);
            $("#fila"+index).remove();
      }

      function limpiar()
      {
            $("#pcantidad").val("");
            $("#pprecio").val("");
      }
      function validar()
      {
            if (total>0)
            {
                  $("#guardar").show();
            }
            else
            {
                  $("#guardar").hide();
            }

      }
</script>
@stop