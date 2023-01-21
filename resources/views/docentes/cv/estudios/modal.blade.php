<!-- Modal -->
{{Form::Open(array('route'=>array('docentes.cv.estudios.destroy',$estudio->id),'method'=>'delete'))}}
<div class="modal fade" id="modal-delete-{{ $estudio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  	<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title text-danger" id="exampleModalLabel">
				Eliminar Registro de Estudio
			</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar este entrada de estudios realizados</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">
					<i class="fas fa-times-circle"></i> NO
				</button>
				<button type="submit" class="btn btn-danger">
					<i class="fas fa-share-square"></i> SI
				</button>
			</div>
	  	</div>
	</div>
</div>
{!! Form::close() !!}