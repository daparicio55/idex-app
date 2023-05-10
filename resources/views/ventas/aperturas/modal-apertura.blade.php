{!! Form::open(['route'=>['ventas.aperturas.destroy',$apertura->id],'method'=>'delete']) !!}
<div class="modal fade" id="apertura-{{ $apertura->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Esta seguro que desea eliminar esta apertura?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times-circle"></i> Cerrar
            </button>
            <button type="submit" class="btn btn-danger" id="btn_abrir">
                <i class="fas fa-folder-open"></i> Eliminar
            </button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}