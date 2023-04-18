<!-- Modal -->
{!! Form::open(['route'=>['docentes.cursos.capacidades.indicadores.destroy',$indicadore->id],'method'=>'delete'],) !!}
<div class="modal fade" id="modal-delete-{{ $indicadore->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-list"></i> Confirmar borrado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿esta seguro que desa eliminar este indicador?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-power-off"></i> Cancelar
          </button>
          <button type="summit" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Eliminar
          </button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}