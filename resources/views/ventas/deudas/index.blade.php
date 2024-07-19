@extends('adminlte::page')
@section('title', 'Deudas')
@section('content_header')
<div class="row"> 
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Deudas 
			<a href="{{route('ventas.deudas.create')}}">
				<button class="btn btn-success">
					<i class="fas fa-plus-square"></i> Nuevo
				</button>
			</a> 
			<a href="{{ route('ventas.deudas.index') }}" class="btn btn-danger">
				<i class="fas fa-broom"></i> Limpiar
			</a>
		</h3>
	</div>
</div>
@stop
@section('content')
@include('ventas.deudas.search')
<x-alert/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th class="text-center">#</th>
					<th>DNI</th>
					<th>Apellidos y Nombres</th>
					<th>Teléfono</th>
					<th>Carrera</th>
					<th>Servicio</th>
					<th style="width: 100px">Fecha</th>
					<th>Estado</th>
					<th style="width: 155px"></th>
				</thead>
				<tbody>
					@foreach ($deudas as $deu)
					<tr @if(estadoDeuda($deu->idDeuda)== "en deuda") style="color: red" @endif>
						<td>{{$deu->numero}}</td>
						<td>{{$deu->cliente->dniRuc}}</td>
						<td><strong class="text-uppercase">{{$deu->cliente->apellido}}</strong>, <span class="text-capitalize">{{ Str::lower($deu->cliente->nombre)}}</span></td>
						<td>{{$deu->cliente->telefono}}</td>
						<td>
							@foreach ($deu->cliente->postulaciones as $postulacion)
								@isset($postulacion->estudiante->postulante)
									{{ $postulacion->estudiante->postulante->carrera->nombreCarrera }}	
								@endisset
							@endforeach
						</td>
						<td>{{$deu->servicio->nombre}}</td>
						<td>{{date('d-m-Y',strtotime($deu->fDeuda))}}</td>
						<td>{{$deu->estado}}</td>
						<td>
							<a href="{{route('ventas.deudas.imprimir',['id'=>$deu->idDeuda])}}"><button class="btn btn-warning" title="imprimir"><i class="fa fa-print" aria-hidden="true"></i></button></a>
							<a href="{{route('ventas.deudas.pagar',['id'=>$deu->idDeuda])}}">								<button class="btn btn-primary" title="pagar, amortizar">
									<i class="fab fa-paypal"></i>
								</button>
							</a>
							<a href="" data-target="#modal-eliminarCompleto-{{$deu->idDeuda}}" data-toggle="modal"><button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
						</td>
						@include('ventas.deudas.modal1')
					</tr>
					@endforeach
				</tbody>
				@if (method_exists($deudas, 'links'))
					<tfoot>
						<tr>
							<td colspan="9">
								{{ $deudas->links() }}
							</td>
						</tr>	
					</tfoot>
				@endif
				
			</table>
			
		</div>
	</div>
</div>
@stop
