<!-- Modal -->
{!! Form::open(['route'=>['gadministrativa.administracion.tramites.destroy',$tramite->id],'method'=>'delete','id'=>'frm']) !!}
<div class="modal fade" id="modal-delete-{{ $tramite->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Eliminar Trámite
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Este proceso es irreversible, ¿está seguro de eliminar este trámite?'</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="far fa-window-close"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="far fa-trash-alt"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}