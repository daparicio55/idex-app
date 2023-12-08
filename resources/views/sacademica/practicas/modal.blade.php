<!-- Modal -->
<div class="modal fade" id="modal-delete-{{ $practica_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  {!! Form::open(['route'=>['sacademica.practicas.destroy',$practica_id],'method'=>'delete']) !!}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Elminacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro que desea eliminar esta práctica?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>