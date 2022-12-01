<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="editar-{{ $detalle->id }}">
    {!! Form::open(['route'=>['sacademica.matriculasdetalles.update',$detalle->id],'method'=>'put']) !!}
    <div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Editar nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
			<div class="modal-body">
                {!! Form::hidden('origen', 'convalidaciones', [null]) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="from-group">
                            <label for="">Ciclo:</label>
                            <input class="form-control" type="text" readonly value="{{ $detalle->unidad->ciclo }}">
                            <label for="">Unidad:</label>
                            <input type="text" class="form-control" readonly value="{{  $detalle->unidad->nombre }}">
                            <label for="">Nota:</label>
                            <input type="number" class="form-control" name="nota" value="{{ $detalle->nota }}">
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
				<button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Guardar
                </button>
			</div>
		</div>
	</div>
    {!! Form::close() !!}
</div>


<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="detalle-eliminar-{{ $detalle->id }}">
    {!! Form::open(['route'=>['sacademica.matriculasdetalles.destroy',$detalle->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
			<div class="modal-body">
                {!! Form::hidden('origen', 'convalidaciones', [null]) !!}
                <p>¿Esta seguro de eliminar este registro?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
				<button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Eliminar
                </button>
			</div>
		</div>
	</div>
    {!! Form::close() !!}
</div>