<div class="modal fade" id="modal-plan-{{ $periodo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  {!! Form::open(['route'=>['sacademica.pmatriculas.plancierre',$periodo->id],'method'=>'get']) !!}  
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿esta seguro que desea cambiar el estado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-exchange-alt"></i> Cambiar
          </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
</div>