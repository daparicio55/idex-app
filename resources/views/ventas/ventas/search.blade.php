{!! Form::open(array('url'=>'ventas/ventas','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
	<div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
    	<div class='form-group'>
			<label>Ingrese texto a buscar</label>
			<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		</div>
	</div>
	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
	<label>Tipo de Pago</label>
		<select name="tipoPago" class='form-control'>
			<option value="Todo">Todo</option>
            <option value="Contado" @if ($tipoPago == 'Contado') selected @endif>Contado</option>
            <option value="Transferencia" @if ($tipoPago == 'Transferencia') selected @endif>Transferencia</option>
			<option value="Credito" @if ($tipoPago == 'Credito') selected @endif>Credito</option>
        </select>
	</div>
	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
	<label>F. Inicio</label>
		<input type="date" name="dInicio" required class="form-control" value="{{$dInicio}}">
	</div>
	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
	<label>F. Final</label>
		<input type="date" name="dFin" required class="form-control" value="{{$dFin}}">
	</div>
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			  <label>Productos y Servicios</label>
			  <select name="idServicio" class="form-control selectpicker" id="idServicio" data-live-search="true" data-size="5">
				<option value="0">todos los servicios</option>
					@foreach($servicios as $serv)
						<option value="{{$serv->idServicio}}">{{$serv->nombre}}</option>
					@endforeach
			  </select>
		</div>
  	</div>
</div>
<div class="row">
	<div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
		</div>
	</div>
</div>
{{Form::close()}}