{!! Form::open(['route'=>['accesos.estudiantes.update',$usuario->id],'method'=>'put','id'=>'frm']) !!}
<div class="modal fade" id="modalEmail-{{ $usuario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title"><i class="fas fa-paper-plane"></i> Enviar Correo de Recuperación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" name="email" class="form-control" readonly value="{{ $usuario->email }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
          <button type="submit" class="btn btn-warning"><i class="far fa-envelope"></i> Enviar</button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

  {!! Form::open(['route'=>['accesos.estudiantes.destroy',$usuario->id],'method'=>'delete','id'=>'frm']) !!}
  <div class="modal fade" id="modalDelete-{{ $usuario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title"><i class="fas fa-paper-plane"></i> Confirmar Eliminacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            ¿Esta seguro que desea eliminar este usuario?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
          <button type="submit" class="btn btn-danger"><i class="far fa-envelope"></i> Enviar</button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}