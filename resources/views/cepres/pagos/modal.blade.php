<div class="modal fade" id="modal-delete-{{$ceprepago->idCeprePago}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['cepres.pagos.destroy',$ceprepago->idCeprePago],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar el pago del sistema?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-trash-alt"></i>Eliminar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>