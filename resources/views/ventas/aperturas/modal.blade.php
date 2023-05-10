<!-- Modal -->
<div class="modal fade" id="open-{{ $uasignada->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Ingrese número de boleta</label>
                <input type="number" class="form-control" name="boleta" required>
            </div>
          ¿Esta seguro que desea abrir la planeación de esta unidad didáctica?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times-circle"></i> Cerrar
            </button>
            <button type="submit" class="btn btn-primary btn-abrir" id="btn_abrir">
                <i class="fas fa-folder-open"></i> Abrir
            </button>
        </div>
      </div>
    </div>
  </div>