{{-- modal de eliminar --}}
<div class="modal fade" id="modal-delete-{{$postulante->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['admisiones.postulantes.destroy',$postulante->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar la inscripción del sistema?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>


  {{-- modal de anullar --}}
<div class="modal fade" id="modal-anular-{{$postulante->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['admisiones.postulantes.anular',$postulante->id],'method'=>'get']) !!}
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          ¿Esta seguro que desea anular o reactivar la inscripción del sistema?
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-exchange-alt"></i> Cambiar
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>