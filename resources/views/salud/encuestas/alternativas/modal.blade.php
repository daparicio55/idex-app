<!-- Modal -->
{!! Form::open(['route'=>['salud.alternativas.destroy',$alternative->id],'method'=>'delete']) !!}
<div class="modal fade" id="modal-delete-{{ $alternative->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title"> 
                    <i class="fa fa-trash"></i>  Confirmar acción
                </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea eliminar esta alternativa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-door-open"></i> Cerrar
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}