<!-- Modal -->
{!! Form::open(['route'=>['sacademica.uasignadas.destroy',$uasignada->id],'method'=>'delete']) !!}
<div class="modal fade" id="modal-delete-{{ $uasignada->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-radiation"></i> Confirmar Eliminacion
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    ¿Esta seguro de eliminar esta unidad didactica asignada?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i> NO
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> SI
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

{!! Form::open(['route'=>['sacademica.uasignadas.update',$uasignada->id],'method'=>'put']) !!}
<div class="modal fade" id="modal-update-{{ $uasignada->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-users"></i> Cambiar de Docente
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::label('user_id', 'Nuevo Docente', [null]) !!}
                    <select name="user" id="user" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-paper-plane"></i> Cambiar
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}