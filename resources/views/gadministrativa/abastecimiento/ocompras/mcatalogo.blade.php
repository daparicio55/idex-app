<div class="modal fade" id="modal_catalogos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Selección un catalogo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="fila_detalle">
                        <label for="catalogos">Catalogos</label>
                        <select id="catalogos" class="form-control selectpicker" data-live-search="true" data-size="10">
                            <option value="0" disabled selected>Selecione un catálogo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_modal_catalogo_add"><i class="fas fa-plus-square"></i> Agregar</button>
            </div>
        </div>
    </div>
</div>
