<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$venta->idVenta}}">
	{{Form::Open(array('route'=>array('ventas.ventas.destroy',$venta->idVenta.':'.'eliminar'),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Venta</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar a esta Venta</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-anular-{{$venta->idVenta}}">
	{{Form::Open(array('route'=>array('ventas.ventas.destroy',$venta->idVenta.':'.'anular'),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger" style="opacity: 0.8">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Anular Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">
				<p>Confirme si desea anular la venta <span style="font-weight: 900">#{{ $venta->numero }}</span> </p>
				<p><strong class="text-uppercase">{{ Str::upper($venta->cliente->apellido) }}</strong>, <span class="text-capitalize">{{ Str::title(($venta->cliente->nombre)) }}</span> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">
					<i class="fas fa-times"></i> Cerrar
				</button>
				<button type="submit" class="btn btn-danger" style="opacity: 0.8">
					<i class="fa fa-check"></i>	Anular
				</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>

<!--Editar Numero-->
<div class="modal fade" id="modal-editar-{{$venta->idVenta}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	{{-- {!!Form::model(['method'=>'PATCH','route'=>['ventas.ventas.update',$vent->idVenta]])!!} --}}
	{!! Form::model($venta, ['route'=>['ventas.ventas.update',$venta->idVenta],'method'=>'PUT']) !!}
	{{Form::token()}}
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fas fa-list-ol"></i> Cambiar número de Boleta</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			  <p>ingrese el nuevo número de la botela </p>
			  {!! Form::hidden('url', url()->full() , [null]) !!}
			  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				  <div class="form-group">
					  {!! Form::label('numero', 'Numero', [null]) !!}
					  {!! Form::text('numero', $venta->numero, ['class'=>'form-control','required']) !!}
				  </div>
			  </div>
		  </div>
		  <div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">
				  <i class="fas fa-power-off"></i> Cerrar
			  </button>
			  <button type="submit" id="btn_subir" class="btn btn-primary">
				  <i class="fas fa-check"></i> Actualizar
			  </button>
		  </div>
		</div>
	  </div>
	{{Form::Close()}}
</div>
