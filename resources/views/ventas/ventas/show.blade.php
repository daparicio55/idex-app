@extends('adminlte::page')
@section('title', 'Venta Nueva')

@section('content_header')
    <h3> <strong> Detalles de la venta </strong></h3>
	<p><strong>Cliente: </strong> {{$ventas->nombre.' '.$ventas->apellido}}</p>
@stop
@section('content')
	<div class="row">
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="tipo">T. Comprobante</label>
				<p>{{$ventas->tipo}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="numero">Num. Comprobante</label>
				<p>{{$ventas->numero}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha Venta</label>
				<p>{{$ventas->fecha}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="total">Total Comprobante.</label>
				<p>{{$ventas->total}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="total">T. Pago.</label>
				<p>{{$ventas->tipoPago}}</p>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="total">Comentario.</label>
				<p>{{$ventas->comentario}}</p>
			</div>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">
						<th>Cantidad</th>
						<th>Descripcion</th>
						<th>Precio</th>
						<th>Importe</th>
					</thead>
					<tbody>
						@foreach($detalles as $det)
						<tr>
							<td>{{$det->cantidad}}</td>
							<td>{{$det->nombre}}</td>
							<td>{{$det->precio}}</td>
							<td>{{$det->importe}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop