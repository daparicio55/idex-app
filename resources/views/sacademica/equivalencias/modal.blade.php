<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="eliminar-{{ $unidad->id }}">
    {!! Form::open(['route'=>['sacademica.equivalencias.destroy',$unidad->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Eliminar Equivalencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
			<div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="from-group">
                            Esta seguro que desea eliminar esta equivalencia del sistema?
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times"></i> NO
                </button>
				<button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> SI
                </button>
			</div>
		</div>
	</div>
    {!! Form::close() !!}
</div>