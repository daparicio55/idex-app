{{-- eliminar la deuda por completo --}}
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-eliminarCompleto-{{$deu->idDeuda}}">
	{{Form::Open(array('route'=>array('ventas.deudas.destroy',$deu->idDeuda.':'.'eliminarCompleto'),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Deuda | Sistema de Control IDEX 'Perú</h4>
			</div>
			<div class="modal-body">
				<p>Con esta accion se eliminara la deuda y todos los datos de los pagos realizados anterior mente.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>