<div class="modal fade" id="modal-delete-{{$usuario->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['accesos.usuarios.destroy',$usuario->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar este usuario del sistema?
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

<div class="modal fade" id="modal-email-{{$usuario->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['password.email'],'method'=>'POST']) !!}
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar Envio de Correo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
          <div class="col-sm-12">
            {!! Form::label('email', 'Email', [null]) !!}
            {!! Form::text('email', $usuario->email, ['class'=>'form-control']) !!}
          </div>
         </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fas fa-trash-alt"></i> Enviar
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>