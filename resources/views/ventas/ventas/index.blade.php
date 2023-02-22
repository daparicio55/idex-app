@extends('adminlte::page')
@section('title', 'Ventas')
@section('content_header')
		<h1>Listado de Ventas 
			<a href="ventas/create">
				<button class="btn btn-success" @if (oficinaNombre() == 'Unidad Académica') disabled @endif>
					<i class="far fa-file"></i> Nuevo
				</button></a>
			<a href="ventas">
				<button class="btn btn-warning text-white" @if (oficinaNombre() == 'Unidad Académica') disabled @endif>
					<i class="fa fa-paint-brush" aria-hidden="true"></i> Limpiar
				</button>
			</a>
			<a href="{{URL('ventas/ventas/imprimirv2/'.$searchText.':'.$tipoPago.':'.$dInicio.':'.$dFin.':'.$idServicio)}}">
				<button class="btn btn-primary" @if (oficinaNombre() == 'Unidad Académica') disabled @endif>
					<i class="fa fa-print" aria-hidden="true"></i> Imprimir
				</button>
			</a>
			<a href="{{ route('venta.ventas.excel',$searchText.':'.$tipoPago.':'.$dInicio.':'.$dFin.':'.$idServicio) }}" class="btn btn-success">
				<i class="far fa-file-excel"></i> Excel
			</a>
			<a  href=""  data-target="#modal-anular-1" data-toggle="modal">
				<button class="btn btn-danger">
					<i class="fas fa-minus-circle" aria-hidden="true"></i> Anular
				</button>
			</a>
		</h1>
		@include('ventas.ventas.anular')
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('ventas.ventas.search')
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Comprob</th>
					<th>T. Pago</th>
					<th>Num</th>
                    <th>DNI | Nombre Cliente</th>
					<th>Fecha</th>
                    <th>Monto</th>
                    <th>Est.</th>
				</thead>
				<tbody>
					@foreach ($ventas as $vent)
					<tr @if($vent->estado == 'anulado') class="text-danger" @endif>
						<td>{{ $vent->tipo}}</td>
						<td>{{ $vent->tipoPago}}</td>
						<td>
							{{ $vent->numero}}
							<a href="" class="btn btn-warning" data-target="#modal-editar-{{$vent->idVenta}}" data-toggle="modal" title="editar numero de boleta">
								<i class="fas fa-pen"></i>
							</a>
						</td>
						<td>
							{{ $vent->dniRuc}} |<strong class="text-uppercase">{{$vent->apellido}}</strong>, <span class="text-capitalize">{{strtolower($vent->nombre)}}</span>  
						</td>
						<td style="width: 100px; text-align: center">{{ date('d-m-Y', strtotime($vent->fecha))}}</td>
						<td class="text-right">{{ $vent->total}}</td>
						<td>{{ $vent->estado}}</td>
						<td style="width: 205px; text-align: center">
							<a href="{{route('ventas.ventas.show',['venta' =>$vent->idVenta])}}">
								<button class="btn btn-info"><i class="fa fa-search-plus" aria-hidden="true" title="detalles"></i></button></a>
							<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="{{route('ventas.ventas.imprimir',['id'=>$vent->idVenta])}}">
								<button class="btn btn-success" title="imprimir"><i class="fa fa-print" aria-hidden="true"></i></button></a>
							<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="" data-target="#modal-anular-{{$vent->idVenta}}" data-toggle="modal">
								<button class="btn btn-secondary" title="anular / activar"><i class="fa fa-ban" aria-hidden="true"></i></button></a>
							<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="" data-target="#modal-delete-{{$vent->idVenta}}" data-toggle="modal">
								<button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
						</td>
						@include('ventas.ventas.modal')
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9">
							{{$ventas->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		
	</div>
<div>
@stop
@section('js')
    <script>
	$(document).ready(function(){
    setTimeout(() => {
        $("#info").hide();
    }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    });
	</script>
@stop