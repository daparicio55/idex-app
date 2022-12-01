{{-- pagar la cuota --}}
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-pagar-{{$DeDe->idDeDe}}">
	{{Form::Open(array('route'=>array('ventas.deudas.destroy',$DeDe->idDeDe.':'.'pagar'),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Pagar Cuota | Sistema de Control IDEX 'Perú</h4>
			</div>
			<div class="modal-body">
                <div class='form-group'>
                    <label for="numeroBoleta">Numero de Boleta:
                        <input type="text" name="numeroBoleta" id="numeroBoleta" class="form-control" required>
                    </label>
                </div>
				<p>ingrese el numero de boleta para confirmar el pago de esta cuota</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>
{{-- eliminar el pago de la cuota --}}
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-eliminar-{{$DeDe->idDeDe}}">
	{{Form::Open(array('route'=>array('ventas.deudas.destroy',$DeDe->idDeDe.':'.'eliminar'),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Revertir Pago | Sistema de Control IDEX 'Perú</h4>
			</div>
			<div class="modal-body">
				<p>Confirme la reversion del pago de la deuda</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>
