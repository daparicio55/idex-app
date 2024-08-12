<!-- Modal -->
<div class="modal fade" id="m-delete-{{ $reingreso->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {!! Form::open(['route'=>['sacademica.reingresos.destroy',$reingreso->id],'method'=>'delete']) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar Acción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Esta seguro que desea eliminar esta licencia del sistema?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times-circle"></i> Cerrar
            </button>
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>

  <div class="modal fade" id="m-edit-{{ $reingreso->id }}" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
    {!! Form::open(['route'=>['sacademica.reingresos.store'],'method'=>'POST','id'=>'frm']) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
            <h5 class="modal-title" id="modalEdit">Editar Resolucion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="reingreso" value="{{ $reingreso->id }}">
          <input type="text" class="form-control" required name="observacion" value="{{ $reingreso->observacion }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times-circle"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="far fa-check-circle"></i> Actualizar
          </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>